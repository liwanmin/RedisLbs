<?php

namespace Liwanmin\RedisLbs;

use Illuminate\Support\ServiceProvider;

class RedisLbsProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @deprecated Implement the \Illuminate\Contracts\Support\DeferrableProvider interface instead. Will be removed in Laravel 5.9.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../../config/config.php' => config_path('redis-lbs.php')
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../../config/config.php', 'redis-lbs');

        $this->app->singleton('redis-lbs', function ($app) {
            $config = $app->config->get('redis-lbs');
            return new RedisLbs($config);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'redis-lbs'
        ];
    }
}