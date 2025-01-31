<?php

namespace Akeneo\Pim\Enrichment\Bundle\Elasticsearch\Filter\Field;

use Webkul\ElasticSearch\Filter\AbstractFieldFilter;
use Webkul\ElasticSearch\Contracts\FieldFilterInterface;
use Webkul\ElasticSearch\Filter\Operators;
use Webkul\ElasticSearch\QueryString;

/**
 * Sku filter for an Elasticsearch query
 *
 */
class SkuFilter extends AbstractFieldFilter implements FieldFilterInterface
{
    const SKU_KEY = 'sku';

    /**
     * @param array $supportedFields
     * @param array $supportedOperators
     */
    public function __construct(
        array $supportedFields = [],
        array $supportedOperators = []
    ) {
        $this->supportedFields = $supportedFields;
        $this->supportedOperators = $supportedOperators;
    }

    /**
     * {@inheritdoc}
     */
    public function addFieldFilter($field, $operator, $value, $locale = null, $channel = null, $options = [])
    {
        if (null === $this->searchQueryBuilder) {
            throw new \LogicException('The search query builder is not initialized in the filter.');
        }

        // if (Operators::IS_EMPTY !== $operator && Operators::IS_NOT_EMPTY !== $operator) {
        //     $this->checkValue($field, $operator, $value);
        // }

        $this->applyFilter($field, $operator, $value);

        return $this;
    }

    /**
     * Checks the identifier is a string or an array depending on the operator
     *
     * @param string $property
     * @param string $operator
     * @param mixed  $value
     *
     * @throws InvalidPropertyTypeException
     */
    protected function checkValue($property, $operator, $value)
    {
        // if (Operators::IN_LIST === $operator || Operators::NOT_IN_LIST === $operator) {
        //     FieldFilterHelper::checkArrayOfStrings($property, $value, self::class);
        // } else {
        //     FieldFilterHelper::checkString($property, $value, self::class);
        // }
    }

    /**
     * Apply the filtering conditions to the search query builder
     *
     * @param string $field
     * @param string $operator
     * @param mixed  $value
     */
    protected function applyFilter($field, $operator, $value)
    {
        switch ($operator) {
            case Operators::STARTS_WITH:
                $clause = [
                    'query_string' => [
                        'default_field' => $field,
                        'query'         => QueryString::escapeValue($value) . '*',
                    ],
                ];
                $this->searchQueryBuilder->addFilter($clause);
                break;

            case Operators::CONTAINS:
                $clause = [
                    'query_string' => [
                        'default_field' => $field,
                        'query'         => '*' . QueryString::escapeValue($value) . '*',
                    ],
                ];
                $this->searchQueryBuilder->addFilter($clause);
                break;

            case Operators::DOES_NOT_CONTAIN:
                $mustNotClause = [
                    'query_string' => [
                        'default_field' => $field,
                        'query'         => '*' . QueryString::escapeValue($value) . '*',
                    ],
                ];

                $filterClause = [
                    'exists' => ['field' => $field],
                ];

                $this->searchQueryBuilder->addMustNot($mustNotClause);
                $this->searchQueryBuilder->addFilter($filterClause);
                break;

            case Operators::EQUALS:
                $clause = [
                    'term' => [
                        $field => $value,
                    ],
                ];
                $this->searchQueryBuilder->addFilter($clause);
                break;

            case Operators::NOT_EQUAL:
                $mustNotClause = [
                    'term' => [
                        $field => $value,
                    ],
                ];

                $filterClause = [
                    'exists' => [
                        'field' => $field,
                    ],
                ];
                $this->searchQueryBuilder->addMustNot($mustNotClause);
                $this->searchQueryBuilder->addFilter($filterClause);
                break;

            case Operators::IN_LIST:
                $clause = [
                    'terms' => [
                        $field => $value,
                    ],
                ];

                $this->searchQueryBuilder->addFilter($clause);
                break;

            case Operators::NOT_IN_LIST:
                $clause = [
                    'terms' => [
                        $field => $value,
                    ],
                ];

                $this->searchQueryBuilder->addMustNot($clause);
                break;

            case Operators::IS_EMPTY:
                $clause = [
                    'exists' => ['field' => $field,],
                ];

                $this->searchQueryBuilder->addMustNot($clause);
                break;

            case Operators::IS_NOT_EMPTY:
                $clause = [
                    'exists' => ['field' => $field],
                ];
                $this->searchQueryBuilder->addFilter($clause);
                break;

            default:
                break;
        }
    }
}
