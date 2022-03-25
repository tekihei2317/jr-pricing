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
use Tekihei2317\Core\Subdomain\Model\Date;

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
        Date $departureDate,
        int $expected,
    ) {
        $ticket = new Ticket(
            isAdult: $isAdult,
            destination: $destination,
            isOneWay: $isOneWay,
            isHikari: $isHikari,
            isReservedSeat: $isReservedSeat,
            departureDate: $departureDate,
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
            '大人・新大阪・片道・ひかり・指定席の場合' => [true, $shinosaka, true, true, true, Date::createFromString('2022-04-01'), 14400],

            // 子供料金の計算の確認
            '子供・新大阪・片道・ひかり・指定席の場合' => [false, $shinosaka, true, true, true, Date::createFromString('2022-04-01'), 7190],

            // 目的地に応じた計算の確認
            '大人・姫路・片道・ひかり・指定席の場合' => [true, $himeji, true, true, true, Date::createFromString('2022-04-01'), 15930],

            // 往復料金・往復割引の確認
            '大人・新大阪・往復・ひかり・指定席の場合' => [true, $shinosaka, false, true, true, Date::createFromString('2022-04-01'), 28800],
            '大人・姫路・往復・ひかり・指定席の場合' => [true, $himeji, false, true, true, Date::createFromString('2022-04-01'), 29840],

            // 自由席特急料金の確認
            '大人・新大阪・片道・ひかり・自由席の場合' => [true, $shinosaka, true, true, false, Date::createFromString('2022-04-01'), 13870],
            '大人・新大阪・片道・のぞみ・自由席の場合' => [true, $shinosaka, true, false, false, Date::createFromString('2022-04-01'), 13870],

            // 指定席のぞみ割増の確認
            '大人・新大阪・片道・のぞみ・指定席の場合' => [true, $shinosaka, true, false, true, Date::createFromString('2022-04-01'), 14400 + 530],
            '大人・東京・片道・のぞみ・指定席の場合' => [true, $himeji, true, false, true, Date::createFromString('2022-04-01'), 15930 + 530],

            // 繁忙期割増の確認
            '大人・新大阪・片道・ひかり・指定席・繁忙期(開始日)の場合' => [true, $shinosaka, true, true, true, Date::createFromString('2022-12-25'), 14400 + 200],
            '大人・新大阪・片道・ひかり・指定席・繁忙期(終了日)の場合' => [true, $shinosaka, true, true, true, Date::createFromString('2022-01-10'), 14400 + 200],

            // 閑散期割引の確認
        ];
    }
}
