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

    public function calculate(Ticket $ticket)
    {
        return 5490;
    }
}
