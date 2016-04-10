<?php namespace BuildR\TestTools\DataSetLoader\XML\Parser;

use BuildR\TestTools\DataSetLoader\XML\Helper\SimpleXMLNodeTypedAttributeGetter;
use BuildR\TestTools\Exception\XMLDataSetParsingException;
use SimpleXMLElement;

/**
 * Parser for standard XML definition
 *
 * ```xml
 * <testGroups>
 *     <testGroup name="testGroup">
 *         <dataSet>
 *             <dataSetProperty name="input" value="inputValue"/>
 *             <dataSetProperty name="expected" value="INPUTVALUE"/>
 *
 *             ...
 *         </dataSet>
 *
 *         ...
 *     </testGroup>
 *
 *     ...
 * </testGroups>
 * ```
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package TestTools
 * @subpackage DataSetLoader\XML\Parser
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Test-Tools/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Test-Tools
 */
class StandardXMLDefinitionParser implements XMLDefinitionParserInterface {

    /**
     * @type string
     */
    private $groupName;

    /**
     * Set the parsed test group name. If no name set the first defined
     * group will be used.
     *
     * @param string $groupName
     */
    public function setTestGroup($groupName) {
        $this->groupName = $groupName;
    }

    /**
     * Creates the root XPath query to find the correct test group
     *
     * @return string
     */
    //@codingStandardIgnoreStart
    private function getXPathQuery() {
    //@codingStandardIgnoreEnd
        if($this->groupName === NULL) {
            return '/testGroups/testGroup[1]';
        }

        return '/testGroups/testGroup[@name="' . $this->groupName . '"]';
    }

    /**
     * Takes previously find test group and collect all data set from it
     * parses and returns an array
     *
     * @param \SimpleXMLElement $element
     *
     * @return array
     */
    private function createTestArrayFromXmlElement(SimpleXMLElement $element) {
        $result = [];
        $dataSets = $element->xpath('*');
        $setCount = 0;

        foreach($dataSets as $dataSet) {
            $values = [];

            $properties = $dataSet->xpath('*');
            $setName = (string) $dataSet->attributes()->name;
            $setName = (empty($setName)) ? 'Index #' . $setCount : $setName;

            foreach($properties as $property) {
                $typedGetter = new SimpleXMLNodeTypedAttributeGetter($property);
                $values[$typedGetter->getName()] = $typedGetter->getValue();
            }

            $result[$setName] = $values;
            $setCount++;
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function parse(SimpleXMLElement $root) {
        $result = $root->xpath($this->getXPathQuery());
        
        if(empty($result)) {
            throw XMLDataSetParsingException::noResult($this->getXPathQuery());
        }

        return $this->createTestArrayFromXmlElement($result[0]);
    }
    
}
