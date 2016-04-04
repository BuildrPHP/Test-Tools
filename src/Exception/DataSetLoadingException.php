<?php namespace BuildR\TestTools\Exception;

use BuildR\Foundation\Exception\Exception;

/**
 * DataSetLoadingException
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
class DataSetLoadingException extends Exception {

    const MESSAGE_LOAD_FAILED = 'The data set (%s) cannot be loaded Message: %s!';

    /**
     * This exception type is used to indicates error occurred while data-set loading
     *
     * @param string $dataSetName
     * @param string $externalMessage
     *
     * @return \BuildR\TestTools\Exception\DataSetLoadingException
     */
    public static function loadFailed($dataSetName, $externalMessage = '') {
        return self::createByFormat(self::MESSAGE_LOAD_FAILED, [$dataSetName, $externalMessage]);
    }

}
