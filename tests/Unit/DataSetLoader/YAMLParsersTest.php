<?php namespace BuildR\TestTools\Tests\Unit\DataSetLoader;

use BuildR\TestTools\BuildR_TestCase;
use BuildR\TestTools\DataSetLoader\YAML\Parser\LibYAMLParser;
use BuildR\TestTools\DataSetLoader\YAML\Parser\SymfonyYAMLParser;

class YAMLParsersTest extends BuildR_TestCase {

    const testFile = EXAMPLES_DIR . DIRECTORY_SEPARATOR . 'YAML' . DIRECTORY_SEPARATOR . 'ExampleDataSet.yaml';

    /**
     * @type array
     */
    private $symfonyParserResult;

    public function setUp() {
        parent::setUp();

        $content = file_get_contents(self::testFile);
        $this->symfonyParserResult = (new SymfonyYAMLParser())->parse($content);
    }

    public function testLibYamlParserReturnsTheSameResultAsSymfony() {
        if(!extension_loaded('ext-yaml')) {
            $this->markTestSkipped('The LibYAML extension is not installed on this system!');
        }

        $content = file_get_contents(self::testFile);
        $libYamlResult = (new LibYAMLParser())->parse($content);

        $this->assertEquals($this->symfonyParserResult, $libYamlResult);
    }

}
