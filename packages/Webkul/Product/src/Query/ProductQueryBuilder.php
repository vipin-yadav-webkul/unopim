<?php

namespace Webkul\Product\Query;

use Illuminate\Support\Facades\DB;
use Webkul\ElasticSearch\AbstractEntityQueryBuilder;

class ProductQueryBuilder extends AbstractEntityQueryBuilder
{
    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        $tablePrefix = DB::getTablePrefix();

        $queryBuilder = DB::table('products')
            ->leftJoin('attribute_families as af', 'products.attribute_family_id', '=', 'af.id')
            ->leftJoin('products as parent_products', 'products.parent_id', '=', 'parent_products.id');

        $this->qb = $queryBuilder;
    }

    /**
     * Add a filter condition on an attribute
     */
    protected function addAttributeFilter(
        $filter,
        $attribute,
        $operator,
        $value,
        array $context
    ) {

        return $this;
    }
}