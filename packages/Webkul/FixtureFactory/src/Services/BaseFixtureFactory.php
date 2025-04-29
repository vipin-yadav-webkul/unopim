<?php

namespace Webkul\FixtureFactory\Services;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

abstract class BaseFixtureFactory
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
        $this->faker->addProvider(new \Webkul\FixtureFactory\Faker\FakerProvider($this->faker));
    }

    abstract public function generate($index, int $count, $chunkSize);

    public function getLocale(array $parameters = [])
    {
        return $parameters['default_locale'] ?? config('app.locale');
    }

    public function getChannel(array $parameters = [])
    {
        return $parameters['default_channel'] ?? config('app.channel');
    }

    public function getCurrency(array $parameters = [])
    {
        return $parameters['default_currency'] ?? config('app.currency');
    }

    /**
     * Generate a unique SKU.
     */
    protected function generateCode($table)
    {
        $firstChar = $this->faker->regexify('[a-zA-Z]');
        $rest = $this->faker->regexify('[a-zA-Z0-9_]{5,10}');
        $code = $firstChar.$rest;

        // Check if SKU already exists
        while ($this->isCodeExist($code, $table)) {
            $firstChar = $this->faker->regexify('[a-zA-Z]');
            $rest = $this->faker->regexify('[a-zA-Z0-9_]{5,10}');
            $code = $firstChar.$rest;
        }

        return $code;
    }

    /**
     * Check if the SKU already exists in the database.
     */
    protected function isCodeExist($code, $table, $field = 'code'): int
    {
        return DB::table($table)->where($field, $code)->count();
    }
}
