<?php namespace BuildR\TestTools\DataSetLoader\XML\Parser;

use BuildR\TestTools\DataSetLoader\XML\Helper\SimpleXMLNodeTypedAttributeGetter;
use BuildR\TestTools\Exception\XMLDataSetParsingException;
use SimpleXMLElement;

class StandardXMLDefinitionParser implements XMLDefinitionParserInterface {

    private $groupName;

    public function setTestGroup($groupName) {
        $this->groupName = $groupName;
    }

    private function getXPathQuery() {
        if($this->groupName === NULL) {
            return '/testGroups/testGroup[1]';
        }

        return '/testGroups/testGroup[@name="' . $this->groupName . '"]';
    }

    private function createTestArrayFromXmlElement(SimpleXMLElement $element) {
        $result = [];
        $dataSets = $element->xpath('*');

        foreach($dataSets as $dataSet) {
            $values = [];
            $properties = $dataSet->xpath('*');

            foreach($properties as $property) {
                $typedGetter = new SimpleXMLNodeTypedAttributeGetter($property);
                die(var_dump($typedGetter->value));
            }
        }
    }

    public function parse(SimpleXMLElement $root) {
        $result = $root->xpath($this->getXPathQuery());
        
        if(empty($result)) {
            throw XMLDataSetParsingException::noResult($this->getXPathQuery());
        }

        return $this->createTestArrayFromXmlElement($result[0]);
    }
    
}
