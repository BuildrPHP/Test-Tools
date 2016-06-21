<?php namespace BuildR\TestTools\Exception;

use BuildR\Foundation\Exception\Exception;

/**
 * CasterException
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package TestTools
 * @subpackage Exception
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Test-Tools/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Test-Tools
 *
 * @codeCoverageIgnore
 */
class CasterException extends Exception {

    public static function unresolvableType($type) {
        return self::createByFormat('Cannot find any caster for this type: %s', [$type]);
    }

}
