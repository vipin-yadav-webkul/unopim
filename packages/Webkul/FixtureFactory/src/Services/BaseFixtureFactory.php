<?php

namespace Webkul\FixtureFactory\Services;

use Faker\Factory as Faker;

class BaseFixtureFactory
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
        $this->faker->addProvider(new \Webkul\FixtureFactory\Faker\FakerProvider($this->faker));
    }


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
}