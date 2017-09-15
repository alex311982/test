<?php

namespace Ecomitize\Garage;

use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Collections\Collection;
use Framework\Exception\InstanceIsNotSetException;
use Framework\Factory\VehicleFactoryInterface;

class VehicleManager
{
    protected $factory;

    protected $vehicles;
    /**
     * VehicleManager constructor.
     */
    public function __construct(VehicleFactoryInterface $factory, array $vehicles)
    {
        $this->factory = $factory;
        $this->vehicles = $vehicles;
    }

    public function createGarage(): Collection
    {
        return $this->getFactory()->processVehicles($this->getVehicles());
    }

    protected function getFactory(): VehicleFactoryInterface
    {
        if (!$this->factory instanceof VehicleFactoryInterface) {
            throw new InstanceIsNotSetException('Factory is no set for class ' . __CLASS__);
        }
        return $this->factory;
    }

    protected function getVehicles(): array
    {
        if (is_null($this->vehicles)) {
            $this->vehicles = [];
        }
        return $this->vehicles;
    }
}
