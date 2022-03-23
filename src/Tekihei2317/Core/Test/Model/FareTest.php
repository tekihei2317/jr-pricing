<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Test\Model;

use PHPUnit\Framework\TestCase;
use Tekihei2317\Core\Domain\BaseFare;
use Tekihei2317\Core\Domain\ExpressFare;
use Tekihei2317\Core\Domain\Fare;
use Tekihei2317\Core\Domain\Ticket;

class FareTest extends TestCase
{
    private Fare $fare;

    protected function setUp(): void
    {
        $this->fare = new Fare(
            baseFare: new BaseFare,
            expressFare: new ExpressFare
        );
    }

    /**
     * @dataProvider dataProvider_料金が正しく計算できること
     */
    public function test料金が正しく計算できること(
        bool $isAdult,
        string $destination,
        bool $isOneWay,
        bool $isHikari,
        bool $isReservedSeat,
        int $expected,
    ) {
        $ticket = new Ticket(
            isAdult: $isAdult,
            destination: $destination,
            isOneWay: $isOneWay,
            isHikari: $isHikari,
            isReservedSeat: $isReservedSeat
        );

        $this->assertEquals($expected, $this->fare->calculate($ticket));
    }

    public function dataProvider_料金が正しく計算できること()
    {
        return [
            '大人・新大阪・片道・ひかり・指定席の場合' => [true, 'shinosaka', true, true, true, 14400],
            '子供・新大阪・片道・ひかり・指定席の場合' => [false, 'shinosaka', true, true, true, 7190],
        ];
    }
}
