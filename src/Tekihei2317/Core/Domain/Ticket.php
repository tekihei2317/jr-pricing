<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Domain;

use Tekihei2317\Core\Subdomain\Model\Date;

/**
 * 乗車券
 */
final class Ticket
{
    public function __construct(
        public readonly bool $isAdult,
        public readonly Destination $destination,
        public readonly bool $isOneWay,
        public readonly bool $isHikari,
        public readonly bool $isReservedSeat,
        public readonly Date $departureDate,
    ) {
    }

    public function getBaseFare(): int
    {
        return $this->destination->baseFare();
    }

    public function getExpressFare(): int
    {
        return $this->destination->expressFare();
    }

    public function isRoundTripDiscountTarget(): bool
    {
        return $this->destination->isRoundTripDiscountTarget();
    }
}
