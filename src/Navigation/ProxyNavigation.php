<?php
namespace Larasync\Scrapper\Navigation;

use Exception;
use Larasync\Scrapper\Models\Proxy;
use Nesk\Puphpeteer\Puppeteer;

class ProxyNavigation implements Navigator
{

    private $proxy;


    /**
     * ProxyNavigation constructor.
     * @param Proxy $proxy
     */

    public function __construct(Proxy $proxy)
    {
        $this->proxy = $proxy;
    }

    /**
     * @param array $config - Optional array to override initial configuration set in config/scrapper.php
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

        if ($this->proxy->status != '1'){
            throw new Exception('Proxy is disabled');
        }

        if (count($config)){
            $initial_config = $config;
        }

        $initial_config['args'][] = '--proxy-server='.$this->proxy->ip_address.'';

        $local_folder_ending = '_'.$this->proxy->id;

        $user_agent = $this->proxy->user_agent();

        if ($user_agent){
            $initial_config['args'][] = '--user-agent='.$user_agent->user_agent_string.'';
            $local_folder_ending = $local_folder_ending . '_'.$user_agent->id;
        }

        $initial_config['userDataDir'] = $initial_config['userDataDir'].$local_folder_ending;

        $browser = $puppeteer->launch($initial_config);
        $page = $browser->newPage();
        $page->setViewport(['width' => 1920,'height' => 1080]);

        return $page;
    }
}
