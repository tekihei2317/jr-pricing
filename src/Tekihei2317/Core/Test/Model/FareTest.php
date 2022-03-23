<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Test\Model;

use PHPUnit\Framework\TestCase;
use Tekihei2317\Core\Domain\Fare;
use Tekihei2317\Core\Domain\Ticket;

class FareTest extends TestCase
{
    private Fare $fare;

    protected function setUp(): void
    {
        $this->fare = new Fare;
    }

    public function test大人・新大阪・片道・ひかり・指定席の場合()
    {
        $ticket = new Ticket(
            isAdult: true,
            destination: 'shinosaka',
            isOneWay: true,
            isHikari: true,
            isReservedSeat: true
        );

        $this->assertEquals(14400, $this->fare->calculate($ticket));
    }
}
