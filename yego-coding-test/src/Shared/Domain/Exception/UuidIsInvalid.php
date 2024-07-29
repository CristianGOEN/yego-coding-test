<?php

declare(strict_types=1);

namespace Yego\Shared\Domain\Exception;

use Yego\Shared\Domain\DomainError;

final class UuidIsInvalid extends DomainError
{
    public function errorCode(): string
    {
        return 'uuid_is_invalid';
    }

    protected function errorMessage(): string
    {
        return 'Uuid provided value is invalid';
    }
}
