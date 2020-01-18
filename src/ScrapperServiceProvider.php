<?php
namespace Larasync\Scrapper;

use Illuminate\Support\Facades\Artisan;
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

//        $this->publishes([
//            __DIR__.'/Database/migrations/' => database_path('migrations')
//        ], 'scrapper');

        if (! class_exists( 'CreateProxiesTable')) {
            $this->publishes([
                __DIR__.'/Database/migrations/create_proxies_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_proxies_table.php'),
            ], 'scrapper');
        }

        if (! class_exists('\database\migrations\CreateUserAgentsTable')) {
            $this->publishes([
                __DIR__.'/Database/migrations/create_user_agents_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_user_agent_table.php'),
            ], 'scrapper');
        }

        Artisan::call('vendor:publish',[
//            '--provider' => 'Package\MyPackage\CoreServiceProvider',
            '--tag' => ['scrapper'],
        ]);
    }

    public function register()
    {

        // Load the config file and merge it with the user's (should it get published)
//        $this->mergeConfigFrom( __DIR__.'/config/scrapper.php', 'scrapper');

    }

}
