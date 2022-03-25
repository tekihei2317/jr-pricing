<?php

declare(strict_types=1);

namespace Tekihei2317\Core\UseCases;

use Tekihei2317\Core\Domain\BaseFare;
use Tekihei2317\Core\Domain\ExpressFare;
use Tekihei2317\Core\Domain\Ticket;

final class CalculateFare
{
    public function run(Ticket $ticket)
    {
        $baseFare = new BaseFare();
        $expressFare = new ExpressFare();

        return $baseFare->calculate($ticket) + $expressFare->calculate($ticket);
    }
}
