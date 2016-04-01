<?php namespace BuildR\TestTools\DataSetLoader\YAML\Parser;

use Symfony\Component\Yaml\Yaml;

/**
 * YAML Parserbased on Symfony's YAML implementation.
 * It is slow, but works on any system, without any extension
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
class SymfonyYAMLParser implements YAMLParserInterface {

    /**
     * {@inheritdoc}
     */
    public function parse($yamlString) {
        return Yaml::parse($yamlString);
    }

}
