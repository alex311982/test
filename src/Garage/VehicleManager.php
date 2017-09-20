<?php

namespace Ecomitize\Garage;

use Doctrine\Common\Collections\Collection;
use Framework\Factory\VehicleFactoryInterface;

/**
 * Class VehicleManager
 * @package Ecomitize\Garage
 */
class VehicleManager
{
    /**
     * @var VehicleFactoryInterface
     */
    protected $factory;

    /**
     * @var array
     */
    protected $vehicles;

    /**
     * VehicleManager constructor.
     * @param VehicleFactoryInterface $factory
     * @param array $vehicles
     */
    public function __construct(VehicleFactoryInterface $factory, ?array $vehicles)
    {
        $this->factory = $factory;
        $this->vehicles = $vehicles;
    }

    /**
     * @return Collection
     */
    public function createGarage(): Collection
    {
        return $this->factory->processVehicles($this->getVehicles());
    }

    /**
     * @return array
     */
    protected function getVehicles(): array
    {
        if (is_null($this->vehicles)) {
            $this->vehicles = [];
        }

        return $this->vehicles;
    }
}
