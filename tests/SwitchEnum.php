<?php
declare(strict_types=1);

namespace NiceYu\Tests\Enum;

use NiceYu\Enum\Enum;

/**
 * class SwitchEnum
 * @method static SwitchEnum ON()
 * @method static SwitchEnum OFF()
 * @method static SwitchEnum Test()
 */
class SwitchEnum extends Enum
{
    /** 开启 */
    protected const ON = '1';

    /** 关闭 */
    protected const OFF = '0';
}