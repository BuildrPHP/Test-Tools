<?php namespace BuildR\TestTools\Caster;

use BuildR\TestTools\Caster\AbstractCaster;

/**
 * Cast values to string
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
class StringCaster extends AbstractCaster {

    /**
     *  {@inheritdoc}
     */
    public function cast() {
        return (string) $this->value;
    }

}
