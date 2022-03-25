<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Domain;

use Tekihei2317\Core\UseCases\CalculateBaseFare;
use Tekihei2317\Core\UseCases\CalculateExpressFare;

/**
 * 料金
 */
final class Fare
{
    public function __construct(
        private CalculateBaseFare $baseFare,
        private CalculateExpressFare $expressFare,
    ) {
    }

    public function calculate(Ticket $ticket)
    {
        return $this->baseFare->run($ticket) + $this->expressFare->run($ticket);
    }
}
