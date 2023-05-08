> [简体中文](README.zh-CN.md) | [English](README.md)

### PHP 枚举实现
不需要单独安装 `SplEnum` 扩展的 `php7.4` 枚举类包

#### 安装
```
# 安装枚举包
composer require nice-yu/php-enum

# 生成测试覆盖率
phpunit --coverage-html ./tests/codeCoverage

# 查看测试报告
phpunit --bootstrap vendor/autoload.php --testdox tests

```

#### 单元测试信息
- 覆盖率 100% 的单元测试
```
Enum (NiceYu\Tests\Enum\Enum)
 ✔ Not exist constant exception [0.19 ms]
 ✔ Use of get static method [0.41 ms]
 ✔ The use of get key static method [28.62 ms]
 ✔ The use of the get value static method [0.17 ms]
 ✔ The use of the get message static method [0.26 ms]
 ✔ The use of the get keys static method [0.12 ms]
 ✔ The use of the get values static method [0.15 ms]
 ✔ The use of the static method of get messages [0.16 ms]
 ✔ The use of const name static method get the name [0.21 ms]
 ✔ The use of const name static method get the value [0.21 ms]
 ✔ The use of const name static method get the zh [0.21 ms]
 ✔ The use of const name static method get the en [0.41 ms]
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
}
```

#### 使用方法 `const` 示例
```php
WeekEnum::SATURDAY();               // 返回 `EnumDto` 信息
WeekEnum::SATURDAY('name');         // 返回对应 `name` 信息, 如: SATURDAY
WeekEnum::SATURDAY('value');        // 返回对应 `value` 信息, 如: 6
WeekEnum::SATURDAY('notes','zh');   // 返回对应 `notes,zh` 信息, 如: 星期六
WeekEnum::SATURDAY('notes','en');   // 返回对应 `notes,en` 信息, 如: saturday
```

#### 使用方法 `get` 示例
```php
WeekEnum::get('SATURDAY');              // 返回 `EnumDto` 信息
WeekEnum::get('SATURDAY','name');       // 返回对应 `name` 信息, 如: SATURDAY
WeekEnum::get('SATURDAY','value');      // 返回对应 `value` 信息, 如: 6
WeekEnum::get('SATURDAY','notes','zh'); // 返回对应 `notes,zh` 信息, 如: 星期六
WeekEnum::get('SATURDAY','notes','en'); // 返回对应 `notes,en` 信息, 如: saturday

```
- 当然 `get` 值不是必须为 `const` 名
- 可以为 `name`, `value`, `notes,zh`, `notes,en`

```php
WeekEnum::get('SATURDAY');  // 返回 `EnumDto` 信息
WeekEnum::get(6);           // 返回 `EnumDto` 信息
WeekEnum::get('星期六');     // 返回 `EnumDto` 信息
WeekEnum::get('saturday');  // 返回 `EnumDto` 信息
```
#### 使用简化方法示例
```php
WeekEnum::getKey('SATURDAY');           // 返回对应 `name` 信息, 如: SATURDAY
WeekEnum::getValue('SATURDAY');         // 返回对应 `value` 信息, 如: 6
WeekEnum::getMessage('SATURDAY');       // 返回对应 `notes,zh` 信息 (默认为 zh), 如: 星期六
WeekEnum::getMessage('SATURDAY', 'en'); // 返回对应 `notes,en` 信息, 如: saturday
```

#### 获取所以内容示例
```php
WeekEnum::getKeys();        // 返回 `keys` 数组信息: ["MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY", "SUNDAY"]
WeekEnum::getValues();      // 返回 `values` 数组信息: [1, 2, 3, 4, 5, 6, 0]
WeekEnum::getMessages();    // 返回 `notes` 数组信息, 默认返回 zh: ["星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"]
WeekEnum::getMessages('en');// 返回 `notes` 数组信息, 指定返回 en: ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"]
```

#####  `EnumDto` 信息
```php
^ NiceYu\Enum\EnumDto {#16 ▼
  +name: "SATURDAY"
  +value: 6
  +notes: array:4 [▼
    "name" => "SATURDAY"
    "value" => 6
    "zh" => "星期六"
    "en" => "saturday"
  ]
}
```

#### 传参
```php
function run(SwitchEnum $num) {
    // ...
}
```

#### 静态方法
- `get()` 
- - 无参数: 以 `Enum` 形式返回所有对应的 `Enum`
- - 参数1: ['name','value','notes,zh','notes,en']
- - 参数2: ['name','value','notes']
- - 参数3: 当 参数2 为 notes 时, 可传入 ['zh','en']
-
- `getKey()` 以 `string` 形式返回, `枚举类` 内对应的 `key`
- - 参数1: ['name','value','notes,zh','notes,en']
-
- `getValue()` 以 `对应类型` 形式返回, `枚举类` 内对应的 `value`
- - 参数1: ['name','value','notes,zh','notes,en']
-
- `getMessage()` 以 `string` 形式返回, `枚举类` 内对应的 `message`
- - 参数1: ['name','value','notes,zh','notes,en']
- - 参数2: ['zh','en']
-
- `CONST()`
- - 无参数: 以 `Enum` 形式返回所有对应的 `Enum`
- - 参数1: ['name','value','notes']
- - 参数2: 当 参数1 为 notes 时, 可传入 ['zh','en']
-
- `getKeys()` 以数组形式返回 `枚举类` 所有的 `key`, 不需要传入参数
- `getValues()` 以数组形式返回 `枚举类` 所有的 `value`, 不需要传入参数
- `getMessages()` 以数组形式返回 `枚举类` 所有的 `message`, 默认参数为 `zh`
- `getMessages('en')` 以数组形式返回 `枚举类` 所有的 `message`, 指定参数为 `en`
