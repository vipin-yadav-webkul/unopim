<?php

namespace Webkul\FixtureFactory\Services;

use Illuminate\Support\Facades\DB;

class FamilyFixtureFactory extends BaseFixtureFactory
{
    /**
     * Generate attributes.
     */
    public function generate($index, int $count, $chunkSize)
    {
        $data = [];

        // Loop to generate data for the given chunk size
        for ($j = 0; $j < min($chunkSize, $count - $index); $j++) {

            // Generate a unique code for the attribute
            $code = $this->generateCode('attribute_families');

            // Add the attribute data to the $data array
            $data[] = [
                'code'   => $code,
                'status' => 0,
            ];
        }

        // Wrap the insert operation in a transaction for performance and data integrity
        DB::transaction(function () use ($data) {
            foreach ($data as $key => $familyData) {
                $familyId = DB::table('attribute_families')->insertGetId($familyData);
                $this->generateTranslationData($familyId);
            }

        });

        return count($data);
    }

    /**
     * Generate additional data for categories.
     */
    protected function generateTranslationData($familyId)
    {
        $locale = $this->getLocale();

        // Create a random attribute name using Faker's word generator
        $FamilyName = 'Family '.ucfirst($this->faker->word);  // Capitalized for proper naming

        // Insert translation data into the 'attribute_translations' table
        DB::table('attribute_family_translations')->insert([
            'locale'              => $locale,
            'name'                => $FamilyName,
            'attribute_family_id' => $familyId,
        ]);

        $this->generateGroupMappingData($familyId);
    }

    protected function generateGroupMappingData($familyId)
    {
        $defaultGroupMapping = $this->getDefaultGroupMapping();
        // Insert translation data into the 'attribute_translations' table

        $position = 1;
        foreach ($defaultGroupMapping as $key => $mapping) {
            $mappedGroupId = DB::table('attribute_family_group_mappings')->insertGetId([
                'attribute_family_id' => $familyId,
                'attribute_group_id'  => $key,
                'position'            => $position,
            ]);

            $this->generateAttributeMappingData($mapping, $mappedGroupId, $position);

            $position++;
        }
    }

    protected function generateAttributeMappingData($attributeIds, $mappedGroupId, $position)
    {
        if ($position == 1) {
            $attributeIds = array_merge($attributeIds, DB::table('attributes')->inRandomOrder()->limit(5)->pluck('id')->toArray());
        }

        $position = 1;
        $attributeMapping = [];

        foreach ($attributeIds as $attributeId) {
            $attributeMapping[] = [
                'attribute_id'              => $attributeId,
                'attribute_family_group_id' => $mappedGroupId,
                'position'                  => $position,
            ];

            $position++;
        }
        // Insert translation data into the 'attribute_translations' table
        DB::table('attribute_group_mappings')->insert($attributeMapping);
    }

    public function getDefaultGroupMapping()
    {
        $familyId = DB::table('attribute_families')->where('code', 'default')->value('id') ?? $this->getFamilyId();

        $defaultFamilyMapping = DB::table('attribute_family_group_mappings')
            ->join('attribute_group_mappings', 'attribute_group_mappings.attribute_family_group_id', '=', 'attribute_family_group_mappings.id')
            ->where('attribute_family_group_mappings.attribute_family_id', $familyId)
            ->get()
            ->toArray();

        $defaultGroupMappings = [];

        foreach ($defaultFamilyMapping as $mapping) {

            $defaultGroupMappings[$mapping->attribute_group_id][] = $mapping->attribute_id;
        }

        return $defaultGroupMappings;
    }
}
