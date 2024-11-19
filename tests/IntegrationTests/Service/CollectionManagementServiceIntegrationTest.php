<?php

declare(strict_types=1);

namespace App\Tests\IntegrationTests\Service;

use App\DTO\Fruit;
use App\Enum\ProduceType;
use App\Enum\Unit;
use App\Repository\ProduceRepository;
use App\Service\CollectionManagementServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CollectionManagementServiceIntegrationTest extends KernelTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
    }

    public function testAddFunction(): void
    {
        $container = static::getContainer();

        $produce = new Fruit();
        $produce->setId(1);
        $produce->setName('Produce');
        $produce->setQuantity(1000);
        $produce->setUnit(Unit::GRAM);

        $collectionManagementService = $container->get(CollectionManagementServiceInterface::class);
        $repository = $container->get(ProduceRepository::class);

        $collectionManagementService->add($produce);
        $produceEntity = $repository->findOneBy(
            [
                'type' => ProduceType::FRUIT,
                'id' => 1
            ]
        );

        $this->assertNotNull($produceEntity);
        $this->assertEquals($produceEntity->getId(), $produce->getId());
        $this->assertEquals($produceEntity->getName(), $produce->getName());
        $this->assertEquals($produceEntity->getType(), $produce->getType());
        $this->assertEquals($produceEntity->getQuantity(), $produce->getQuantity());
    }


}