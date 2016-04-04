<?php namespace BuildR\TestTools\Exception;

use BuildR\Foundation\Exception\Exception;

/**
 * XMLDataSetParsingException
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
class XMLDataSetParsingException extends Exception {

    const MESSAGE_XPATH_NO_RESULT = 'This test group cannot be found in your definition file! Query: %s!';

    public static function noResult($nodeName) {
        return self::createByFormat(self::MESSAGE_XPATH_NO_RESULT, [$nodeName]);
    }

}
