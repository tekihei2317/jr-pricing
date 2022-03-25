<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Test\Model;

use PHPUnit\Framework\TestCase;
use Tekihei2317\Core\Subdomain\Model\DateWithoutYear;

class DateWithoutYearTest extends TestCase
{
    public function testある日付以上かどうかを計算できること()
    {
        $targetDate = DateWithoutYear::createFromMonthAndDay(12, 25);
        $date1 = DateWithoutYear::createFromMonthAndDay(12, 25);
        $date2 = DateWithoutYear::createFromMonthAndDay(12, 24);
        $date3 = DateWithoutYear::createFromMonthAndDay(12, 26);
        $date4 = DateWithoutYear::createFromMonthAndDay(1, 1);

        $this->assertTrue($targetDate->greaterThanOrEquals($date1));
        $this->assertTrue($targetDate->greaterThanOrEquals($date2));
        $this->assertFalse($targetDate->greaterThanOrEquals($date3));
        $this->assertTrue($targetDate->greaterThanOrEquals($date4));
    }

    public function testある日付以下かどうかを計算できること()
    {
        $targetDate = DateWithoutYear::createFromMonthAndDay(12, 25);
        $date1 = DateWithoutYear::createFromMonthAndDay(12, 25);
        $date2 = DateWithoutYear::createFromMonthAndDay(12, 24);
        $date3 = DateWithoutYear::createFromMonthAndDay(12, 26);
        $date4 = DateWithoutYear::createFromMonthAndDay(1, 1);

        $this->assertTrue($targetDate->lessThanOrEquals($date1));
        $this->assertFalse($targetDate->lessThanOrEquals($date2));
        $this->assertTrue($targetDate->lessThanOrEquals($date3));
        $this->assertFalse($targetDate->lessThanOrEquals($date4));
    }
}
