<?php
namespace TestFramework\Module\src\Module\Executor;

use TestFramework\Module\src\Module\Source\PathInterface;

class PhpConsole extends AbstractExecutor
{
    const TYPE = 'phpConsole';

    public function start(PathInterface $path)
    {
        $this->host = $this->config['host'];
        $this->port = (int)$this->config['port'];

        $command = sprintf(
            'php %s %s %d >/dev/null 2>&1 & echo $!',
            $path->getPath(),
            $this->host,
            $this->port
        );

        $this->killServersByPort($this->port);

        $output = array();
        exec($command, $output, $returnValue);

        if ($returnValue) {
            die('Execution failed');
            return false;
        }

        $this->PID = (int) $output[0];
        echo sprintf('Start console-php-server %s:%d', $this->host, $this->port);
        return $this->PID;
    }
}