<?php

declare(strict_types=1);

namespace Yego\Shared\Domain;

use DateTime;

final class Utils
{
    public static function formatDate(DateTime $date): DateTime
    {
        return new DateTime($date->format("Y-m-d"));
    }
}
