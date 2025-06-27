<?php

namespace App\Providers;

use Faker\Factory;
use Faker\Generator;
use Bluemmb\Faker\PicsumPhotosProvider;
use Faker\Provider\Youtube;
use Illuminate\Support\ServiceProvider;

class CustomFakerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Generator::class, function () {
            $faker = Factory::create();
            $faker->addProvider(new PicsumPhotosProvider($faker));
            $faker->addProvider(new Youtube($faker));
            return $faker;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
