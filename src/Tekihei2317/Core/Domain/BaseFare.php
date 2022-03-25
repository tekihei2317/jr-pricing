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
        $fare = $ticket->getBaseFare();

        if (!$ticket->isAdult) {
            assert($fare % 10 === 0);

            // 子供は半額(5円の端数は切り捨て)
            $fare = $fare / 2;
            $fare -= $fare % 10;
        }

        if (!$ticket->isOneWay) {
            if ($ticket->isRoundTripDiscountTarget()) {
                // 往復割引は1割引(10円未満は切り捨て)
                $fare = (int)($fare * 0.9);
                $fare = ((int)($fare / 10)) * 10;
            }

            $fare *= 2;
        }

        return $fare;
    }
}
