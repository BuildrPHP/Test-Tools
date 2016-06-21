<?php namespace BuildR\TestTools\Caster;

/**
 * Common interface for casters
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
interface CasterInterface {

    /**
     * Returns the properly casted input value
     *
     * @return mixed
     */
    public function cast();

}
