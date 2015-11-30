<?php
namespace TestFramework\Environment\Configuration;

use TestFramework\Module\src\Runner;

class Modules implements  ConfigurationInterface
{
    /**
     * @var Runner
     */
    private $modulesRunner = null;

    public function setUp()
    {
        $config = \Codeception\Configuration::config();
        $this->modulesRunner = new Runner($config['modules']);
        $this->modulesRunner->prepare();
        $this->modulesRunner->start();
        return true;
    }

    public function tearDown()
    {
        $this->modulesRunner->kill();
        $this->modulesRunner->cleanUp();
    }
}
