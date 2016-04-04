<?php namespace BuildR\TestTools\Tests\Unit\Asserts;

use BuildR\TestTools\Asserts\IsConstantDefinedConstraint;
use PHPUnit_Framework_TestCase;
use SebastianBergmann\Exporter\Exporter;

class IsConstantDefinedConstraintTest extends PHPUnit_Framework_TestCase {

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
            ['testConstant', TRUE],
            ['undefinedConstant', FALSE],
            [15, FALSE],
        ];
    }

    /**
     * @dataProvider testConstantProvider
     */
    public function testConstraintWorksCorrectly($constantName, $define) {
        if($define === TRUE) {
            define($constantName, 'dummy');
        }

        $constraint = (new IsConstantDefinedConstraint());

        try {
            $constraint->evaluate($constantName);

            //If no exception thrown increase the assertion count by this fake assertion
            $this->assertTrue(TRUE);
        } catch(\PHPUnit_Framework_ExpectationFailedException $e) {
            $constantName = $this->exporter->export($constantName);
            $expectedMessage = 'Failed asserting that ' . $constantName . ' constant is defined.';

            $this->assertEquals($expectedMessage, $e->getMessage());
        }
    }

}
