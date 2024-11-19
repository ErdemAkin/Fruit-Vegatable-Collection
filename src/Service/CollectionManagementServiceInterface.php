<?php

declare(strict_types=1);

namespace App\Service;

use App\Collection\ProducesCollectionInterface;
use App\DTO\ProduceInterface;
use App\Enum\ProduceType;
use App\Exception\ProduceAlreadyExistsException;

interface CollectionManagementServiceInterface
{
    /**
     * @throws ProduceAlreadyExistsException
     */
    public function add(ProduceInterface $input): ProducesCollectionInterface;

    /**
     * @param ProduceInterface[] $produces
     * @return ProducesCollectionInterface[]
     */
    public function addBulk(array $produces): array;

    public function list(ProduceType $type): ProducesCollectionInterface;

    public function remove(ProduceType $type, int $id): void;
}