<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Domain;

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
        public readonly bool $isReservedSeat
    ) {
    }
}
