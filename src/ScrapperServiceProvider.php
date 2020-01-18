<?php
namespace Larasync\Scrapper;

use Illuminate\Support\ServiceProvider;

class ScrapperServiceProvider extends ServiceProvider
{

    public function boot()
    {

//        $this->loadMigrationsFrom(__DIR__.'/Database/migrations/');

        $this->publishes([
            __DIR__.'/config/scrapper.php' => config_path('scrapper.php'),
        ]
            , 'scrapper');

        $this->publishes([
            __DIR__.'/Database/migrations/' => database_path('migrations')
        ], 'scrapper');

    }

    public function register()
    {

        // Load the config file and merge it with the user's (should it get published)
//        $this->mergeConfigFrom( __DIR__.'/config/scrapper.php', 'scrapper');

    }

}
