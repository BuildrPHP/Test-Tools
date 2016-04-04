<?php namespace BuildR\TestTools\Tests\Unit\Traits;

use BuildR\Foundation\Exception\Exception;
use BuildR\TestTools\Tests\Fixtures\ReflectionUtilsImpl;
use BuildR\TestTools\Tests\Fixtures\Dummy\DummyClass;
use PHPUnit_Framework_TestCase;

class ReflectionUtilsTest extends PHPUnit_Framework_TestCase {

    /**
     * @type \BuildR\TestTools\Tests\Fixtures\ReflectionUtilsImpl
     */
    protected $reflectionUtils;

    public function setUp() {
        parent::setUp();

        $this->reflectionUtils = new ReflectionUtilsImpl();
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->reflectionUtils);
    }

    public function testGetPropertyValue() {
        //Returns property default
        $v = $this->reflectionUtils->getPropertyValue(DummyClass::class, 'propertyDefaultValue');
        $this->assertEquals('testValue', $v);

        //Returns NULL when no default property
        $v = $this->reflectionUtils->getPropertyValue(DummyClass::class, 'nonExistingProperty');
        $this->assertNull($v);

        //Returns value from concrete class
        $v = $this->reflectionUtils->getPropertyValue(DummyClass::class, 'propertyDefaultValue', (new DummyClass()));
        $this->assertEquals('testValue', $v);

        //Returns null from concrete when no property exist in concrete
        $v = $this->reflectionUtils->getPropertyValue(DummyClass::class, 'nonExistingProperty', (new DummyClass()));
        $this->assertNull($v);

        //Test instance creation
        $options = ['callConstructor' => TRUE];
        $v = $this->reflectionUtils->getPropertyValue(DummyClass::class, 'propertyValueOverwritten', NULL, $options);
        $this->assertEquals('constructorValue', $v);

        //Test instance creation with constructor parameters
        $options = ['callConstructor' => TRUE, 'constructorParams' => ['unitTestValue']];
        $v = $this->reflectionUtils->getPropertyValue(DummyClass::class, 'propertyValueOverwritten', NULL, $options);
        $this->assertEquals('unitTestValue', $v);
    }

    public function testGetStaticProperty() {
        //Test with class name
        $v = $this->reflectionUtils->getStaticPropertyValue(DummyClass::class, 'staticProperty');
        $this->assertEquals('staticValue', $v);

        //Test with object
        $v = $this->reflectionUtils->getStaticPropertyValue((new DummyClass()), 'staticProperty');
        $this->assertEquals('staticValue', $v);

        //Returns NULL when no property found
        $v = $this->reflectionUtils->getStaticPropertyValue(DummyClass::class, 'nonExistingStaticProperty');
        $this->assertNull($v);
    }

    public function testSetProperty() {
        $object = new DummyClass();

        //Throw exception when try to set a non-existing property
        try {
            $this->reflectionUtils->setProperty($object, 'nonExistingProperty', 'newValue');

            $this->assertTrue(TRUE);
        } catch(Exception $e) {
            $expectedMessage = 'Property cannot be set! This property not exist inside the given object!';

            $this->assertEquals($expectedMessage, $e->getMessage());
        }

        //Set normal properties
        $setResult = $this->reflectionUtils->setProperty($object, 'propertyValueOverwritten', 'modifiedValue');
        $v = $this->reflectionUtils->getPropertyValue(DummyClass::class, 'propertyValueOverwritten', $object);
        $this->assertEquals('modifiedValue', $v);
        $this->assertTrue($setResult);

        //Set static properties
        $setResult = $this->reflectionUtils->setProperty($object, 'staticProperty', 'anotherStaticValue');
        $v = $this->reflectionUtils->getStaticPropertyValue($object, 'staticProperty');
        $this->assertEquals('anotherStaticValue', $v);
        $this->assertTrue($setResult);
    }

    public function testInvokeMethod() {
        //Throw exception when the class has no defined method
        try {
            $this->reflectionUtils->invokeMethod(DummyClass::class, 'nonExistingMethod');

            $this->assertTrue(TRUE);
        } catch(Exception $e) {
            $expectedMessage = 'Cannot invoke method! Method not found!';

            $this->assertEquals($expectedMessage, $e->getMessage());
        }

        //Invoke static methods
        $options = ['methodParams' => [1, 5]];
        $v = $this->reflectionUtils->invokeMethod(DummyClass::class, 'add', NULL, $options);
        $this->assertEquals(6, $v);

        //Invoke methods on concrete
        $object = new DummyClass();
        $options = ['methodParams' => [256]];
        $v = $this->reflectionUtils->invokeMethod(DummyClass::class, 'neg', $object, $options);
        $this->assertEquals(-256, $v);

        //Invoke method and recreate new instance without constructor
        $options = ['methodParams' => [128]];
        $v = $this->reflectionUtils->invokeMethod(DummyClass::class, 'neg', NULL, $options);
        $this->assertEquals(-128, $v);

        //Invoke method with constructor
        $options = ['callConstructor' => TRUE];
        $v = $this->reflectionUtils->invokeMethod(DummyClass::class, 'returnConstructorValue', NULL, $options);
        $this->assertEquals('constructorValue', $v);

        //Invoke method with constructor and custom parameters
        $options = ['callConstructor' => TRUE, 'constructorParams' => ['slightlyModifiedValue']];
        $v = $this->reflectionUtils->invokeMethod(DummyClass::class, 'returnConstructorValue', NULL, $options);
        $this->assertEquals('slightlyModifiedValue', $v);
    }

}
