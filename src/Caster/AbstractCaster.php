<?php namespace BuildR\TestTools\Caster;

use BuildR\TestTools\Caster\CasterInterface;

/**
 * Implement some common functionality across casters
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
abstract class AbstractCaster implements CasterInterface {

    protected $value;

    public function __construct($value) {
        $this->value = $value;
    }

}
