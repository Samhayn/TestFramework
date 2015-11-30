<?php
namespace TestFramework\Module\src\Module\Executor;

use TestFramework\Module\src\Module\Source\PathInterface;

class PhpBuiltIn extends AbstractExecutor
{
    const TYPE = 'phpBuiltIn';

    public function start(PathInterface $path)
    {
        $this->extractHostAndPort();

        $webServerMode = '';

        if (is_dir($path->getPath())) {
            $webServerMode = '-t';
        }

        $command = sprintf(
            'php -S %s:%d %s "%s" >/dev/null 2>&1 & echo $!',
            $this->host,
            $this->port,
            $webServerMode,
            $path->getPath()
        );

        $this->killServersByPort($this->port);

        $output = array();
        exec($command, $output, $returnValue);

        if ($returnValue) {
            die('Execution failed');
            return false;
        }

        $this->PID = (int) $output[0];
        echo sprintf('Start web-server %s:%d', $this->host, $this->port);
        return $this->PID;
    }

    protected function extractHostAndPort() {
        switch ($this->config['configuration']) {
            case 'appConfig':
                $automatedTestConfig = include PROJECT_ROOT . '/config/autoload/acceptance/automatedtests.php';
                $configPath = explode('/', $this->config['config']);

                $element = $automatedTestConfig;
                foreach ($configPath as $configLevel) {
                    $element = $element[$configLevel];
                }

                switch ($this->config['format']) {
                    case 'array':
                        $this->host = $element['host'];
                        $this->port = $element['port'];
                        break;
                    case 'parseUrl':
                        $urlParts = parse_url($element);

                        $this->host = $urlParts['host'];
                        $this->port = $urlParts['port'];
                        break;
                }
                break;
            case 'defined':
                $this->host = $this->config['host'];
                $this->port = (int)$this->config['port'];
                break;
        }
    }
}
