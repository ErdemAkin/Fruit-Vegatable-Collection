<?php

declare(strict_types=1);

namespace App\Factory;

use App\Collection\ProducesCollection;
use App\Collection\ProducesCollectionInterface;
use App\Collection\SearchableCollectionInterface;
use App\DTO\ProduceInterface;
use App\Enum\ProduceType;
use App\Service\ProduceRetrieveServiceInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final readonly class ProduceCollectionFactory implements ProduceCollectionFactoryInterface
{
    public function __construct(
        private ProduceRetrieveServiceInterface $produceRetrieveService,
        private DenormalizerInterface $denormalizer,
    ) {
    }

    public function generateCollection(ProduceType $type): ProducesCollectionInterface
    {
        $produceEntities = $this->produceRetrieveService->retrieveByType($type);
        $producesCollection = new ProducesCollection();

        return $this->create(
            $producesCollection,
            $produceEntities
        );
    }

    public function generateSearchableCollection(): SearchableCollectionInterface
    {
        $produceEntities = $this->produceRetrieveService->retrieveAll();
        $producesCollection = new ProducesCollection();

        return $this->create(
            $producesCollection,
            $produceEntities
        );
    }

    private function create(
        ProducesCollection $producesCollection,
        ?array $produceEntities
    ): ProducesCollectionInterface {
        if (empty($produceEntities) === true) {
            return $producesCollection;
        }

        foreach ($produceEntities as $produceEntity) {
            $item = $this->denormalizer->denormalize($produceEntity, ProduceInterface::class);

            $producesCollection->add($item);
        }

        return $producesCollection;
    }
}