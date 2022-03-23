<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Test\Model;

use PHPUnit\Framework\TestCase;
use Tekihei2317\Core\Domain\BaseFare;
use Tekihei2317\Core\Domain\Destination;
use Tekihei2317\Core\Domain\ExpressFare;
use Tekihei2317\Core\Domain\Fare;
use Tekihei2317\Core\Domain\Station;
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
        Destination $destination,
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
        $shinosaka = new Destination(
            station: Station::Shinosaka,
            distance: 553,
            baseFare: 8910,
            expressFare: 5490,
        );
        $himeji = new Destination(
            station: Station::Himeji,
            distance: 644,
            baseFare: 10010,
            expressFare: 5920
        );

        return [
            '大人・新大阪・片道・ひかり・指定席の場合' => [true, $shinosaka, true, true, true, 14400],

            // 子供料金の計算の確認
            '子供・新大阪・片道・ひかり・指定席の場合' => [false, $shinosaka, true, true, true, 7190],

            // 目的地に応じた計算の確認
            '大人・姫路・片道・ひかり・指定席の場合' => [true, $himeji, true, true, true, 15930],

            // 往復料金・往復割引の確認
            '大人・新大阪・往復・ひかり・指定席の場合' => [true, $shinosaka, false, true, true, 28800],
            '大人・姫路・往復・ひかり・指定席の場合' => [true, $himeji, false, true, true, 29840],
        ];
    }
}
