<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ProduceEntity;
use App\Enum\ProduceType;

interface ProduceRetrieveServiceInterface
{
    /**
     * @return ProduceEntity[]
     */
    public function retrieveByType(ProduceType $type): array;

    /**
     * @return ProduceEntity[]
     */
    public function retrieveAll(): array;
}