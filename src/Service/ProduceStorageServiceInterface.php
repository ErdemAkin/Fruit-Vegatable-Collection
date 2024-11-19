<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\ProduceInterface;

interface ProduceStorageServiceInterface
{
    public function insert(ProduceInterface $produce): void;

    /**
     * @param ProduceInterface[] $produces
     */
    public function insertBulk(array $produces): void;
}