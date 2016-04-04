<?php namespace BuildR\TestTools\DataSetLoader;

use BuildR\TestTools\DataSetLoader\XML\Parser\XMLDefinitionParserInterface;
use BuildR\TestTools\DataSetLoader\XML\XMLDataSetLoader;
use BuildR\TestTools\DataSetLoader\YAML\Parser\YAMLParserInterface;
use BuildR\TestTools\DataSetLoader\YAML\YAMLDataSetLoader;

/**
 * DataSetParser Factory
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package TestTools
 * @subpackage DataSetLoader
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Test-Tools/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Test-Tools
 */
class DataSetLoaderFactory {

    /**
     * Creates a new YAML dataSet parser
     *
     * @param string $fileLocation File absolute location
     * @param string|NULL $dataSetName The name of the loaded dataSet If not provided, the first dataSet will be used.
     * @param \BuildR\TestTools\DataSetLoader\YAML\Parser\YAMLParserInterface|NULL $parser
     *
     * @return \BuildR\TestTools\DataSetLoader\YAML\YAMLDataSetLoader
     */
    //@codingStandardIgnoreStart
    public static function YAML($fileLocation, $dataSetName = NULL, YAMLParserInterface $parser = NULL) {
    //@codingStandardIgnoreEnd
        $loader = new YAMLDataSetLoader($fileLocation, $parser);

        if($dataSetName !== NULL) {
            $loader->setDataSet($dataSetName);
        }

        return $loader;
    }

    /**
     * Creates a new XML dateSet parser
     *
     * @param string $fileLocation Input file absolute location
     * @param string|NULL $dataSetName The name of the loaded dataSet If not provided, the first dataSet will be used.
     * @param \BuildR\TestTools\DataSetLoader\XML\Parser\XMLDefinitionParserInterface|NULL $parser
     *
     * @return \BuildR\TestTools\DataSetLoader\XML\XMLDataSetLoader
     *
     * @codingStandardsIgnoreLine
     */
    //@codingStandardIgnoreStart
    public static function XML($fileLocation, $dataSetName = NULL, XMLDefinitionParserInterface $parser = NULL) {
    //@codingStandardIgnoreEnd
        $loader = new XMLDataSetLoader($fileLocation, $parser);

        if($dataSetName !== NULL) {
            /** @type \BuildR\TestTools\DataSetLoader\XML\Parser\StandardXMLDefinitionParser $parser */
            $parser = $loader->getParser();
            $parser->setTestGroup($dataSetName);
        }

        return $loader;
    }

}
