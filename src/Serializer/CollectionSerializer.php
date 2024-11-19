<?php

declare(strict_types=1);

namespace App\Serializer;

use App\Collection\ProducesCollectionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final readonly class CollectionSerializer implements NormalizerInterface
{
    public function __construct(
        private readonly NormalizerInterface $produceSerializer,
    ) {
    }

    /**
     * @param ProducesCollectionInterface $object
     */
    public function normalize(
        mixed $object,
        ?string $format = null,
        array $context = []
    ): array {
        $response = [];
        foreach ($object->list() as $data) {
            $response[] = $this->produceSerializer->normalize($data, context: $context);
        }

        return $response;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof ProducesCollectionInterface;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            ProducesCollectionInterface::class => true,
        ];
    }
}