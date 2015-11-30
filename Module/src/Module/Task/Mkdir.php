<?php
namespace TestFramework\Module\src\Module\Task;

class Mkdir implements TaskInterface
{
    const TASK = 'mkdir';

    private $path = [];

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function apply()
    {
        if (!file_exists($this->path)) {
            mkdir($this->path);
        }
    }

    public function cleanUp()
    {
        exec('rm -r ' . $this->path);
    }
}