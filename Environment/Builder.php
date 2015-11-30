<?php

namespace TestFramework\Environment;

use TestFramework\Exceptions\ConfigurateEnvironment;

class Builder
{
    public function build(array $activeConfigurations)
    {
        foreach ($activeConfigurations as $configurationName) {
            $className = __NAMESPACE__ . '\\Configuration\\' . $configurationName;
            $configuration = new $className();
            if (!$configuration->setUp()) {
                throw new ConfigurateEnvironment($className);
            }
            register_shutdown_function(array($configuration, 'tearDown'));
        }
        return true;
    }
}