<?php
namespace TestFramework\Module\src;

use TestFramework\Module\src\Module\Module;
use TestFramework\Module\src\Module\Source\FileSystem;
use TestFramework\Module\src\Module\Task\Mkdir;
use TestFramework\Module\src\Module\Executor\PhpBuiltIn;
use TestFramework\Module\src\Module\Executor\PhpConsole;

class Runner
{
    /**
     * @var Module\Module[]
     */
    private $modules = [];

    public function __construct(array $config)
    {
        $this->modules = $this->buildModules($config);
    }

    public function prepare()
    {
        foreach ($this->modules as $module) {
            $module->prepare();
        }
    }

    public function start()
    {
        foreach ($this->modules as $module) {
            $module->start();
        }
        usleep(50000);
    }

    public function kill()
    {
        foreach ($this->modules as $module) {
            $module->kill();
        }
    }

    public function cleanUp()
    {
        foreach ($this->modules as $module) {
            $module->cleanUp();
        }
    }

    /**
     * @param array $config
     * @return Module[]
     */
    private function buildModules(array $config) {
        $modules = [];
        foreach ($config as $moduleName => $moduleConfig) {
            $module = new Module($moduleName);

            if (!empty($moduleConfig['task'])) {
                if (!empty($moduleConfig['task'][Mkdir::TASK])) {
                    $module->addTask(new Mkdir($moduleConfig['task'][Mkdir::TASK]));
                }
            }

            if (!empty($moduleConfig['source'])) {
                $module->setPath(new FileSystem($moduleConfig['source']));
            }

            if (!empty($moduleConfig['executor'])) {
                switch ($moduleConfig['executor']['type']) {
                    case PhpBuiltIn::TYPE:
                        $module->setExecutor(new PhpBuiltIn($moduleConfig['executor']));
                        break;
                    case PhpConsole::TYPE:
                        $module->setExecutor(new PhpConsole($moduleConfig['executor']));
                        break;
                    default:
                        throw new \RuntimeException('Undefined executor type');
                }
            }

            $modules[] = $module;
        }
        return $modules;
    }
}
