<?php

namespace Webkul\ElasticSearch\Contracts;

use Webkul\ElasticSearch\SearchQueryBuilder;

interface QueryBuilderInterface
{
    /**
     * Get query builder
     *
     * @throws \LogicException in case the query builder has not been configured
     *
     * @return SearchQueryBuilder
     */
    public function getQueryBuilder();
    

    /**
     * Set query builder
     *
     * @param mixed $queryBuilder
     *
     * @return QueryBuilderInterface
     */
    public function setQueryBuilder($queryBuilder);


    /**
     * Add a filter condition on a field
     *
     * @param string $field    the field
     * @param string $operator the used operator
     * @param mixed  $value    the value to filter
     * @param array  $context  the filter context, used for locale and scope
     *
     * @throws \LogicException
     *
     * @return QueryBuilderInterface
     */
    public function addFilter($field, $operator, $value, array $context = []);


    /**
     * Returns applied filters
     *
     * @return array
     */
    public function getRawFilters();


    /**
     * Sort by field
     *
     * @param string $field     the field to sort on
     * @param string $direction the direction to use
     * @param array  $context   the sorter context, used for locale and scope
     *
     * @throws \LogicException
     *
     * @return QueryBuilderInterface
     */
    public function addSorter($field, $direction, array $context = []);
}