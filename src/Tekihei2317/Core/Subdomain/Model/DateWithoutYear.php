<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Subdomain\Model;

/**
 * 日付(月と日のみ)
 */
final class DateWithoutYear
{
    private function __construct(
        private Date $date
    ) {
    }

    public static function createFromMonthAndDay(int $month, int $day)
    {
        $dateString = "2000-{$month}-{$day}";

        return new Self(Date::createFromString($dateString));
    }

    public function greaterThanOrEquals(self $other)
    {
        return $this->date->greaterThanOrEquals($other->date);
    }

    public function lessThanOrEquals(self $other)
    {
        return $this->date->lessThanOrEquals($other->date);
    }
}
