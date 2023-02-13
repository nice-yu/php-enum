> [简体中文](README.zh-CN.md) | [English](README.md)

### PHP enum implementation
The `php7.4` enumeration class package that does not require a separate installation of the `SplEnum` extension

#### Install
```
composer require nice-yu/php-enum
```
#### Unit Test Information
- Unit tests with 100% coverage
- 
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
    /** on */
    protected const ON = '1';

    /** off */
    protected const OFF = '0';
}
```

#### method
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

#### pass parameters
```php
function run(SwitchEnum $num) {
    // ...
}
```

#### Enum exists parameter
- `$enum->key`
- `$enum->value`
- `$enum->message`

#### new way
- `__construct()` Return all possible values in the form of `Enum`, the incoming parameters can be `key`, `value`

#### static method
- `get()` Return all corresponding `Enum` in the form of `Enum`, and the incoming parameters can be `key`, `value`
- `search()` Return all possible values `key` `value` `message` in the form of an array, and the incoming parameters can be `key`, `value`
- `getKey()` Returned in the form of `string`, the corresponding `key` in the `enumeration class`, the incoming parameters can be `key`, `value`
- `getValue()` Return in the form of `corresponding type`, the corresponding `value` in `enumeration class`, the incoming parameters can be `key`, `value`
- `getMessage()` Returned in the form of `string`, the corresponding `message` in the `enumeration class`, the incoming parameters can be `key`, `value`
- `getKeys()` Return all `keys` of the `enumeration class` in the form of an array, no need to pass in parameters
- `getValues()` Return all `values` of `enumeration class` in the form of an array, no need to pass in parameters
- `getMessages()` Return all `messages` of the `enumeration class` in the form of an array, no need to pass in parameters
- `ON()` Return all corresponding `Enum` in the form of `Enum`, `ON` is the constant name in `enum class`
- `$enum()` Return all corresponding `Enum` in the form of `Enum`, `$enum` is the constant name in the `enumeration class` (this dynamic calling method is slower)