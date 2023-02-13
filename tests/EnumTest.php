<?php
declare(strict_types=1);
namespace NiceYu\Tests\Enum;

use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @coversDefaultClass \NiceYu\Enum\Enum
 */
final class EnumTest extends TestCase
{
    private string $onKey = 'ON';
    private string $offKey = 'OFF';
    private string $onValue = '1';
    private string $offValue = '0';
    private string $onMessage = '开启';
    private string $offMessage = '关闭';

    /**
     * @covers ::get
     * @covers ::search
     * @covers ::toArray
     * @covers ::__construct
     * @covers ::returnConstant
     * @throws ReflectionException
     */
    public function testTheStaticCallToTheGetMethod():void
    {
        $this->assertEquals($this->onValue, SwitchEnum::get($this->onKey)->value);
        $this->assertEquals($this->onValue, SwitchEnum::get($this->onValue)->value);
        $this->assertEquals($this->onValue, SwitchEnum::get($this->onMessage)->value);

        $this->assertEquals($this->offValue, SwitchEnum::get($this->offKey)->value);
        $this->assertEquals($this->offValue, SwitchEnum::get($this->offValue)->value);
        $this->assertEquals($this->offValue, SwitchEnum::get($this->offMessage)->value);
    }

    /**
     * @covers ::get
     * @covers ::getKey
     * @covers ::search
     * @covers ::toArray
     * @covers ::__construct
     * @covers ::returnConstant
     * @throws ReflectionException
     */
    public function testTheStaticCallToTheGetKeyMethod():void
    {
        $this->assertEquals($this->onKey, SwitchEnum::getKey($this->onKey));
        $this->assertEquals($this->onKey, SwitchEnum::getKey($this->onValue));
        $this->assertEquals($this->onKey, SwitchEnum::getKey($this->onMessage));

        $this->assertEquals($this->offKey, SwitchEnum::getKey($this->offKey));
        $this->assertEquals($this->offKey, SwitchEnum::getKey($this->offValue));
        $this->assertEquals($this->offKey, SwitchEnum::getKey($this->offMessage));
    }

    /**
     * @covers ::get
     * @covers ::search
     * @covers ::toArray
     * @covers ::getValue
     * @covers ::__construct
     * @covers ::returnConstant
     * @throws ReflectionException
     */
    public function testTheStaticCallToTheGetValueMethod():void
    {
        $this->assertEquals($this->onValue, SwitchEnum::getValue($this->onKey));
        $this->assertEquals($this->onValue, SwitchEnum::getValue($this->onValue));
        $this->assertEquals($this->onValue, SwitchEnum::getValue($this->onMessage));

        $this->assertEquals($this->offValue, SwitchEnum::getValue($this->offKey));
        $this->assertEquals($this->offValue, SwitchEnum::getValue($this->offValue));
        $this->assertEquals($this->offValue, SwitchEnum::getValue($this->offMessage));
    }

    /**
     * @covers ::get
     * @covers ::search
     * @covers ::toArray
     * @covers ::GetMessage
     * @covers ::__construct
     * @covers ::returnConstant
     * @throws ReflectionException
     */
    public function testTheStaticCallToTheGetMessageMethod():void
    {
        $this->assertEquals($this->onMessage, SwitchEnum::getMessage($this->onKey));
        $this->assertEquals($this->onMessage, SwitchEnum::getMessage($this->onValue));
        $this->assertEquals($this->onMessage, SwitchEnum::getMessage($this->onMessage));

        $this->assertEquals($this->offMessage, SwitchEnum::getMessage($this->offKey));
        $this->assertEquals($this->offMessage, SwitchEnum::getMessage($this->offValue));
        $this->assertEquals($this->offMessage, SwitchEnum::getMessage($this->offMessage));
    }

    /**
     * @covers ::search
     * @covers ::toArray
     * @covers ::__construct
     * @covers ::__callStatic
     * @covers ::returnConstant
     */
    public function testStaticCallConstantKeyMethod():void
    {
        $this->assertEquals($this->onValue, SwitchEnum::ON()->value);
        $this->assertEquals($this->offValue, SwitchEnum::OFF()->value);
    }

    /**
     * @covers ::search
     * @covers ::toArray
     * @covers ::__construct
     * @covers ::__callStatic
     * @covers ::returnConstant
     */
    public function testStaticCallConstantDynamicKeyMethod():void
    {
        $onKey = $this->onKey;
        $offKey = $this->offKey;
        $this->assertEquals($this->onValue, SwitchEnum::$onKey()->value);
        $this->assertEquals($this->offValue, SwitchEnum::$offKey()->value);
    }

    /**
     * @covers ::search
     * @covers ::toArray
     * @covers ::__construct
     * @covers ::returnConstant
     * @throws ReflectionException
     */
    public function testNewConstructDynamicKeyMethod():void
    {
        $this->assertEquals($this->onValue, (new SwitchEnum($this->onKey))->value);
        $this->assertEquals($this->offValue, (new SwitchEnum($this->offKey))->value);
    }

    /**
     * @covers ::search
     * @covers ::toArray
     * @covers ::__construct
     * @covers ::returnConstant
     * @throws ReflectionException
     */
    public function testNewConstructDynamicValueMethod():void
    {
        $this->assertEquals($this->onValue, (new SwitchEnum($this->onValue))->value);
        $this->assertEquals($this->offValue, (new SwitchEnum($this->offValue))->value);
    }

    /**
     * @covers ::search
     * @covers ::toArray
     * @covers ::__construct
     * @covers ::returnConstant
     * @throws ReflectionException
     */
    public function testNewConstructDynamicMessageMethod():void
    {
        $this->assertEquals($this->onValue, (new SwitchEnum($this->onMessage))->value);
        $this->assertEquals($this->offValue, (new SwitchEnum($this->offMessage))->value);
    }

    /**
     * @covers ::getKeys
     * @covers ::toArray
     * @covers ::getArray
     * @throws ReflectionException
     */
    public function testTheStaticCallToTheGetKeysMethod():void
    {
        $this->assertEquals(['ON','OFF'], SwitchEnum::getKeys());
    }

    /**
     * @covers ::toArray
     * @covers ::getArray
     * @covers ::getValues
     * @throws ReflectionException
     */
    public function testTheStaticCallToTheGetValuesMethod():void
    {
        $this->assertEquals([1,0],SwitchEnum::getValues());

    }

    /**
     * @covers ::toArray
     * @covers ::getArray
     * @covers ::getMessages
     * @throws ReflectionException
     */
    public function testTheStaticCallToTheGetMessagesMethod():void
    {
        $this->assertEquals(['开启','关闭'],SwitchEnum::getMessages());
    }

    /**
     * @covers ::toArray
     * @covers ::__callStatic
     */
    public function testNotExistConstantException():void
    {
        $this->expectException(BadMethodCallException::class);
        SwitchEnum::Test();
    }

    /**
     * @covers ::search
     * @covers ::toArray
     * @throws ReflectionException
     */
    public function testNotExistentSearchForEmptyConstants():void
    {
        $this->assertEquals([], SwitchEnum::search('Test'));
    }
}