<?php
declare(strict_types=1);

namespace NiceYu\Enum;

use ReflectionClass;
use ReflectionException;

/**
 * zh: 基础枚举类 - 通过包实现该类创建枚举
 * en: Base enumeration class - implement this class to create enumerations through the package
 */
abstract class Enum
{
    /**
     * zh: 枚举类实例
     * en: enum class instance
     * @var array
     */
    private static array $instances = [];

    /**
     * get 方式获取到 const 信息
     * 注意: 使用值 反向获取的时候, 如果存在多个相同值, 不准确
     * @param string $value
     * @param ...$arguments
     * @return mixed
     */
    public static function get(string $value, ...$arguments)
    {
        return self::searchConst($value, $arguments);
    }

    /**
     * 获取到 const 信息, 返回 name
     * @param string $value
     * @return string
     */
    public static function getKey(string $value): string
    {
        return self::searchConst($value, ['name']);
    }

    /**
     * 获取到 const 信息, 返回 value
     * @param string $value
     * @return mixed|EnumDto|null
     */
    public static function getValue(string $value)
    {
        return self::searchConst($value, ['value']);
    }

    /**
     * 获取到 const 信息, 返回 message
     * @param string $value
     * @param string $lang
     * @return mixed|EnumDto|null
     */
    public static function getMessage(string $value, string $lang = 'zh')
    {
        return self::searchConst($value, ['notes',$lang]);
    }

    /**
     * 获取到所有 const 的 key
     * @return array
     */
    public static function getKeys(): array
    {
        return array_keys(self::toArray());
    }

    /**
     * 获取到所有 const 的 value
     * @return array
     */
    public static function getValues(): array
    {
        return array_keys(
            array_column(self::toArray(),null,'value')
        );
    }

    /**
     * 获取到所有 const 的 note
     * @param string $lang
     * @return array
     */
    public static function getMessages(string $lang = 'zh'): array
    {
        $notes = array();
        foreach (self::toArray() as $const){
            $notes[] = $const->notes[$lang];
        }
        return $notes;
    }

    /**
     * 使用 name 获取到 const 信息
     * @param string $method
     * @param array $arguments
     * @return mixed|EnumDto|null
     */
    private static function searchConst(string $method, array $arguments)
    {
        $constants = self::toArray();
        $constant = null;

        /**
         * 循环查找对应值
         * @var EnumDto $item
         */
        foreach ($constants as $item){

            if (in_array($method,$item->notes,true)){
                $constant = $item;
                break;
            }
        }

        /** 获取到 $arguments 信息 */
        return self::returnMake($constant, $arguments);
    }

    /**
     * 返回选择的内容
     * @param ?EnumDto $constant
     * @param array $arguments
     * @return mixed
     */
    private static function returnMake(?EnumDto $constant, array $arguments)
    {
        /** arg 为空 */
        if (empty($arguments)){
            return $constant;
        }

        /** arg 内容为单个时, 则默认为 name、value、notes */
        if (count($arguments) === 1){
            list($arg1) = $arguments;
            if (array_key_exists($arg1, (array)$constant)){
                return $constant->{$arg1};
            }
        }

        /** arg 内容为两个时, 则默认为 notes => keys */
        if (count($arguments) === 2){
            list($arg1, $arg2) = $arguments;
            if (array_key_exists($arg1, (array)$constant)){
                return $constant->{$arg1}[$arg2] ?? null;
            }
        }
        return null;
    }

    /**
     * zh: 返回当前常量数组
     * en: returns the current constant array
     * @return array
     */
    private static function toArray(): array
    {
        $class = static::class;
        if (!isset(static::$instances[$class])) {
            try {
                $reflection = new ReflectionClass($class);
            } catch (ReflectionException $e) {
                return [];
            }

            /** 获取到所有函数 */
            foreach ($reflection->getReflectionConstants() as $constant){

                $notes = array();
                /** 匹配到注解中的 @界定和(".*") 内容 */
                $docComment = $constant->getDocComment();
                if ($docComment && preg_match_all('/@([a-z]+)\(\"(.+)\"\)/', $docComment, $match)){
                    /** 收集注解信息 */
                    $notes['name']  = $constant->getName();
                    $notes['value'] = $constant->getValue();

                    for ($i = 0; $i < count($match[1]); $i++){
                        $notes[$match[1][$i]] = $match[2][$i];
                    }
                }
                /** 获取到 key => value */
                $dto = new EnumDto();
                $dto->name  = $constant->getName();
                $dto->value = $constant->getValue();

                /** 解析注解信息 */
                $dto->notes = $notes;

                /** 指向实例 */
                static::$instances[$class][$constant->getName()] = $dto;
            }
        }
        return static::$instances[$class];
    }

    /**
     * @param string $method
     * @param array $arguments
     * @return mixed|EnumDto|null
     */
    public static function __callStatic(string $method, array $arguments)
    {
        /** 获取到类名称 */
        $class = static::class;

        /** 查看实例内是否已经存在此类信息 */
        if (!isset(self::$instances[$class][$method])) {

            /** 获取到实例常数 */
            $constants = static::toArray();

            /** 获取到常量名称 */
            if (!isset($constants[$method]) && !array_key_exists($method, $constants)) {
                return null;
            }
        }
        return self::searchConst($method, $arguments);
    }
}
