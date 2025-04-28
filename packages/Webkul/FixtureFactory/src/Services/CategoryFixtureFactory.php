<?php

namespace Webkul\FixtureFactory\Services;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CategoryFixtureFactory
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Generate categories.
     */
    public function generateCategories($index, int $count, $chunkSize)
    {
        $now = now();
        $data = [];

        $parentId = 1;

        for ($j = 0; $j < min($chunkSize, $count - $index); $j++) {
            $lft = $rgt = 0;

            // Set a parent-child relationship for some categories
            if ($j > 0 && rand(0, 1) === 1) {
                // Randomly assign a parent category
                $lft = rand(1, 10); // Random left value for hierarchy
                $rgt = $lft + rand(1, 5); // Random right value for hierarchy
            }

            $code = $this->generateCode();

            $data[] = [
                'code'            => $code, // e.g., "CAT-12345"
                '_lft'            => $lft,
                '_rgt'            => $rgt,
                'parent_id'       => $parentId,
                'created_at'      => $now,
                'updated_at'      => $now,
                'additional_data' => json_encode($this->generateAdditionalData()),
            ];
        }

        DB::table('categories')->insert($data);

        return count($data);
    }

    /**
     * Generate a unique SKU.
     */
    public function generateCode()
    {
        $firstChar = $this->faker->regexify('[a-zA-Z]');
        $rest = $this->faker->regexify('[a-zA-Z0-9_]{5,10}');
        $code = $firstChar.$rest;

        // Check if SKU already exists
        while ($this->isCodeExist($code)) {
            $firstChar = $this->faker->regexify('[a-zA-Z]');
            $rest = $this->faker->regexify('[a-zA-Z0-9_]{5,10}');
            $code = $firstChar.$rest;
        }

        return $code;
    }

    /**
     * Check if the SKU already exists in the database.
     */
    protected function isCodeExist($code): int
    {
        return DB::table('categories')->where('code', $code)->count();
    }

    /**
     * Generate additional data for categories.
     */
    protected function generateAdditionalData(): array
    {
        $locale = $this->faker->randomElement(['en_US']);

        return [
            'locale_specific' => [
                $locale => [
                    'name'        => ucfirst($this->faker->word),
                    'description' => $this->faker->sentence(10),
                ],
            ],
        ];
    }
}
