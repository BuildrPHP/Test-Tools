<?php namespace BuildR\TestTools\DataSetLoader;

use BuildR\TestTools\DataSetLoader\YAML\YAMLDataSetLoader;

/**
 * DataSetParser Factory
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package TestTools
 * @subpackage DataSetLoader
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Test-Tools/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Test-Tools
 */
class DataSetLoaderFactory {

    /**
     * Creates a new YAML dataSet parser
     *
     * @param string $fileLocation File absolute location
     *
     * @return \BuildR\TestTools\DataSetLoader\YAML\YAMLDataSetLoader
     */
    public static function YAML($fileLocation) {
        return new YAMLDataSetLoader($fileLocation);
    }

}
