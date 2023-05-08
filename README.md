> [简体中文](README.zh-CN.md) | [English](README.md)

### PHP enumeration implementation
The `php7.4` enumeration class package that does not require a separate installation of the `SplEnum` extension

#### Install
```
# Install enum package
composer require nice-yu/php-enum

# Generate test coverage
phpunit --coverage-html ./tests/codeCoverage

# View test report
phpunit --bootstrap vendor/autoload.php --testdox tests

```

#### Unit test report
- Unit tests with 100% coverage
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

#### enum class definition

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

#### Example of using method `const`
```php
WeekEnum::SATURDAY();               // return corresponding `EnumDto` information
WeekEnum::SATURDAY('name');         // return corresponding `name` information, like: SATURDAY
WeekEnum::SATURDAY('value');        // return corresponding `value` information, like: 6
WeekEnum::SATURDAY('notes','zh');   // return corresponding `notes,zh` information, like: 星期六
WeekEnum::SATURDAY('notes','en');   // return corresponding `notes,en` information, like: saturday
```

#### Example using method `get`
```php
WeekEnum::get('SATURDAY');              // return corresponding `EnumDto` information
WeekEnum::get('SATURDAY','name');       // return corresponding `name` information, like: SATURDAY
WeekEnum::get('SATURDAY','value');      // return corresponding `value` information, like: 6
WeekEnum::get('SATURDAY','notes','zh'); // return corresponding `notes,zh` information, like: 星期六
WeekEnum::get('SATURDAY','notes','en'); // return corresponding `notes,en` information, like: saturday

```
- Of course the `get` value does not have to be a `const` name
- Can be `name`, `value`, `notes,zh`, `notes,en`

```php
WeekEnum::get('SATURDAY');  // return corresponding `EnumDto` information
WeekEnum::get(6);           // return corresponding `EnumDto` information
WeekEnum::get('星期六');     // return corresponding `EnumDto` information
WeekEnum::get('saturday');  // return corresponding `EnumDto` information
```
#### Example using the simplified method
```php
WeekEnum::getKey('SATURDAY');           // return corresponding `name` information, like: SATURDAY
WeekEnum::getValue('SATURDAY');         // return corresponding `value` information, like: 6
WeekEnum::getMessage('SATURDAY');       // return corresponding `notes,zh` information (The default is `zh`), like: 星期六
WeekEnum::getMessage('SATURDAY', 'en'); // return corresponding `notes,en` information, like: saturday
```

#### Get all content examples
```php
WeekEnum::getKeys();        // return corresponding `keys` array information: ["MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY", "SUNDAY"]
WeekEnum::getValues();      // return corresponding `values` array information: [1, 2, 3, 4, 5, 6, 0]
WeekEnum::getMessages();    // return corresponding `notes` array information, return by default `zh`: ["星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日"]
WeekEnum::getMessages('en');// return corresponding `notes` array information, specified return en: ["monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday"]
```

#####  `EnumDto` information
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

#### pass parameters
```php
function run(SwitchEnum $num) {
    // ...
}
```

#### static method
- `get()`
- - No parameter: returns all corresponding `Enum`s as `Enum`
- - Parameter 1: ['name','value','notes,zh','notes,en']
- - Parameter 2: ['name','value','notes']
- - Parameter 3: When parameter 2 is notes, you can pass in ['zh','en']
-
- `getKey()` returns `string`, the corresponding `key` in `enumeration class`
- - Parameter 1: ['name','value','notes,zh','notes,en']
-
- `getValue()` returns in the form of `corresponding type`, the corresponding `value` in `enumeration class`
- - Parameter 1: ['name','value','notes,zh','notes,en']
-
- `getMessage()` returns in the form of `string`, the corresponding `message` in `enumeration class`
- - Parameter 1: ['name','value','notes,zh','notes,en']
- - Parameter 2: ['zh','en']
-
- `CONST()`
- - No parameter: returns all corresponding `Enum`s as `Enum`
- - Parameter 1: ['name','value','notes']
- - Parameter 2: When parameter 1 is notes, ['zh','en'] can be passed in
-
- `getKeys()` returns all `keys` of the `enumeration class` in the form of an array, no need to pass in parameters
- `getValues()` returns all `values` of the `enumeration class` in the form of an array, no need to pass in parameters
- `getMessages()` returns all `messages` of the `enumeration class` in the form of an array, and the default parameter is `zh`
- `getMessages('en')` returns all `messages` of the `enumeration class` in the form of an array, and the specified parameter is `en`
