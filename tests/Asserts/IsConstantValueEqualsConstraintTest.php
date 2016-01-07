<?php namespace BuildR\TestTools\Tests\Asserts;

use BuildR\TestTools\Asserts\IsConstantValueEqualsConstraint;
use PHPUnit_Framework_TestCase;
use SebastianBergmann\Exporter\Exporter;

class IsConstantValueEqualsConstraintTest extends PHPUnit_Framework_TestCase {

    /**
     * @type \SebastianBergmann\Exporter\Exporter
     */
    protected $exporter;

    public function setUp() {
        parent::setUp();

        $this->exporter = new Exporter();
    }

    public function tearDown() {
        parent::tearDown();

        unset ($this->exporter);
    }

    public function testConstantProvider() {
        return [
            ['testNewConstant', 'testValue', TRUE],
            ['testConstantInt', 15, TRUE],
            ['testConstantBool', TRUE, TRUE],
            ['testConstantFloat', 0.2547, TRUE],
            ['undefinedNewConstant', 'undefinedValue', FALSE],
            [20, 'undefinedValue', FALSE],
        ];
    }

    /**
     * @dataProvider testConstantProvider
     * @covers \BuildR\TestTools\Asserts\IsConstantValueEqualsConstraint
     */
    public function testConstraintWorksCorrectly($name, $value, $define) {
        if($define === TRUE) {
            define($name, $value);
        }

        $constraint = (new IsConstantValueEqualsConstraint($value));

        try {
            $constraint->evaluate($name);

            //If no exception thrown increase the assertion count by this fake assertion
            $this->assertTrue(TRUE);
        } catch(\PHPUnit_Framework_ExpectationFailedException $e) {
            $name = $this->exporter->export($name);
            $msg = 'Failed asserting that ' . $name . ' constant value is equals to \'' . $value . '\'.';

            $this->assertEquals($msg, $e->getMessage());
        }
    }

}
