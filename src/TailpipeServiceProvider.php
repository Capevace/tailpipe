<?php

namespace Tailpipe;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class TailpipeServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        // Register the main class to use with the facade
        $this->app->singleton('tailpipe', function () {
            return new Tailpipe;
        });
    }

	/**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->registerBladeDirective();
    }

    /**
     * Register the custom Blade directive.
     */
    protected function registerBladeDirective()
    {
        Blade::directive('tailpipe', function ($expression) {
            return "<?php echo tailpipe({$expression}); ?>";
        });
    }
}
