<?php
namespace TestFramework\Module\src\Module\Task;

interface TaskInterface
{
    public function apply();

    public function cleanUp();
}