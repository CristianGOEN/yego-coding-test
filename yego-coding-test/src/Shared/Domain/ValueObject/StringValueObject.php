<?php

declare(strict_types=1);

namespace Yego\Shared\Domain\ValueObject;

use Yego\Shared\Domain\Exception\LengthIsInvalid;

abstract class StringValueObject
{
    public function __construct(protected string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value();
    }

    public function ensureLengthIsInferiorThan(int $length): void
    {
        if (strlen($this->value) > $length) {
            throw new LengthIsInvalid();
        }
    }
}
