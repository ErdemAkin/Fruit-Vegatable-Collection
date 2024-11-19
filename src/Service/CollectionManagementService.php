<?php

declare(strict_types=1);

namespace App\Service;

use App\Collection\ProducesCollectionInterface;
use App\DTO\ProduceInterface;
use App\Enum\ProduceType;
use App\Exception\ProduceAlreadyExistsException;
use App\Factory\ProduceCollectionFactoryInterface;

final readonly class CollectionManagementService implements CollectionManagementServiceInterface
{
    public function __construct(
        private ProduceCollectionFactoryInterface $produceCollectionFactory,
        private ProduceStorageServiceInterface $collectionStorageService,
        private ProduceDeleteServiceInterface $collectionDeleteService,
    ) {
    }

    /**
     * @throws ProduceAlreadyExistsException
     */
    public function add(ProduceInterface $input): ProducesCollectionInterface
    {
        $collection = $this->produceCollectionFactory->generateCollection($input->getType());
        $collection->add($input);

        $this->collectionStorageService->insert($input);

        return $collection;
    }

    /**
     * @param ProduceInterface[] $produces
     * @return ProducesCollectionInterface[]
     */
    public function addBulk(array $produces): array
    {
        $fruitCollection = null;
        $vegetableCollection = null;

        foreach ($produces as $produce) {
            if ($produce->getType() === ProduceType::FRUIT) {
                if ($fruitCollection === null) {
                    $fruitCollection = $this->produceCollectionFactory->generateCollection(ProduceType::FRUIT);
                }
                $fruitCollection->add($produce);
            } else {
                if ($vegetableCollection === null) {
                    $vegetableCollection = $this->produceCollectionFactory->generateCollection(ProduceType::VEGETABLE);
                }
                $vegetableCollection->add($produce);
            }
        }

        $this->collectionStorageService->insertBulk($produces);

        return [
            'fruit' => $fruitCollection,
            'vegetable' => $vegetableCollection,
        ];
    }

    public function list(ProduceType $type): ProducesCollectionInterface
    {
        return $this->produceCollectionFactory->generateCollection($type);
    }

    public function remove(ProduceType $type, int $id): void
    {
        $collection = $this->produceCollectionFactory->generateCollection($type);
        $collection->remove($id);

        $this->collectionDeleteService->remove($type, $id);
    }
}