<?php

namespace Webkul\FixtureFactory\Services;

use Illuminate\Support\Facades\DB;

class AttributeFixtureFactory extends BaseFixtureFactory
{
    /**
     * Generate attributes.
     */
    public function generate($index, int $count, $chunkSize)
    {
        $now = now();
        $data = [];

        // Loop to generate data for the given chunk size
        for ($j = 0; $j < min($chunkSize, $count - $index); $j++) {

            // Generate a unique code for the attribute
            $code = $this->generateCode('attributes');

            // Randomly select attribute type
            $type = $this->faker->randomElement([
                'text', 'textarea', 'select', 'multiselect', 'boolean', 'price', 'image', 'file', 'gallery', 'checkbox', 'datetime', 'date', 'price',
            ]);

            // Add the attribute data to the $data array
            $data[] = [
                'code'              => $code,
                'type'              => $type,
                'validation'        => null,
                'position'          => $this->faker->numberBetween(1, 100),
                'is_required'       => $this->faker->boolean(50),
                'is_unique'         => $this->faker->boolean(50),
                'value_per_locale'  => $this->faker->boolean(50),
                'value_per_channel' => $this->faker->boolean(50),
                'default_value'     => null,
                'enable_wysiwyg'    => $type === 'textarea' ? $this->faker->boolean(50) : 0,
                'created_at'        => $now,
                'updated_at'        => $now,
            ];
        }

        // Wrap the insert operation in a transaction for performance and data integrity
        DB::transaction(function () use ($data) {
            foreach ($data as $key => $attributeData) {
                $attributeId = DB::table('attributes')->insertGetId($attributeData);
                $this->generateTranslationData($attributeId);
            }

        });

        return count($data);
    }

    /**
     * Generate additional data for categories.
     */
    protected function generateTranslationData($attributeId)
    {
        $locale = $this->getLocale();

        // Create a random attribute name using Faker's word generator
        $attributeName = 'Attr '.ucfirst($this->faker->word);  // Capitalized for proper naming

        // Insert translation data into the 'attribute_translations' table
        DB::table('attribute_translations')->insert([
            'locale'       => $locale,
            'name'         => $attributeName,
            'attribute_id' => $attributeId,
        ]);

    }
}
