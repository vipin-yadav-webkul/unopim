<?php

use Webkul\ElasticSearch\Contracts\FieldFilterInterface;

use Webkul\ElasticSearch\SearchQueryBuilder;

abstract class AbstractFieldFilter implements FieldFilterInterface
{
    /** @var SearchQueryBuilder */
    protected $searchQueryBuilder = null;

    /** @var array */
    protected $supportedFields = [];

    /** @var array */
    protected $supportedOperators = [];

    /**
     * {@inheritdoc}
     */
    public function supportsField($field)
    {
        return in_array($field, $this->supportedFields);
    }

    /**
     * {@inheritdoc}
     */
    public function supportsOperator($operator)
    {
        return in_array($operator, $this->supportedOperators);
    }

    /**
     * {@inheritdoc}
     */
    public function getOperators()
    {
        return $this->supportedOperators;
    }

    /**
     * {@inheritdoc}
     */
    public function getFields()
    {
        return $this->supportedFields;
    }

    /**
     * {@inheritdoc}
     */
    public function setQueryBuilder($searchQueryBuilder)
    {
        if (!$searchQueryBuilder instanceof SearchQueryBuilder) {
            throw new \InvalidArgumentException(
                sprintf('Query builder should be an instance of "%s"', SearchQueryBuilder::class)
            );
        }

        $this->searchQueryBuilder = $searchQueryBuilder;
    }
}
