<?php
declare(strict_types=1);
namespace NiceYu\Tests\Enum;

use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @coversDefaultClass \NiceYu\Enum\Enum
 */
final class EnumTest extends TestCase
{
    private string $name = 'SUNDAY';

    private int $value = 0;

    private string $zh = '星期日';

    private string $en = 'sunday';

    /**
     * @covers ::get
     * @covers ::toArray
     * @covers ::returnMake
     * @covers ::searchConst
     * @covers ::__callStatic
     * @return void
     * @throws ReflectionException
     */
    public function testNotExistConstantException():void
    {
        $this->assertEquals(null, WeekEnum::TEST());
        $this->assertEquals(null, WeekEnum::get('test'));
        $this->assertEquals(null, WeekEnum::get('7'));
        $this->assertEquals(null, WeekEnum::get('星期天'));
        $this->assertEquals(null, WeekEnum::get('TEST'));
        $this->assertEquals(null, WeekEnum::get('TEST','notes','zh'));
    }

    /**
     * @covers ::get
     * @covers ::toArray
     * @covers ::returnMake
     * @covers ::searchConst
     * @return void
     * @throws ReflectionException
     */
    public function testUseOfGetStaticMethod(): void
    {
        $this->assertEquals($this->name,  WeekEnum::get(0,'name'));
        $this->assertEquals($this->value, WeekEnum::get(0,'value'));
        $this->assertEquals($this->zh,    WeekEnum::get(0,'notes','zh'));
        $this->assertEquals($this->en,    WeekEnum::get(0,'notes','en'));
    }

    /**
     * @covers ::getKey
     * @covers ::toArray
     * @covers ::returnMake
     * @covers ::searchConst
     * @return void
     * @throws ReflectionException
     */
    public function testTheUseOfGetKeyStaticMethod():void
    {
        $this->assertEquals($this->name, WeekEnum::getKey($this->name));
        $this->assertEquals($this->name, WeekEnum::getKey($this->value));
        $this->assertEquals($this->name, WeekEnum::getKey($this->zh));
        $this->assertEquals($this->name, WeekEnum::getKey($this->en));
    }

    /**
     * @covers ::getValue
     * @covers ::toArray
     * @covers ::returnMake
     * @covers ::searchConst
     * @return void
     * @throws ReflectionException
     */
    public function testTheUseOfTheGetValueStaticMethod():void
    {
        $this->assertEquals($this->value, WeekEnum::getValue($this->name));
        $this->assertEquals($this->value, WeekEnum::getValue($this->value));
        $this->assertEquals($this->value, WeekEnum::getValue($this->zh));
        $this->assertEquals($this->value, WeekEnum::getValue($this->en));
    }

    /**
     * @covers ::getMessage
     * @covers ::toArray
     * @covers ::returnMake
     * @covers ::searchConst
     * @return void
     * @throws ReflectionException
     */
    public function testTheUseOfTheGetMessageStaticMethod():void
    {
        $this->assertEquals($this->zh, WeekEnum::getMessage($this->name));
        $this->assertEquals($this->zh, WeekEnum::getMessage($this->value));
        $this->assertEquals($this->zh, WeekEnum::getMessage($this->zh));
        $this->assertEquals($this->zh, WeekEnum::getMessage($this->en));

        $this->assertEquals($this->en, WeekEnum::getMessage($this->name,'en'));
        $this->assertEquals($this->en, WeekEnum::getMessage($this->value,'en'));
        $this->assertEquals($this->en, WeekEnum::getMessage($this->zh,'en'));
        $this->assertEquals($this->en, WeekEnum::getMessage($this->en,'en'));
    }

    /**
     * @covers ::getKeys
     * @covers ::toArray
     * @covers ::returnMake
     * @covers ::searchConst
     * @return void
     * @throws ReflectionException
     */
    public function testTheUseOfTheGetKeysStaticMethod():void
    {
        $equals = array("MONDAY", "TUESDAY", "WEDNESDAY", "THURSDAY", "FRIDAY", "SATURDAY", "SUNDAY");
        $this->assertEquals($equals, WeekEnum::getKeys());
    }

    /**
     * @covers ::getValues
     * @covers ::toArray
     * @covers ::returnMake
     * @covers ::searchConst
     * @return void
     * @throws ReflectionException
     */
    public function testTheUseOfTheGetValuesStaticMethod():void
    {
        $equals = array(1, 2, 3, 4, 5, 6, 0);
        $this->assertEquals($equals, WeekEnum::getValues());
    }

    /**
     * @covers ::getMessages
     * @covers ::toArray
     * @covers ::returnMake
     * @covers ::searchConst
     * @return void
     * @throws ReflectionException
     */
    public function testTheUseOfTheStaticMethodOfGetMessages():void
    {
        $equals1 = array("星期一", "星期二", "星期三", "星期四", "星期五", "星期六", "星期日");
        $this->assertEquals($equals1, WeekEnum::getMessages());

        $equals2 = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
        $this->assertEquals($equals2, WeekEnum::getMessages('en'));
    }

    /**
     * @covers ::__callStatic
     * @covers ::toArray
     * @covers ::returnMake
     * @covers ::searchConst
     * @return void
     */
    public function testTheUseOfConstNameStaticMethodGetTheName():void
    {
        $this->assertEquals('MONDAY',    WeekEnum::MONDAY('name'));
        $this->assertEquals('TUESDAY',   WeekEnum::TUESDAY('name'));
        $this->assertEquals('WEDNESDAY', WeekEnum::WEDNESDAY('name'));
        $this->assertEquals('THURSDAY',  WeekEnum::THURSDAY('name'));
        $this->assertEquals('FRIDAY',    WeekEnum::FRIDAY('name'));
        $this->assertEquals('SATURDAY',  WeekEnum::SATURDAY('name'));
        $this->assertEquals('SUNDAY',    WeekEnum::SUNDAY('name'));
    }

    /**
     * @covers ::__callStatic
     * @covers ::toArray
     * @covers ::returnMake
     * @covers ::searchConst
     * @return void
     */
    public function testTheUseOfConstNameStaticMethodGetTheValue():void
    {
        $this->assertEquals(1, WeekEnum::MONDAY('value'));
        $this->assertEquals(2, WeekEnum::TUESDAY('value'));
        $this->assertEquals(3, WeekEnum::WEDNESDAY('value'));
        $this->assertEquals(4, WeekEnum::THURSDAY('value'));
        $this->assertEquals(5, WeekEnum::FRIDAY('value'));
        $this->assertEquals(6, WeekEnum::SATURDAY('value'));
        $this->assertEquals(0, WeekEnum::SUNDAY('value'));
    }

    /**
     * @covers ::__callStatic
     * @covers ::toArray
     * @covers ::returnMake
     * @covers ::searchConst
     * @return void
     */
    public function testTheUseOfConstNameStaticMethodGetTheZh():void
    {
        $this->assertEquals('星期一', WeekEnum::MONDAY('notes','zh'));
        $this->assertEquals('星期二', WeekEnum::TUESDAY('notes','zh'));
        $this->assertEquals('星期三', WeekEnum::WEDNESDAY('notes','zh'));
        $this->assertEquals('星期四', WeekEnum::THURSDAY('notes','zh'));
        $this->assertEquals('星期五', WeekEnum::FRIDAY('notes','zh'));
        $this->assertEquals('星期六', WeekEnum::SATURDAY('notes','zh'));
        $this->assertEquals('星期日', WeekEnum::SUNDAY('notes','zh'));
    }

    /**
     * @covers ::__callStatic
     * @covers ::toArray
     * @covers ::returnMake
     * @covers ::searchConst
     * @return void
     */
    public function testTheUseOfConstNameStaticMethodGetTheEn():void
    {
        $this->assertEquals('monday',    WeekEnum::MONDAY('notes','en'));
        $this->assertEquals('tuesday',   WeekEnum::TUESDAY('notes','en'));
        $this->assertEquals('wednesday', WeekEnum::WEDNESDAY('notes','en'));
        $this->assertEquals('thursday',  WeekEnum::THURSDAY('notes','en'));
        $this->assertEquals('friday',    WeekEnum::FRIDAY('notes','en'));
        $this->assertEquals('saturday',  WeekEnum::SATURDAY('notes','en'));
        $this->assertEquals('sunday',    WeekEnum::SUNDAY('notes','en'));
    }
}