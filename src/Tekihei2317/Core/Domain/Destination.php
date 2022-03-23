<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Domain;

/**
 * 目的地
 */
final class Destination
{
    public function __construct(
        private Station $station,
        private int $distance,
        private int $baseFare,
        private int $expressFare,
    ) {
    }

    public function baseFare(): int
    {
        return $this->baseFare;
    }

    public function expressFare(): int
    {
        return $this->expressFare;
    }

    public function isRoundTripDiscountTarget(): bool
    {
        return $this->distance >= 601;
    }
}
