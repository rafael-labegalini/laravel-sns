<?php

namespace Solpac\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelSnsServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/sns.php' => config_path('topics.php')
        ]);
    }
}