<?php

namespace Ecomitize\Garage;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Collections\Collection;
use Framework\Exception\InstanceIsNotSetException;
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
    public function __construct(VehicleFactoryInterface $factory, array $vehicles)
    {
        $this->factory = $factory;
        $this->vehicles = $vehicles;
    }

    /**
     * @return Collection
     */
    public function createGarage(): Collection
    {
        return $this->getFactory()->processVehicles($this->getVehicles());
    }

    /**
     * @return VehicleFactoryInterface
     * @throws InstanceIsNotSetException
     */
    protected function getFactory(): VehicleFactoryInterface
    {
        if (!$this->factory instanceof VehicleFactoryInterface) {
            throw new InstanceIsNotSetException('Vehicle`s factory is no set for class ' . __CLASS__);
        }

        return $this->factory;
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
