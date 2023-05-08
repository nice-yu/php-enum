<?php
declare(strict_types=1);

namespace NiceYu\Tests\Enum;

use NiceYu\Enum\Enum;

/**
 * class WeekEnum
 * @method static SUNDAY(...$arg)
 * @method static MONDAY(...$arg)
 * @method static TUESDAY(...$arg)
 * @method static WEDNESDAY(...$arg)
 * @method static THURSDAY(...$arg)
 * @method static FRIDAY(...$arg)
 * @method static SATURDAY(...$arg)
 * @method static TEST(...$arg)
 */
class WeekEnum extends Enum
{
    /**
     * @zh("星期一")
     * @en("monday")
     */
    protected const MONDAY = 1;

    /**
     * @zh("星期二")
     * @en("tuesday")
     */
    protected const TUESDAY = 2;

    /**
     * @zh("星期三")
     * @en("wednesday")
     */
    protected const WEDNESDAY = 3;

    /**
     * @zh("星期四")
     * @en("thursday")
     */
    protected const THURSDAY = 4;

    /**
     * @zh("星期五")
     * @en("friday")
     */
    protected const FRIDAY = 5;

    /**
     * @zh("星期六")
     * @en("saturday")
     */
    protected const SATURDAY = 6;

    /**
     * @zh("星期日")
     * @en("sunday")
     */
    protected const SUNDAY = 0;
}