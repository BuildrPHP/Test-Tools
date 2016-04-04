<?php namespace BuildR\TestTools\DataSetLoader\YAML\Parser;

/**
 * YAML Parser based on LibYaml extension
 * Requires LibYaml PHP extension to be installed
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
 *
 * @codeCoverageIgnoreFile
 */
class LibYAMLParser implements YAMLParserInterface {

    /**
     * {@inheritdoc}
     */
    public function parse($yamlString) {
        return yaml_parse($yamlString);
    }

}
