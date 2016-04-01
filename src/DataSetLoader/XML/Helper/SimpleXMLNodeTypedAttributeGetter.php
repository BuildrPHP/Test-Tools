<?php namespace BuildR\TestTools\DataSetLoader\XML\Helper;

use SimpleXMLElement;

class SimpleXMLNodeTypedAttributeGetter {

    /**
     * @type \SimpleXMLElement
     */
    private $element;

    public function __construct(SimpleXMLElement $element) {
        $this->element = $element;
    }

    public function __get($name) {
        $attribute = (string) $this->element->attributes()->{$name};

        return $attribute * 1;
    }

}
