<?php
/**
 * Created by PhpStorm.
 * User: agubarev
 * Date: 9/19/2017
 * Time: 7:38 PM
 */

namespace Tests\Ecomitize\Garage;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ecomitize\Garage\VehicleManager;
use Framework\Factory\VehicleFactoryInterface;
use PHPUnit\Framework\TestCase;

class VehicleManagerTest extends TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $factory;

    public function setUp()
    {
       $this->factory = $this->createMock(VehicleFactoryInterface::class);

        $map = [
            [[], new ArrayCollection],
            [['vehicle_1', 'vehicle_2'], new ArrayCollection(['vehicle_1_resolved', 'vehicle_2_resolved'])],
        ];

        $this->factory->expects(($this->once()))
            ->method('processVehicles')
            ->will($this->returnValueMap($map));
    }

    /**
     * @dataProvider dataProviderVehicles
     */
    public function testCreateGarage(?array $vehicles)
    {
        $manager = new VehicleManager($this->factory, $vehicles);

        $vehicles = $manager->createGarage();

        $this->assertInstanceOf(Collection::class, $vehicles);
        $this->assertCount(count($vehicles), $vehicles);
    }

    public function dataProviderVehicles()
    {
        return [
            [null],
            [['vehicle_1', 'vehicle_2']],
        ];
    }
}
