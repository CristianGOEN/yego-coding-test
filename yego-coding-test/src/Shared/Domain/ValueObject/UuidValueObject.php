<?php

declare(strict_types=1);

namespace Yego\Shared\Domain\ValueObject;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Yego\Shared\Domain\Exception\UuidIsInvalid;

class UuidValueObject
{
    public function __construct(private string $value)
    {
        $this->ensureIsValidUuid($value);
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function ensureIsValidUuid(string $id): void
    {
        if (!RamseyUuid::isValid($id)) {
            throw new UuidIsInvalid();
        }
    }

    public function __toString()
    {
        return $this->value();
    }
}
