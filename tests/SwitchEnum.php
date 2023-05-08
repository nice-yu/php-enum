<?php
declare(strict_types=1);

namespace NiceYu\Tests\Enum;

use NiceYu\Enum\Enum;

/**
 * class SwitchEnum
 * @method static ON(...$arg)
 * @method static OFF(...$arg)
 * @method static NORMAL(...$arg)
 * @method static DISABLED(...$arg)
 * @method static UNUSUAL(...$arg)
 * @method static FREEZE(...$arg)
 * @method static BANNED(...$arg)
 * @method static SHOW(...$arg)
 * @method static HIDE(...$arg)
 * @method static DEV(...$arg)
 * @method static PROD(...$arg)
 * @method static DEBUG(...$arg)
 */
class SwitchEnum extends Enum
{
    /**
     * @zh("开启")
     * @en("on")
     */
    protected const ON = '1';

    /**
     * @zh("关闭")
     * @en("off")
     */
    protected const OFF = '0';

    /**
     * @zh("正常")
     * @en("normal")
     */
    protected const NORMAL = 1;

    /**
     * @zh("禁用")
     * @en("disabled")
     */
    protected const DISABLED = 0;

    /**
     * @zh("异常")
     * @en("unusual")
     */
    protected const UNUSUAL = 0;

    /**
     * @zh("冻结")
     * @en("freeze")
     */
    protected const FREEZE = 0;

    /**
     * @zh("封禁")
     * @en("banned")
     */
    protected const BANNED = 0;

    /**
     * @zh("显示")
     * @en("show")
     */
    protected const SHOW = 1;

    /**
     * @zh("隐藏")
     * @en("hide")
     */
    protected const HIDE = 0;

    /**
     * @zh("测试")
     * @en("dev")
     */
    protected const DEV = true;

    /**
     * @zh("正式")
     * @en("prod")
     */
    protected const PROD = false;

    protected const DEBUG = false;
}