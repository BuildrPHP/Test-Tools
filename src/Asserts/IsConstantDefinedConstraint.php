<?php namespace BuildR\TestTools\Asserts;

/**
 * Custom PHPUnit Constraint that check whenever a constant is defined.
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package TestTools
 * @subpackage Asserts
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Test-Tools/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Test-Tools
 */
class IsConstantDefinedConstraint extends \PHPUnit_Framework_Constraint {

    /**
     * {@inheritDoc}
     */
    protected function matches($other) {
        if(!is_string($other)) {
            return FALSE;
        }

        if(is_string($other) && defined($other)) {
            return TRUE;
        }

        return FALSE;
    }


    /**
     * {@inheritDoc}
     */
    public function toString() {
        return 'constant is defined';
    }

}
