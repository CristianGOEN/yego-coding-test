<?php

declare(strict_types=1);

namespace Yego\Shared\Domain\Exception;

use Yego\Shared\Domain\DomainError;

final class LengthIsInvalid extends DomainError
{
    public function errorCode(): string
    {
        return 'string_length_invalid';
    }

    protected function errorMessage(): string
    {
        return 'Invalid length';
    }
}
