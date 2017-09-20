<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Doctrine\Common\Collections\Collection;
use Ecomitize\Garage\VehicleManager;
use Framework\Application;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
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
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $app = new Application();
        $app->bootstrap();

        /** @var \Symfony\Component\DependencyInjection\ContainerInterface $container */
        $this->container = $app->getContainer();
    }

    /**
     * @Given /^config file by path (.+)$/
     */
    public function loadConfig($path)
    {
        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__ . $path));
        $loader->load('services.yml');
    }

    /**
     * @When /^I call for moving vehicles (.+)$/
     */
    public function getVehicleInstances($vehicles)
    {
        $vehicles = explode(',', $vehicles);

        /** @var Collection $vehicles */
        $this->vehicles = $this->container->get('garage.manager')->createGarage();
    }

    /**
     * @Then /^I should get result (.+)$/
     */
    public function moveVehicles($result)
    {
        try {
            if ($this->vehicles->isEmpty()) {
                echo $this->container->getParameter('garage.messageEmpty');
            }

            /** @var \Framework\Vehicle\VehicleInterface $vehicle */
            foreach ($this->vehicles as $vehicle) {
                echo $vehicle->getName();
                echo ":";
                $vehicle->executeCommands();
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
