<?php namespace BuildR\TestTools\Tests\Functional\DataSetLoader;

use BuildR\TestTools\BuildR_TestCase;
use BuildR\TestTools\DataSetLoader\DataSetLoaderFactory;
use BuildR\TestTools\DataSetLoader\YAML\Parser\YAMLParserInterface;
use BuildR\TestTools\DataSetLoader\YAML\YAMLDataSetLoader;

class YAMLLoaderFunctionalTest extends BuildR_TestCase {

    const testFile = EXAMPLES_DIR . DIRECTORY_SEPARATOR . 'YAML' . DIRECTORY_SEPARATOR . 'ExampleDataSet.yaml';

    public function testFactoryCanReturnAValidInstance() {
        $loader = DataSetLoaderFactory::YAML(self::testFile);

        $this->assertInstanceOf(YAMLDataSetLoader::class, $loader);
        $this->assertInstanceOf(YAMLParserInterface::class, $loader->getParser());
    }

    public function testFactorySetsTheDefinedDataSetOnLoader() {
        $result = DataSetLoaderFactory::YAML(self::testFile, 'testUpper')->getResult();

        $this->assertCount(2, $result);
        $this->assertEquals('test', $result[0]['input']);
    }

    public function testLoaderUseTheFirstDataSetIfNoOneSpecified() {
        $result = DataSetLoaderFactory::YAML(self::testFile)->getResult();

        $this->assertCount(1, $result);
        $this->assertEquals('TEST', $result[0]['input']);
    }

}
