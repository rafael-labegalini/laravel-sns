<?php

namespace Solpac\Providers;

use Illuminate\Support\ServiceProvider;
use Solpac\Sns\Manager;

class LaravelSnsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(Manager::class, function () {
            return new Manager(config('topics'));
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/sns.php' => config_path('topics.php')
        ]);
    }
}