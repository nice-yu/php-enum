<?php
declare(strict_types=1);

namespace NiceYu\Enum;

class EnumDto
{
    /**
     * zh: 枚举键, 常量名称
     * en: enum key, constant name
     * @var string
     */
    public string $name;

    /**
     * zh: 枚举值
     * en: enum value
     * @var mixed
     */
    public $value;

    /**
     * zh: 枚举注解值
     * en: enum annotation value
     * @var array
     */
    public array $notes;
}