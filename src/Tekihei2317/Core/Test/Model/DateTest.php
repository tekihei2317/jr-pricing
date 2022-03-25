<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Test\Model;

use PHPUnit\Framework\TestCase;
use Tekihei2317\Core\Subdomain\Model\Date;
use Tekihei2317\Core\Subdomain\Model\DateWithoutYear;

class DateTest extends TestCase
{
    public function test年無し日付に変換できること()
    {
        $date = Date::createFromString('2022-01-01');
        $expected = DateWithoutYear::createFromMonthAndDay(1, 1);

        $this->assertEquals($expected, $date->toDateWithoutYear());
    }
}
