<?php

namespace Webkul\FixtureFactory\Services;

use Illuminate\Support\Facades\DB;

class CategoryFixtureFactory extends BaseFixtureFactory
{
    /**
     * Generate categories.
     */
    public function generate($index, int $count, $chunkSize)
    {
        $now = now();
        $data = [];

        $parentId = $this->getParentId();

        for ($j = 0; $j < min($chunkSize, $count - $index); $j++) {
            $lft = $rgt = 0;

            // Set a parent-child relationship for some categories
            if ($j > 0 && rand(0, 1) === 1) {
                // Randomly assign a parent category
                $lft = rand(1, 10); // Random left value for hierarchy
                $rgt = $lft + rand(1, 5); // Random right value for hierarchy
            }

            $code = $this->generateCode('categories');

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
     * Get a random attribute family ID.
     */
    protected function getParentId(): int
    {
        return DB::table('categories')->inRandomOrder()->first()->id;
    }

    /**
     * Generate additional data for categories.
     */
    protected function generateAdditionalData(): array
    {
        $locale = $this->getLocale();
        $name = $this->faker->categoryName();

        return [
            'locale_specific' => [
                $locale => [
                    'name'        => $name,
                    'description' => $this->faker->categoryDescription($name),
                ],
            ],
        ];
    }
}
