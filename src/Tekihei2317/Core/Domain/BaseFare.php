<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Domain;

/**
 * 運賃
 */
final class BaseFare
{
    public function __construct()
    {
    }

    public function calculate(Ticket $ticket): int
    {
        $fare = 8910;

        if (!$ticket->isAdult) {
            assert($fare % 10 === 0);

            $fare = $fare / 2;
            $fare -= $fare % 10;
        }

        return $fare;
    }
}
