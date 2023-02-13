> [简体中文](README.zh-CN.md) | [English](README.md)

### PHP 枚举实现
不需要单独安装 `SplEnum` 扩展的 `php7.4` 枚举类包

#### 安装
```
composer require nice-yu/php-enum
```

#### 单元测试信息
- 覆盖率 100% 的单元测试
```
Enum (NiceYu\Tests\Enum\Enum)
 ✔ The static call to the get method [0.17 ms]
 ✔ The static call to the get key method [19.20 ms]
 ✔ The static call to the get value method [0.23 ms]
 ✔ The static call to the get message method [0.35 ms]
 ✔ Static call constant key method [0.28 ms]
 ✔ Static call constant dynamic key method [0.46 ms]
 ✔ New construct dynamic key method [0.18 ms]
 ✔ New construct dynamic value method [0.13 ms]
 ✔ New construct dynamic message method [0.40 ms]
 ✔ The static call to the get keys method [0.12 ms]
 ✔ The static call to the get values method [0.10 ms]
 ✔ The static call to the get messages method [0.10 ms]
 ✔ Not exist constant exception [1.67 ms]
 ✔ Not existent search for empty constants [0.10 ms]
```

#### 枚举类定义

```php
<?php
declare(strict_types=1);

namespace NiceYu\Tests\Enum;

use NiceYu\Enum\Enum;

/**
 * class SwitchEnum
 * @method static SwitchEnum ON()
 * @method static SwitchEnum OFF()
 */
class SwitchEnum extends Enum
{
    /** 开启 */
    protected const ON = '1';

    /** 关闭 */
    protected const OFF = '0';
}
```

#### 方法
```php
SwitchEnum::search('ON');
// OR
SwitchEnum::get('ON');
// OR
SwitchEnum::getKey('ON');
// OR
SwitchEnum::getValue('ON');
// OR
SwitchEnum::getMessage('ON');
// OR
(SwitchEnum::ON())->value;
// OR
(SwitchEnum::$on())->value;
// OR
(new SwitchEnum('ON'))->value;
// OR
(new SwitchEnum('1'))->value;
// OR
(new SwitchEnum('开启'))->value;
// OR
SwitchEnum::getKeys();
// OR
SwitchEnum::getValues();
// OR
SwitchEnum::getMessages();
```

#### 传参
```php
function run(SwitchEnum $num) {
    // ...
}
```

#### Enum 存在参数
- `$enum->key`
- `$enum->value`
- `$enum->message`

#### new 的方式
- `__construct()` 以 `Enum` 形式返回所有可能的值, 传入参数可以为 `key`, `value`

#### 静态方法
- `get()` 以 `Enum` 形式返回所有对应的 `Enum`, 传入参数可以为 `key`, `value`
- `search()` 以数组形式返回所有可能的值 `key` `value` `message`, 传入参数可以为 `key`, `value`
- `getKey()` 以 `string` 形式返回, `枚举类` 内对应的 `key`, 传入参数可以为 `key`, `value`
- `getValue()` 以 `对应类型` 形式返回, `枚举类` 内对应的 `value`, 传入参数可以为 `key`, `value`
- `getMessage()` 以 `string` 形式返回, `枚举类` 内对应的 `message`, 传入参数可以为 `key`, `value`
- `getKeys()` 以数组形式返回 `枚举类` 所有的 `key`, 不需要传入参数
- `getValues()` 以数组形式返回 `枚举类` 所有的 `value`, 不需要传入参数
- `getMessages()` 以数组形式返回 `枚举类` 所有的 `message`, 不需要传入参数
- `ON()`  以 `Enum` 形式返回所有对应的 `Enum`, `ON` 为 `枚举类` 内的常量名称
- `$enum()`  以 `Enum` 形式返回所有对应的 `Enum`, `$enum` 为 `枚举类` 内的常量名称 (这种动态调用方式较慢)