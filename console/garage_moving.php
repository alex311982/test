<?php

use Framework\Application;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

require __DIR__.'/../vendor/autoload.php';

try {
    $app = new Application();
    $app->bootstrap();

    /** @var \Symfony\Component\DependencyInjection\ContainerInterface $container */
    $container = $app->getContainer();

    $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../app/config'));
    $loader->load('services.yml');

    /** @var \Doctrine\Common\Collections\Collection $vehicles */
    $vehicles = $container->get('garage.manager')->createGarage();

    if ($vehicles->isEmpty()) {
        echo $container->getParameter('garage.messageEmpty');
        echo PHP_EOL;
    }

    /** @var \Framework\Vehicle\VehicleInterface $vehicle */
    foreach ($vehicles as $vehicle) {
        echo $vehicle->getName();
        echo PHP_EOL;
        echo '---------------------';
        echo PHP_EOL;
        $vehicle->executeCommands();
    }
} catch (\Exception $e) {
    echo $e->getMessage();
    echo PHP_EOL;
}
