<?php

declare(strict_types=1);

namespace App\Entity;

use App\DTO\ProduceInterface;
use App\Enum\ProduceType;
use App\Repository\ProduceRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity(repositoryClass: ProduceRepository::class)]
#[Table(name: 'produces')]
#[ORM\UniqueConstraint(
    name: 'produce_unique',
    fields: ['id', 'type'],
)]
class ProduceEntity
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private readonly Uuid $uuid;

    #[ORM\Column(options: ['unsigned' => true])]
    private int $id;

    #[ORM\Column]
    private ProduceType $type;

    #[ORM\Column]
    private string $name;

    #[ORM\Column]
    private int $quantity;

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): ProduceType
    {
        return $this->type;
    }

    public function setType(ProduceType $type): void
    {
        $this->type = $type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function fillFromDto(ProduceInterface $produce): void
    {
        $this->id = $produce->getId();
        $this->type = $produce->getType();
        $this->name = $produce->getName();
        $this->quantity = $produce->getQuantity();
    }
}