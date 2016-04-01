<?php namespace BuildR\TestTools\DataSetLoader\XML;

use BuildR\TestTools\DataSetLoader\DataSetLoaderInterface;
use BuildR\TestTools\DataSetLoader\XML\Parser\StandardXMLDefinitionParser;
use BuildR\TestTools\DataSetLoader\XML\Parser\XMLDefinitionParserInterface;

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
     * @inheritDoc
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
