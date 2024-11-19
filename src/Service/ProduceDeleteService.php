<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\ProduceEntity;
use App\Enum\ProduceType;
use Doctrine\ORM\EntityManagerInterface;

final readonly class ProduceDeleteService implements ProduceDeleteServiceInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }


    public function remove(ProduceType $type, int $id): void
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->delete(ProduceEntity::class, 'produce')
            ->where('produce.type = :type')
            ->andWhere('produce.id = :id')
            ->setParameter('type', $type)
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleScalarResult();
    }
}