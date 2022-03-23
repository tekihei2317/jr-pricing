<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Domain;

/**
 * 特急料金
 */
final class ExpressFare
{
    public function __construct()
    {
    }

    public function calculate(Ticket $ticket): int
    {
        $expressFare = $this->expressFareByDestination($ticket->destination);

        if (!$ticket->isAdult) {
            assert($expressFare % 10 === 0);
            // 半額(5円の端数は切り捨てる)
            $expressFare = $expressFare / 2;
            $expressFare -= $expressFare % 10;
        }

        return $expressFare;
    }

    private function expressFareByDestination(Destination $destination): int
    {
        if ($destination === Destination::Himeji) return 5920;
        return 5490;
    }
}
