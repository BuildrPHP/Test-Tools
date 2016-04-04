<?php namespace BuildR\TestTools\DataSetLoader\XML\Helper;

use SimpleXMLElement;

/**
 * Simple helper class for StandardXMLDefinitionParser class. This class takes the
 * parsed SimpleXML nodes (dataSetProperty) and process defined values
 * and force the defined type if is specified.
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package TestTools
 * @subpackage DataSetLoader\XML\Helper
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Test-Tools/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Test-Tools
 */
class SimpleXMLNodeTypedAttributeGetter {

    /**
     * @type \SimpleXMLElement
     */
    private $element;

    /**
     * SimpleXMLNodeTypedAttributeGetter constructor.
     * This is the standard definition <dataSetProperty /> nodes.
     *
     * @param \SimpleXMLElement $element
     */
    public function __construct(SimpleXMLElement $element) {
        $this->element = $element;
    }

    /**
     * Post-processing the node value by additionally specified type
     * declaration. If no type is defined, values returned as string.
     *
     * @return bool|float|int|string
     */
    public function getValue() {
        $type = (string) $this->element->attributes()->type;
        $type = (empty($type)) ? 'string' : $type;
        $value = (string) $this->element->attributes()->value;

        switch($type) {
            case 'int':
            case 'integer':
                $value = (int) $value;
                break;
            case 'bool':
            case 'boolean':
                if($value == 'true' || $value == 'false') {
                    $value = ($value == 'true') ? TRUE : FALSE;
                }

                $value = (bool) $value;
                break;
            case 'float':
            case 'double':
                $value = (float) $value;
                break;
            case 'array':
                $value = explode(';', $value);
                break;
        }

        return $value;
    }

    /**
     * Returns the node name. If the node not defines 'name'
     * attribute an empty string will be returned.
     *
     * @return string
     */
    public function getName() {
        return (string) $this->element->attributes()->name;
    }

}
