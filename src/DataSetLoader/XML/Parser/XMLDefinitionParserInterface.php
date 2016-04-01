<?php namespace BuildR\TestTools\DataSetLoader\XML\Parser;

use SimpleXMLElement;

/**
 * Common interface for various XML layout parsers
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package TestTools
 * @subpackage DataSetLoader\XML\Parser
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Test-Tools/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Test-Tools
 */
interface XMLDefinitionParserInterface {

    /**
     * Parse the root SimpleXMLElement.
     *
     * @param \SimpleXMLElement $root
     *
     * @return array
     */
    public function parse(SimpleXMLElement $root);

}
