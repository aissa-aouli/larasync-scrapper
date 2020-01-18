<?php

namespace Larasync\Scrapper\Navigation;

use Exception;
use Nesk\Puphpeteer\Puppeteer;

class NormalNavigation implements Navigator
{

    /**
     * @param array $config
     * @return mixed
     * @throws Exception
     */

    public function openPage(array $config)
    {
        // TODO: Implement open() method.
        $puppeteer = new Puppeteer(
            [
                // How much time (in seconds) the process can stay inactive before being killed (set to null to disable)
                'idle_timeout' => null,
                // How much time (in seconds) an instruction can take to return a value (set to null to disable)
                'read_timeout' => null,
                // How much time (in seconds) the process can take to shutdown properly before being killed
                'stop_timeout' => null,
                // A logger instance for debugging (must implement \Psr\Log\LoggerInterface)
                'logger' => null,
                // Logs the output of console methods (console.log, console.debug, console.table, etc...) to the PHP logger
                'log_node_console' => false,
                // Enables debugging mode:
                //   - adds the --inspect flag to Node's command
                //   - appends stack traces to Node exception messages
                'debug' => false,
            ]
        );

        $initial_config = app('config')->get('scrapper');

        if (!$initial_config && !count($config)){
            throw new Exception('Scrapper config file not set, try setting initial configuration or define $config array');
        }

        if (count($config)){
            $initial_config = $config;
        }

        $browser = $puppeteer->launch($initial_config);
        $page = $browser->newPage();
        $page->setViewport(['width' => 1920,'height' => 1080]);

        return $page;
    }
}
