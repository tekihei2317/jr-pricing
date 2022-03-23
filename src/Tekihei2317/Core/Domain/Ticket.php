<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Domain;

final class Ticket
{
    public function __construct(
        private bool $isAdult,
        private string $destination,
        private bool $isOneWay,
        private bool $isHikari,
        private bool $isReservedSeat
    ) {
    }
}
