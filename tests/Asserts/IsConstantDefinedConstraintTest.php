<?php namespace BuildR\TestTools\Tests\Asserts;

use BuildR\TestTools\Asserts\IsConstantDefinedConstraint;
use PHPUnit_Framework_TestCase;

class IsConstantDefinedConstraintTest extends PHPUnit_Framework_TestCase {

    public function testConstantProvider() {
        return [
            ['testConstant', TRUE],
            ['undefinedConstant', FALSE],
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
        } catch(\PHPUnit_Framework_ExpectationFailedException $e) {
            $expectedMessage = 'Failed asserting that \'' . $constantName . '\' constant is defined.';
            $this->assertEquals($expectedMessage, $e->getMessage());
        }
    }

}
