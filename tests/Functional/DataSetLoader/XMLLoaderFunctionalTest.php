<?php namespace BuildR\TestTools\Tests\Functional\DataSetLoader;

use BuildR\TestTools\BuildR_TestCase;
use BuildR\TestTools\DataSetLoader\DataSetLoaderFactory;
use BuildR\TestTools\DataSetLoader\XML\Parser\StandardXMLDefinitionParser;
use BuildR\TestTools\DataSetLoader\XML\XMLDataSetLoader;

class XMLLoaderFunctionalTest extends BuildR_TestCase {

    /**
     * The absolute location of teh example dataSet
     */
    const testFile = EXAMPLES_DIR . DIRECTORY_SEPARATOR . 'XML' . DIRECTORY_SEPARATOR . 'ExampleDataSet.xml';

    /**
     * @expectedException \BuildR\TestTools\Exception\XMLDataSetParsingException
     * @expectedExceptionMessage This test group cannot be found in your definition file! Query: /testGroups/testGroup[@name="nonExistingSet"]!
     */
    public function testParserThrowAnExceptionWhenInvalidDataSetIsSpecified() {
        $loader = DataSetLoaderFactory::XML(self::testFile, 'nonExistingSet');
        $loader->getResult();
    }

    public function testFactoryCanCreateAValidInstance() {
        $loader = DataSetLoaderFactory::XML(self::testFile);

        $this->assertInstanceOf(XMLDataSetLoader::class, $loader);
        $this->assertInstanceOf(StandardXMLDefinitionParser::class, $loader->getParser());
    }

    public function testFactoryCanSetTheLoadedDataSetOnTheParser() {
        $loader = DataSetLoaderFactory::XML(self::testFile, 'testLower');
        $result = $loader->getResult();

        $this->assertCount(1, $result);
        $this->assertCount(2, $result['Index #0']);
    }

    public function testStandardParserReturnTheFirstTestGroupIfNoOneSpecified() {
        $result = DataSetLoaderFactory::XML(self::testFile)->getResult();
        var_dump($result);

        $this->assertCount(3, $result);
    }

    public function testStandardParserCanConvertTypes() {
        $result = DataSetLoaderFactory::XML(self::testFile, 'typedTestGroup')->getResult()['Index #0'];

        //String
        $this->assertTrue(is_string($result['input']));

        //Integer
        $this->assertTrue(is_int($result['integerValue']));

        //Bool
        $this->assertTrue(is_bool($result['boolValueInteger']));
        $this->assertTrue($result['boolValueInteger']);
        $this->assertTrue(is_bool($result['boolValueTextual']));
        $this->assertFalse($result['boolValueTextual']);

        //Float
        $this->assertTrue(is_float($result['floatValue']));

        //Array
        $this->assertEquals([1, 2, 'three'], $result['arrayValue']);
    }

}
