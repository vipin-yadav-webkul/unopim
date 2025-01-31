<?php

namespace Webkul\Product\ElasticSearch\Cursor;

use Webkul\ElasticSearch\Contracts\CursorFactoryInterface;
use Webkul\Core\Facades\ElasticSearch;
use Webkul\ElasticSearch\ResultCursor;
use Webkul\ElasticSearch\ElasticsearchResult;

class ResultCursorFactory implements CursorFactoryInterface 
{
    /**
     * {@inheritdoc}
     */
    public static function createCursor($esQuery, array $options = [])
    {
        $options = self::resolveOptions($options);

        try {
        $results = Elasticsearch::search([
            'index' => $options['index'],
            'body'  => [
                'from'          => ($options['page'] * $options['per_page']) - $options['per_page'],
                'size'          => $options['per_page'],
                'stored_fields' => [],
                'query'         => $esQuery['query'],
                'sort'          => $esQuery['sort'],
            ],
        ]);
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'attribute_family_id')) {
                $results = Elasticsearch::search([
                    'index' => $options['index'],
                    'body'  => [
                        'from'          => ($options['page'] * $options['per_page']) - $options['per_page'],
                        'size'          => $options['per_page'],
                        'stored_fields' => [],
                        'query'         => $esQuery['query'],
                        'sort'          => $esQuery['sort'],
                    ],
                ]);
            }
        }

        $totalResults = Elasticsearch::count([
            'index' => $options['index'],
            'body'  => [
                'query' => $esQuery['query'],
            ],
        ]);

        $totalCount = $totalResults['count'];
        
        $ids = collect($results['hits']['hits'])->pluck('_id')->toArray();

        return new ResultCursor($ids, $totalCount, new ElasticsearchResult($results['hits']['hits'] ?? []));
    }

    /**
     * @param array $options
     *
     * @return array
     */
    protected static function resolveOptions(array $options)
    {
        $indexPrefix = env('ELASTICSEARCH_INDEX_PREFIX') ? env('ELASTICSEARCH_INDEX_PREFIX') : env('APP_NAME');

        $options['page'] = $options['page'] ?? 1;
        $options['per_page'] = $options['per_page']?? 10;
        $options['sort'] = $options['sort'] ?? [];
        $options['filters'] = $options['filters'] ?? [];

        $options['index'] = strtolower($indexPrefix.'_products');
        return $options;
    }
}