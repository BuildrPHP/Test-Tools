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
class YAMLDataSetLoader implements DataSetLoaderInterface {

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
     * @type string
     */
    private $content;

    /**
     * YAMLDataSetLoader constructor.
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

        $this->load();
    }

    /**
     * Set the data set name that returned in getResult. If no specific DataSet are
     * selected, the first DataSet are selected.
     *
     * @param string $dataSetName
     *
     * @return \BuildR\TestTools\DataSetLoader\YAML\YAMLDataSetLoader
     */
    public function setDataSet($dataSetName) {
        $this->dataSetName = $dataSetName;

        return $this;
    }

    /**
     * Returns the current parser
     *
     * @return \BuildR\TestTools\DataSetLoader\YAML\Parser\YAMLParserInterface
     */
    public function getParser() {
       return $this->parser;
    }

    /**
     * {@inheritDoc}
     */
    public function load() {
        $this->content = file_get_contents($this->file);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getResult() {
        $result = $this->parser->parse($this->content);

        if($this->dataSetName !== NULL && isset($result[$this->dataSetName])) {
            return $result[$this->dataSetName];
        }

        return current($result);
    }

}
