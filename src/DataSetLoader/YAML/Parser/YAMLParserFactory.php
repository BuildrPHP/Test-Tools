<?php namespace BuildR\TestTools\DataSetLoader\YAML\Parser;

/**
 * YAMLParser Factory
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
class YAMLParserFactory {

    /**
     * Returns the most usable YAML parser for current configuration
     *
     * @return \BuildR\TestTools\DataSetLoader\YAML\Parser\YAMLParserInterface
     */
    public static function getParser() {
        //@codeCoverageIgnoreStart
        if(extension_loaded('ext-yaml')) {
            return new LibYAMLParser();
        }
        //@codeCoverageIgnoreEnd
        
        return new SymfonyYAMLParser();
    }

}
