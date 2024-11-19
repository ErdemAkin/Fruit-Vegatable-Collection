<?php

declare(strict_types=1);

namespace App\Serializer;

use App\DTO\Fruit;
use App\DTO\ProduceInterface;
use App\DTO\Vegatable;
use App\Entity\ProduceEntity;
use App\Enum\ProduceType;
use App\Enum\Unit;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

final readonly class ProduceEntityDeserializer implements DenormalizerInterface
{
    public function getSupportedTypes(?string $format): array
    {
        return [
            ProduceType::class => true,
            ProduceInterface::class => true,
        ];
    }

    public function denormalize(
        mixed $data,
        string $type,
        ?string $format = null,
        array $context = []
    ): ProduceInterface {
        $item = match ($data->getType()) {
            ProduceType::FRUIT => new Fruit(),
            default => new Vegatable(),
        };

        $item->setId($data->getId());
        $item->setName($data->getName());
        $item->setUnit(Unit::GRAM);
        $item->setQuantity($data->getQuantity());

        return $item;
    }

    public function supportsDenormalization(
        mixed $data,
        string $type,
        ?string $format = null,
        array $context = []
    ): bool {
        return $data instanceof ProduceEntity === true && $type === ProduceInterface::class;
    }
}