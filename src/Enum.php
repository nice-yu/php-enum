<?php
declare(strict_types=1);

namespace NiceYu\Enum;
use BadMethodCallException;
use ReflectionClass;
use ReflectionException;

/**
 * 基础枚举类
 * 通过实现该类创建枚举
 */
abstract class Enum
{
    /**
     * 枚举键, 常量名称
     * @var string
     */
    public string $key;

    /**
     * 枚举值
     * @var mixed
     */
    public $value;

    /**
     * 枚举注解值
     * @var string
     */
    public string $message;

    /**
     * 常量列表
     * @var array
     */
    private static array $constants = [];

    /**
     * 枚举类实例
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
     * 获取指定实例
     * @param $value
     * @return Enum
     * @throws ReflectionException
     */
    public static function get($value): Enum
    {
        return new static($value);
    }

    /**
     * 获取枚举 key
     * @param $value
     * @return string|null
     * @throws ReflectionException
     */
    public static function getKey($value): ?string
    {
        return self::get($value)->key ?? null;
    }

    /**
     * 获取枚举 value
     * @param $value
     * @return mixed|null
     * @throws ReflectionException
     */
    public static function getValue($value)
    {
        return self::get($value)->value ?? null;
    }

    /**
     * 获取枚举 message
     * @param $value
     * @return string|null
     * @throws ReflectionException
     */
    public static function getMessage($value): ?string
    {
        return self::get($value)->message ?? null;
    }

    /**
     * 返回 Enum 类中所有常量的名称（键）
     * @return array
     * @throws ReflectionException
     */
    public static function getKeys(): array
    {
        return self::getArray();
    }

    /**
     * 返回所有枚举常量的 Enum 类的实例（键中的常量名称，值中的枚举实例）
     * @return array
     * @throws ReflectionException
     */
    public static function getValues():array
    {
        return self::getArray('value');
    }

    /**
     * 返回所有枚举常量的信息
     * @return array
     * @throws ReflectionException
     */
    public static function getMessages():array
    {
        return self::getArray('message');
    }

    /**
     * 返回常量指定信息
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
     * 返回当前
     * @param string $value
     * @return array
     * @throws ReflectionException
     */
    private static function returnConstant(string $value):array
    {
        return self::search($value);
    }

    /**
     * 搜索枚举实例
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
     * 返回当前常量数组
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
