<?php

declare(strict_types=1);

namespace App\Collection;

use App\DTO\ProduceInterface;

interface ProducesCollectionInterface
{
    public function add(ProduceInterface $item): void;

    /**
     * @return ProduceInterface[]
     */
    public function list(): array;

    public function remove(int $id): void;
}