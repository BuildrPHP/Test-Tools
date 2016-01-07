<?php namespace BuildR\TestTools\Tests\Traits;

use BuildR\TestTools\Tests\Fixtures\FakeDataGeneratorImpl;
use PHPUnit_Framework_TestCase;
use Faker\Generator;
use \ReflectionObject;

class FakeDataGeneratorTest extends PHPUnit_Framework_TestCase {

    /**
     * @type \BuildR\TestTools\Tests\Fixtures\FakeDataGeneratorImpl
     */
    protected $generator;

    public function setUp() {
        parent::setUp();

        $this->generator = new FakeDataGeneratorImpl();
    }

    public function tearDown() {
        parent::tearDown();

        unset($this->generator);
    }

    public function testReturnsFakerCorrectly() {
        $faker = $this->generator->getFaker();

        $this->assertInstanceOf(Generator::class, $faker);
    }

    public function testGeneratorCanStoreMultipleLocalizedInstanceOfFaker() {
        $this->generator->getFaker();
        $huFaker = $this->generator->getFaker('hu_HU');

        $objectReflector = new ReflectionObject($this->generator);
        $propertyReflector = $objectReflector->getProperty('fakerInstances');
        $propertyReflector->setAccessible(TRUE);
        $property = $propertyReflector->getValue($this->generator);

        $this->assertArrayHasKey('en_US', $property);
        $this->assertArrayHasKey('hu_HU', $property);
        $this->assertCount(2, $property);

        //This is not recreate the instances with same locale
        $huFakerNew = $this->generator->getFaker('hu_HU');

        $this->assertTrue($huFaker === $huFakerNew);
        $this->assertEquals($huFaker, $huFakerNew);
    }


}
