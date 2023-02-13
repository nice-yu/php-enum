<?php
declare(strict_types=1);

namespace NiceYu\Enum;
use BadMethodCallException;
use ReflectionClass;
use ReflectionException;

/**
 * zh: 基础枚举类 - 通过包实现该类创建枚举
 * en: Base enumeration class - implement this class to create enumerations through the package
 */
abstract class Enum
{
    /**
     * zh: 枚举键, 常量名称
     * en: enum key, constant name
     * @var string
     */
    public string $key;

    /**
     * zh: 枚举值
     * en: enum value
     * @var mixed
     */
    public $value;

    /**
     * zh: 枚举注解值
     * en: enum annotation value
     * @var string
     */
    public string $message;

    /**
     * zh: 常量列表
     * en: constant list
     * @var array
     */
    private static array $constants = [];

    /**
     * zh: 枚举类实例
     * en: enum class instance
     * @var array
     */
    private static array $instances = [];

    /**
     * @param $value
     * @throws ReflectionException
     */
    public function __construct($value)
    {
        ['key'=>$key,'value'=>$value,'message'=>$message] = static::returnConstant($value);
        $this->key = $key;
        $this->value = $value;
        $this->message = $message;
    }

    /**
     * zh: 获取指定常量
     * en: Get the specified constant
     * @param $value
     * @return Enum
     * @throws ReflectionException
     */
    public static function get($value): Enum
    {
        return new static($value);
    }

    /**
     * zh: 获取枚举 key
     * en: Get the enumeration key
     * @param $value
     * @return string|null
     * @throws ReflectionException
     */
    public static function getKey($value): ?string
    {
        return self::get($value)->key ?? null;
    }

    /**
     * zh: 获取枚举 value
     * en: Get the enumeration value
     * @param $value
     * @return mixed|null
     * @throws ReflectionException
     */
    public static function getValue($value)
    {
        return self::get($value)->value ?? null;
    }

    /**
     * zh: 获取枚举 message
     * en: Get the enumeration message
     * @param $value
     * @return string|null
     * @throws ReflectionException
     */
    public static function getMessage($value): ?string
    {
        return self::get($value)->message ?? null;
    }

    /**
     * zh: 返回 Enum 类中所有常量的名称（键）
     * en: Returns the names (keys) of all constants in the Enum class
     * @return array
     * @throws ReflectionException
     */
    public static function getKeys(): array
    {
        return self::getArray();
    }

    /**
     * zh: 返回 Enum 类中所有枚举常量值（值）
     * en: Returns all enumeration constant values (values) in the Enum class
     * @return array
     * @throws ReflectionException
     */
    public static function getValues():array
    {
        return self::getArray('value');
    }

    /**
     * zh: 返回所有枚举常量的信息 (message)
     * en: Return the information of all enumeration constants (message)
     * @return array
     * @throws ReflectionException
     */
    public static function getMessages():array
    {
        return self::getArray('message');
    }

    /**
     * zh: 返回常量指定信息
     * en: Return constant specification information
     * @param string $keys
     * @return array
     * @throws ReflectionException
     */
    private static function getArray(string $keys = 'key'):array
    {
        return array_keys(
            array_column(self::toArray(),null,$keys)
        );
    }

    /**
     * zh: 返回当前
     * en: return to current
     * @param string $value
     * @return array
     * @throws ReflectionException
     */
    private static function returnConstant(string $value):array
    {
        return self::search($value);
    }

    /**
     * zh: 搜索枚举常量
     * en: Search for enum constants
     * @param string $value
     * @return array
     * @throws ReflectionException
     */
    public static function search(string $value):array
    {
        foreach (self::toArray() as $constant){
            if (in_array($value,$constant)){
                return $constant;
            }
        }
        return [];
    }


    /**
     * zh: 返回当前常量数组
     * en: returns the current constant array
     * @return array
     * @throws ReflectionException
     */
    private static function toArray(): array
    {
        $class = static::class;
        if (!isset(static::$constants[$class])) {
            $regular = '#[*\s]*(^/|/$)[*\s]*#';
            $reflection = new ReflectionClass($class);
            foreach ($reflection->getReflectionConstants() as $constant){
                static::$constants[$class][$constant->getName()] = [
                    'key'       =>  $constant->getName(),
                    'value'     =>  $constant->getValue(),
                    'message'   =>  preg_replace($regular, '', $constant->getDocComment())
                ];
            }
        }
        return static::$constants[$class];
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed|static
     * @throws ReflectionException
     */
    public static function __callStatic($name, $arguments)
    {
        $class = static::class;
        if (!isset(self::$instances[$class][$name])) {
            $array = static::toArray();
            if (!isset($array[$name]) && !array_key_exists($name, $array)) {
                $message = "No static method or enum constant '$name' in class " . static::class;
                throw new BadMethodCallException($message);
            }
            return self::$instances[$class][$name] = new static($array[$name]['key']);
        }
        return clone self::$instances[$class][$name];
    }
}
