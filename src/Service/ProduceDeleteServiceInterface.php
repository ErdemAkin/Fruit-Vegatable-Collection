<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\ProduceType;

interface ProduceDeleteServiceInterface
{
    public function remove(ProduceType $type, int $id): void;
}