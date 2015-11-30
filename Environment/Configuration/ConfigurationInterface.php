<?php
namespace TestFramework\Environment\Configuration;

/**
 * Describe acceptance test configuration environment unit.
 * One configuration contains setUp and tearDown actions.
 *
 */
interface ConfigurationInterface
{
    /**
     * Calls before tests execution
     *
     * @return mixed
     */
    public function setUp();

    /**
     * Calls after tests execution
     *
     * @return mixed
     */
    public function tearDown();
}