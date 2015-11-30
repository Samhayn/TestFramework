<?php
namespace TestFramework\Module\src\Module\Executor;

abstract class AbstractExecutor implements ExecutorInterface
{
    protected $config = [];
    protected $PID = '';
    protected $host = 'localhost';
    protected $port = 0;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function kill()
    {
        $this->killServersByPort($this->port);
        return $this->PID;
    }

    protected function killServersByPort($port) {
        exec("lsof -i tcp:" . $port . " | awk 'NR!=1 {print $2}' | xargs kill >/dev/null 2>&1");
    }
}