<?php namespace BuildR\TestTools\Tests\Unit\DataSetLoader;

use BuildR\TestTools\BuildR_TestCase;
use BuildR\TestTools\DataSetLoader\DataSetLoaderFactory;
use BuildR\TestTools\DataSetLoader\YAML\Parser\LibYAMLParser;

class YAMLLoaderUnitTest extends BuildR_TestCase {

    const testFile = EXAMPLES_DIR . DIRECTORY_SEPARATOR . 'YAML' . DIRECTORY_SEPARATOR . 'ExampleDataSet.yaml';

    public function testFactoryCanSetPreDefinedParser() {
        $libYamlParser = new LibYAMLParser();
        $loader = DataSetLoaderFactory::YAML(self::testFile, NULL, $libYamlParser);

        $this->assertInstanceOf(LibYAMLParser::class, $loader->getParser());
    }

}
