<?php namespace BuildR\TestTools\DataSetLoader\YAML\Parser;

/**
 * YAML Parser interface
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package TestTools
 * @subpackage DataSetLoader\YAML\Parser
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Test-Tools/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Test-Tools
 */
interface YAMLParserInterface {

    /**
     * Parses the given YAML string
     *
     * @param string $yamlString
     *
     * @return array
     */
    public function parse($yamlString);

}
