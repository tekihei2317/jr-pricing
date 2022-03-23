<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Domain;

/**
 * 料金
 */
final class Fare
{
    public function __construct(
        private BaseFare $baseFare,
        private ExpressFare $expressFare,
    ) {
    }

    public function calculate(Ticket $ticket)
    {
        return $this->baseFare->calculate($ticket) + $this->expressFare->calculate($ticket);
    }
}
