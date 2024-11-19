<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Exception\UnexpectedValueException;

class ProduceAlreadyExistsException extends UnexpectedValueException implements ProduceExceptionInterface
{
    public function __construct()
    {
        parent::__construct('Item already exists.');
    }
}