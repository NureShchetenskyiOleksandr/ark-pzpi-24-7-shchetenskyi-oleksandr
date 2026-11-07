<?php

declare(strict_types=1);

namespace App\Service;

use InvalidArgumentException;

final class PriceCalculator
{
    public const MAX_DISCOUNT = 50;

    public function applyDiscount(float $price, int $percent): float
    {
        if ($percent < 0 || $percent > self::MAX_DISCOUNT) {
            throw new InvalidArgumentException('Invalid discount');
        }

        return $price * (100 - $percent) / 100;
    }
}