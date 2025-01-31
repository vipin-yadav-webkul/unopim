<?php

namespace Webkul\Product\Query;

use Illuminate\Support\Facades\DB;
use Webkul\Attribute\Services\AttributeService; 
use Webkul\ElasticSearch\AbstractEntityQueryBuilder;

class ProductQueryBuilder extends AbstractEntityQueryBuilder
{
    public function __construct(
        protected AttributeService $attributeService,
    ) {
    }
    /**
     * Prepare query builder.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('products')
            ->leftJoin('attribute_families as af', 'products.attribute_family_id', '=', 'af.id')
            ->leftJoin('products as parent_products', 'products.parent_id', '=', 'parent_products.id');

        return $queryBuilder;
    }

    /**
     * {@inheritdoc}
     */
    public function addFilter($field, $operator, $value, array $context = [])
    {
        $attribute = $this->attributeService->findAttributeByCode($field);

        if (!$attribute) {
            $this->addFieldFilter($field, $operator, $value, $context);
        } else {
            $this->addAttributeFilter($field, $operator, $value, $context);
        }

        return $this;
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