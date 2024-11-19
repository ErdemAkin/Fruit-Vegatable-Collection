<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\ProduceInterface;
use App\Entity\ProduceEntity;
use Doctrine\ORM\EntityManagerInterface;

final readonly class ProduceStorageService implements ProduceStorageServiceInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function insert(ProduceInterface $produce): void
    {
        $this->persistProduce($produce);
        $this->entityManager->flush();
    }

    /**
     * @param ProduceInterface[] $produces
     */
    public function insertBulk(array $produces): void
    {
        $batch = 0;
        foreach ($produces as $produce) {
            $this->persistProduce($produce);
            if ($batch % 100 === 0) {
                $this->entityManager->flush();
            }
        }
        $this->entityManager->flush();
    }

    private function persistProduce(ProduceInterface $produce): void
    {
        $entity = new ProduceEntity();
        $entity->fillFromDto($produce);

        $this->entityManager->persist($entity);
    }
}