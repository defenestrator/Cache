<?php

namespace Laracasts\Cache;

use Blade;
use Illuminate\Support\ServiceProvider;

class CacheServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('cache', function ($expression) {
            return "<?php if (! app('Laracasts\Cache\BladeDirective')->setUp{$expression}) { ?>";
        });

        Blade::directive('endcache', function () {
            return "<?php } echo app('Laracasts\Cache\BladeDirective')->tearDown() ?>";
        });    
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Laracasts\Cache\BladeDirective', function ($app) {
            $doll = new \Laracasts\Cache\RussianDoll(
                $app->make('cache.store')
            );

            return new BladeDirective($doll);
        });
    }

}
