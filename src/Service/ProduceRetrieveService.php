<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\ProduceType;
use App\Repository\ProduceRepository;

final readonly class ProduceRetrieveService implements ProduceRetrieveServiceInterface
{
    public function __construct(
        private ProduceRepository $repository
    ) {
    }

    public function retrieveByType(ProduceType $type): array
    {
        return $this->repository->findBy(['type' => $type->value]);
    }

    public function retrieveAll(): array
    {
        return $this->repository->findAll();
    }
}