<?php namespace BuildR\TestTools\DataSetLoader\XML;

use BuildR\TestTools\DataSetLoader\DataSetLoaderInterface;
use BuildR\TestTools\DataSetLoader\XML\Parser\StandardXMLDefinitionParser;
use BuildR\TestTools\DataSetLoader\XML\Parser\XMLDefinitionParserInterface;

/**
 * XML based date set parser
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package TestTools
 * @subpackage DataSetLoader\XML
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Test-Tools/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Test-Tools
 */
class XMLDataSetLoader implements DataSetLoaderInterface {

    /**
     * @type \BuildR\TestTools\DataSetLoader\XML\Parser\XMLDefinitionParserInterface
     */
    protected $parser;

    /**
     * @type string
     */
    protected $file;

    /**
     * @type \SimpleXMLElement
     */
    protected $xml;

    /**
     * XMLDataSetLoader constructor.
     *
     * @param string $file
     * @param \BuildR\TestTools\DataSetLoader\XML\Parser\XMLDefinitionParserInterface|NULL $parser
     */
    public function __construct($file, XMLDefinitionParserInterface $parser = NULL) {
        $this->file = $file;
        $this->parser = $parser;

        if($this->parser === NULL) {
            $this->parser = new StandardXMLDefinitionParser();
        }
    }

    /**
     * Returns the current XML definition parser
     *
     * @return \BuildR\TestTools\DataSetLoader\XML\Parser\XMLDefinitionParserInterface
     */
    public function getParser() {
        return $this->parser;
    }

    /**
     * {@inheritdoc}
     */
    public function load() {
        $this->xml = simplexml_load_file($this->file);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getResult() {
        return $this->parser->parse($this->xml);
    }


}
