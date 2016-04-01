<?php namespace BuildR\TestTools\DataSetLoader;

/**
 * Common interface for various data-set loaders
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
interface DataSetLoaderInterface {

    /**
     * Try to loads the currently defined data set
     * 
     * @return \BuildR\TestTools\DataSetLoader\DataSetLoaderInterface
     * 
     * @throws \BuildR\TestTools\Exception\DataSetLoadingException
     *
     * @return \BuildR\TestTools\DataSetLoader\DataSetLoaderInterface
     */
    public function load();

    /**
     * Returns an array that can be used as PHPUnit dataProvider
     *
     * @return array
     */
    public function getResult();

}
