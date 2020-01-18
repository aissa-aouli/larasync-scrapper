<?php
namespace Larasync\Scrapper;
use Illuminate\Support\ServiceProvider;

class ScrapperServiceProvider extends ServiceProvider
{

    public function boot()
    {
        /**
         * Publishing service provider for users to modify if needed.
         */

        $this->publishes([
            __DIR__ . '/ScrapperServiceProvider.php' => app_path('Providers/ScrapperServiceProvider.php'),
        ], 'scrapper-provider');

        $this->loadMigrationsFrom(__DIR__.'/Database/migrations/');

        $this->publishes([
            __DIR__.'/config/scrapper.php' => config_path('scrapper.php'),
        ], 'config');

    }

    public function register()
    {

        // Load the config file and merge it with the user's (should it get published)
//        $this->mergeConfigFrom( __DIR__.'/config/scrapper.php', 'scrapper');

    }

}
