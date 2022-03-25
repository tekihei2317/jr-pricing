<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Domain;

use Tekihei2317\Core\Subdomain\Model\Date;
use Tekihei2317\Core\Subdomain\Model\DateWithoutYear;

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
        $expressFare = $ticket->getExpressFare();

        if (!$ticket->isReservedSeat) {
            // 自由席の場合
            $expressFare = 5490 - 530;
        } else if (!$ticket->isHikari) {
            // 指定席かつのぞみの場合
            $expressFare += 530;
        }

        if ($ticket->isReservedSeat) {
            $season = $this->calculateSeason($ticket->departureDate->toDateWithoutYear());
            if ($season === Season::Peak) {
                $expressFare += 200;
            }
        }

        if (!$ticket->isAdult) {
            assert($expressFare % 10 === 0);

            // 子供は半額(5円の端数は切り捨てる)
            $expressFare = $expressFare / 2;
            $expressFare -= $expressFare % 10;
        }

        if (!$ticket->isOneWay) {
            $expressFare *= 2;
        }

        return $expressFare;
    }

    private function calculateSeason(DateWithoutYear $date): Season
    {
        $peakStartDate = DateWithoutYear::createFromMonthAndDay(12, 25);
        $yearEndDate = DateWithoutYear::createFromMonthAndDay(12, 31);
        $yearStartDate = DateWithoutYear::createFromMonthAndDay(1, 1);
        $peakEndDate = DateWithoutYear::createFromMonthAndDay(1, 10);

        if (
            $date->greaterThanOrEquals($peakStartDate) && $date->lessThanOrEquals($yearEndDate) ||
            $date->greaterThanOrEquals($yearStartDate) && $date->lessThanOrEquals($peakEndDate)
        ) {
            return Season::Peak;
        }

        return Season::Regular;
    }
}
