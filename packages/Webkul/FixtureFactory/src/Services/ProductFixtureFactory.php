<?php

namespace Webkul\FixtureFactory\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Webkul\Product\Type\AbstractType;

class ProductFixtureFactory extends BaseFixtureFactory
{
    /**
     * Generate simple products.
     */
    public function generateSimpleProducts($index, int $count, $chunkSize)
    {
        $now = now();
        $data = [];

        for ($j = 0; $j < min($chunkSize, $count - $index); $j++) {
            $sku = $this->generateSku();

            $data[] = [
                'sku'                 => $sku,
                'status'              => 1,
                'type'                => 'simple',
                'parent_id'           => null,
                'attribute_family_id' => $this->getFamilyId(),
                'values'              => json_encode($this->generateValues($sku)),
                'created_at'          => $now,
                'updated_at'          => $now,
            ];
        }

        DB::table('products')->insert($data);

        return count($data);
    }

    /**
     * Generate configurable products.
     * This method generates configurable products and their variants.
     */
    public function generateConfigurableProducts($index, int $count, $chunkSize)
    {
        $now = now();
        $data = [];

        for ($j = 0; $j < min($chunkSize, $count - $index); $j++) {
            $sku = $this->generateSku();

            $data[] = [
                'sku'                 => $sku,
                'status'              => 1,
                'type'                => 'configurable',
                'parent_id'           => null,
                'attribute_family_id' => $this->getFamilyId(),
                'values'              => json_encode($this->generateValues($sku)),
                'created_at'          => $now,
                'updated_at'          => $now,
            ];
        }

        DB::table('products')->insert($data);

        $this->generateConfigurableAttributes($data);

        return count($data);
    }

    /**
     * Generate configurable attributes for the given products.
     */
    protected function generateConfigurableAttributes($data)
    {
        $products = DB::table('products')
            ->whereIn('sku', array_column($data, 'sku'))
            ->where('type', 'configurable')
            ->get();
        $productAttributeIds = [];
        foreach ($products as $product) {
            $product = (array) $product;
            $productId = $product['id'];
            $values = json_decode($product['values'], true);
            $variantAttributeCode = $this->faker->randomElement(['size', 'color']);
            if (! isset($values[AbstractType::COMMON_VALUES_KEY][$variantAttributeCode])) {
                continue;
            }

            $attributeId = DB::table('attributes')->where('code', $variantAttributeCode)->first()?->id;

            if (! $attributeId) {
                continue;
            }

            $productAttributeIds[] = [
                'product_id'   => $productId,
                'attribute_id' => $attributeId,
            ];

            $this->generateVariantProducts($product, $values);
        }

        DB::table('product_super_attributes')->insert($productAttributeIds);
    }

    /**
     * Generate variant products for the given product.
     */
    public function generateVariantProducts($product, $values)
    {
        $now = now();

        DB::table('products')->insert([
            'sku'                 => $product['sku'].'-VARIANT',
            'status'              => 1,
            'type'                => 'simple',
            'parent_id'           => $product['id'],
            'attribute_family_id' => $this->getFamilyId(),
            'values'              => json_encode($this->generateVariantValues($product, $values)),
            'created_at'          => $now,
            'updated_at'          => $now,
        ]);
    }

    /**
     * Generate a unique SKU.
     */
    public function generateSku()
    {
        $sku = strtoupper($this->faker->bothify('SKU-########'));

        // Check if SKU already exists
        while ($this->isSkuExist($sku)) {
            $sku = strtoupper($this->faker->bothify('SKU-########'));
        }

        return $sku;
    }

    /**
     * Check if SKU already exists in the database.
     */
    protected function isSkuExist($sku): int
    {
        return DB::table('products')->where('sku', $sku)->count();
    }

    /**
     * Get a random attribute family ID.
     */
    protected function getFamilyId(): int
    {
        return DB::table('attribute_families')->inRandomOrder()->first()->id;
    }

    /**
     * Generate values for the product.
     * This method generates common values, channel values, and locale values.
     */
    protected function generateValues(string $sku): array
    {
        $currency = $this->getCurrency();
        $locale = $this->getLocale();
        $channel = $this->getChannel();

        $commonValues = array_merge([
            'sku'     => $sku,
            'url_key' => Str::slug($sku),
            'product_number' => $this->faker->randomNumber(8, true),
        ], $this->getOptionsTypeAttributes());

        $name = $this->faker->productName();

        return [
            AbstractType::COMMON_VALUES_KEY  => $commonValues,
            AbstractType::CHANNEL_VALUES_KEY => [
                $channel => [
                    'cost' => [
                        $currency => $this->faker->randomFloat(2, 10, 500),
                    ],
                ],
            ],
            AbstractType::CHANNEL_LOCALE_VALUES_KEY => [
                $channel => [
                    $locale => [
                        'price' => [
                            $currency => $this->faker->randomFloat(2, 10, 500),
                        ],
                        'name'              => $this->faker->productName(),
                        'description'       => $this->faker->productDescription($name),
                        'short_description' => $this->faker->productShortDescription($name),
                    ],
                ],
            ],

            AbstractType::CATEGORY_VALUES_KEY => $this->getCategories(),
        ];
    }

    /**
     * Generate variant values for the product.
     * This method generates common values, channel values, and locale values.
     */
    protected function generateVariantValues(array $product, $values): array
    {
        return [
            AbstractType::COMMON_VALUES_KEY => [
                'sku'     => $product['sku'].'-VARIANT',
                'url_key' => Str::slug($product['sku'].'-VARIANT'),
                'weight'  => $values[AbstractType::COMMON_VALUES_KEY]['weight'],
                'color'   => $values[AbstractType::COMMON_VALUES_KEY]['color'],
                'size'    => $values[AbstractType::COMMON_VALUES_KEY]['size'],
            ],

            AbstractType::CHANNEL_LOCALE_VALUES_KEY => $values[AbstractType::CHANNEL_LOCALE_VALUES_KEY] ?? [],

            AbstractType::CATEGORY_VALUES_KEY => $values[AbstractType::CATEGORY_VALUES_KEY] ?? [],
        ];
    }

    /**
     * Get random categories.
     * This method retrieves random categories from the database.
     */
    protected function getCategories(): ?array
    {
        return DB::table('categories')->inRandomOrder()->limit(3)->pluck('code')?->toArray();
    }

    /**
     * Get options type attributes.
     */
    protected function getOptionsTypeAttributes(bool $multiValue = false): array
    {
        return [
            'color' => $this->faker->randomElement(['Red', 'Green', 'Yellow', 'Black', 'White']),
            'size'  => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
        ];
    }
}
