<?php

namespace Webkul\ElasticSearch;

use Webkul\ElasticSearch\Contracts\QueryBuilderInterface;

class AbstractEntityQueryBuilder implements QueryBuilderInterface
{
    /** @var mixed */
    protected $qb;

    protected array $rawFilters = [];

    /**
     * {@inheritdoc}
     */
    public function setQueryBuilder($queryBuilder)
    {
        $this->qb = $queryBuilder;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryBuilder()
    {
        if (null === $this->qb) {
            throw new \LogicException('Query builder must be configured');
        }

        return $this->qb;
    }


    /**
     * {@inheritdoc}
     */
    public function addFilter($field, $operator, $value, array $context = [])
    {
        $this->rawFilters[] = [$field, $operator, $value, $context];

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRawFilters()
    {
        return $this->rawFilters;
    }

    /**
     * {@inheritdoc}
     */
    public function addSorter($field, $direction, array $context = [])
    {
        $this->qb->addSort($field, $direction, $context);

        return $this;
    }

    /**
     * Add a filter condition on a field
     */
    protected function addFieldFilter($filter, $field, $operator, $value, array $context)
    {
        
        return $this;
    }
}