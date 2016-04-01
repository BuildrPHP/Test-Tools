<?php namespace BuildR\TestTools\DataSetLoader\YAML;

use BuildR\TestTools\DataSetLoader\DataSetLoaderInterface;
use BuildR\TestTools\DataSetLoader\YAML\Parser\YAMLParserFactory;
use BuildR\TestTools\DataSetLoader\YAML\Parser\YAMLParserInterface;

/**
 * YAML based DataSet loader
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package TestTools
 * @subpackage DataSetLoader\YAML
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Test-Tools/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Test-Tools
 */
class YAMLDataSetParser implements DataSetLoaderInterface {

    /**
     * @type string
     */
    protected $file;

    /**
     * @type \BuildR\TestTools\DataSetLoader\YAML\Parser\YAMLParserInterface
     */
    protected $parser;

    /**
     * @type string|NULL
     */
    private $dataSetName;

    /**
     * @type array
     */
    private $result;

    /**
     * YAMLDataSetParser constructor.
     *
     * @param string $file The laoded YAML file absolute location
     * @param \BuildR\TestTools\DataSetLoader\YAML\Parser\YAMLParserInterface $parser
     */
    public function __construct($file, YAMLParserInterface $parser = NULL) {
        $this->file = $file;
        $this->parser = $parser;

        if($this->parser === NULL) {
            $this->parser = YAMLParserFactory::getParser();
        }
    }

    /**
     * Set the data set name that returned in getResult. If no specific DataSet are
     * selected, the first DataSet are selected.
     *
     * @param string $dataSetName
     *
     * @return \BuildR\TestTools\DataSetLoader\YAML\YAMLDataSetParser
     */
    public function setDataSet($dataSetName) {
        $this->dataSetName = $dataSetName;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function load() {
        $content = file_get_contents($this->file);
        $this->result = $this->parser->parse($content);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getResult() {
        if($this->dataSetName !== NULL && isset($this->result[$this->dataSetName])) {
            return $this->result[$this->dataSetName];
        }

        return current($this->result);
    }

}
