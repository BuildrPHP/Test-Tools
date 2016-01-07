<?php namespace BuildR\TestTools\Asserts;

/**
 * Custom PHPUnit Constraint that check whenever a constant is defined and the value
 * is matches with the given value
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
class IsConstantValueEqualsConstraint extends \PHPUnit_Framework_Constraint {



    /**
     * @type mixed
     */
    protected $value;

    /**
     * IsConstantValueEqualsConstraint constructor
     *
     * @param $value mixed
     */
    public function __construct($value) {
        parent::__construct();

        $this->value = $value;
    }

    /**
     * {@inheritDoc}
     */
    protected function matches($other) {
        if(!is_string($other)) {
            return FALSE;
        }

        if(!defined($other)) {
            return FALSE;
        }

        if(constant($other) === $this->value) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * {@inheritDoc}
     */
    public function toString() {
        return 'constant value is equals to \'' . $this->value . '\'';
    }

}
