<?php
namespace TestFramework\Module\src\Module;

use TestFramework\Module\src\Module\Source\PathInterface;
use TestFramework\Module\src\Module\Task\TaskInterface;
use TestFramework\Module\src\Module\Executor\ExecutorInterface;

class Module
{
    /**
     * @var PathInterface
     */
    protected $path = null;

    /**
     * @var ExecutorInterface
     */
    protected $executor = null;

    /**
     * @var TaskInterface[]
     */
    protected $tasks = array();

    protected $name = 'Unknown module';

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param PathInterface $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param ExecutorInterface $executor
     * @return $this
     */
    public function setExecutor(ExecutorInterface $executor)
    {
        $this->executor = $executor;
        return $this;
    }

    /**
     * @param TaskInterface $task
     * @return $this
     */
    public function addTask(TaskInterface $task) {
        $this->tasks[] = $task;
        return $this;
    }

    public function prepare()
    {
        foreach ($this->tasks as $task) {
            $task->apply();
        }
    }

    public function start()
    {
        if (null === $this->executor) {
            return;
        }
        echo $this->name . ': ';
        $pid = $this->executor->start($this->path);
        echo  ' with PID: ' . $pid . PHP_EOL;
    }

    public function kill()
    {
        if (null === $this->executor) {
            return;
        }
        echo $this->name . ': ';
        $pid = $this->executor->kill();
        echo  ' for PID: ' . $pid . PHP_EOL;
    }

    public function cleanUp()
    {
        foreach ($this->tasks as $task) {
            $task->cleanUp();
        }
    }
}
