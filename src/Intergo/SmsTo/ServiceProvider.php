<?php 

namespace Intergo\SmsTo;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Support\Facades\Blade;
use Intergo\SmsTo\SmsTo;

class ServiceProvider extends BaseServiceProvider {
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/smsto.php' => config_path('smsto.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../../views' => resource_path('views/vendor/smsto'),
        ], 'views');

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/smsto.php', 'smsto'
        );

        $this->loadViewsFrom(__DIR__.'/../../views', 'smsto');

        // @error
        // Blade::directive('error', function ($expression) {
        //     return '';
        // });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravel-smsto', function() {
            return new SmsTo();
        });
    }

}
