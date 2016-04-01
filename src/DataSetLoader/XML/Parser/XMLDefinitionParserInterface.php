<?php namespace BuildR\TestTools\DataSetLoader\XML\Parser;

use SimpleXMLElement;

interface XMLDefinitionParserInterface {

    public function parse(SimpleXMLElement $root);

}
