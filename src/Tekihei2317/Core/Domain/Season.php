<?php

declare(strict_types=1);

namespace Tekihei2317\Core\Domain;

/**
 * 季節
 */
enum Season
{
    /** 通常期 */
    case Regular;
    /** 閑散期 */
    case OffPeak;
    /** 繁忙期 */
    case Peak;
}
