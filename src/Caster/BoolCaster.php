<?php namespace BuildR\TestTools\Caster;

use BuildR\TestTools\Caster\AbstractCaster;

/**
 * Cast values to boolean
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package TestTools
 * @subpackage DataSetLoader\XML\StaticType\Caster
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Test-Tools/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Test-Tools
 */
class BoolCaster extends AbstractCaster {

    /**
     *  {@inheritdoc}
     */
    public function cast() {
        if($this->value == 'true' || $this->value == 'false') {
            $this->value = ($this->value == 'true') ? TRUE : FALSE;
        }

        return (bool) $this->value;
    }

}
