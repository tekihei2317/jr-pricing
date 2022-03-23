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

    public function calculate(Ticket $ticket)
    {
        if ($ticket->isAdult) {
            return 8910;
        } else {
            return 0;
        }
    }
}
