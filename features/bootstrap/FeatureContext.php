<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Doctrine\Common\Collections\Collection;
use Framework\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

define('PATH_CONFIG', '/../garage/config/');

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends TestCase implements Context
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * @var Collection
     */
    protected $vehicles;

    /**
     * @var \Exception
     */
    protected $exception;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        parent::__construct();

        $app = new Application();
        $app->bootstrap();

        /** @var \Symfony\Component\DependencyInjection\ContainerInterface $container */
        $this->container = $app->getContainer();
    }

    /**
     * @When /^I call with config name (.+)$/
     */
    public function callExecutionCommandsWithConfig($configName)
    {
        try {
            $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__ . PATH_CONFIG));
            $loader->load($configName);

            /** @var Collection $vehicles */
            $this->vehicles = $this->container->get('garage.manager')->createGarage();
        } catch (\Exception $e) {
            $this->exception = $e;
        }
    }

    /**
     * @Then /^I should get result (.+)$/
     */
    public function moveVehicles($result)
    {
        $resultArr = explode('\n', $result);

        if ($this->vehicles->isEmpty()) {
            $this->assertEquals($result, $this->container->getParameter('garage.messageEmpty'));

            return;
        }

        ob_start();
        /** @var \Framework\Vehicle\VehicleInterface $vehicle */
        foreach ($this->vehicles as $vehicle) {
            echo $vehicle->getName();
            echo PHP_EOL;
            $vehicle->executeCommands();
        }
        $out = ob_get_contents();

        $outArr = explode(PHP_EOL, $out);

        $this->assertEquals($resultArr, $outArr);

        ob_end_clean();
    }

    /**
     * @Then /^I should get exception with (.+)$/
     */
    public function moveVehiclesWithExceptions($result)
    {
        if (is_null($this->exception)) {
            $this->assertTrue(false, 'There was not any exception');

            return;
        }

        $msg = $this->exception->getMessage();

        $this->assertContains($result, $msg);

        $this->exception = null;
    }
}
