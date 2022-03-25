<?php

declare(strict_types=1);

namespace Tekihei2317\Core\UseCases;

use Tekihei2317\Core\Domain\Ticket;

/**
 * 料金を計算する
 */
final class CalculateFare
{
    public function run(Ticket $ticket)
    {
        $baseFareAction = new CalculateBaseFare();
        $expressFareAction = new CalculateExpressFare();

        return $baseFareAction->run($ticket) + $expressFareAction->run($ticket);
    }
}
