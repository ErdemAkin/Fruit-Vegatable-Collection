<?php

declare(strict_types=1);

namespace App\Factory;

use App\Collection\ProducesCollectionInterface;
use App\Collection\SearchableCollectionInterface;
use App\Enum\ProduceType;

interface ProduceCollectionFactoryInterface
{
    public function generateCollection(ProduceType $type): ProducesCollectionInterface;

    public function generateSearchableCollection(): SearchableCollectionInterface;
}