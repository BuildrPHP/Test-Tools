<?php namespace BuildR\TestTools\DataSetLoader\XML\StaticType;

use BuildR\TestTools\Caster\ArrayCaster;
use BuildR\TestTools\Caster\BoolCaster;
use BuildR\TestTools\Caster\FloatCaster;
use BuildR\TestTools\Caster\IntCaster;
use BuildR\TestTools\Caster\StringCaster;
use BuildR\TestTools\Exception\CasterException;
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
 * @subpackage DataSetLoader\XML\StaticType
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Test-Tools/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Test-Tools
 */
class SimpleXMLNodeTypedAttributeGetter {

    /**
     * List of available casters
     *
     * @type array
     */
    private $casters = [
        'string' => StringCaster::class,
        'int|integer' => IntCaster::class,
        'bool|boolean' => BoolCaster::class,
        'float|double' => FloatCaster::class,
        'array' => ArrayCaster::class,
    ];

    /**
     * Runtime caching
     *
     * @type array
     */
    private $cache = [];
    
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

        $casterClassName = $this->tryGetClassFromCache($type);

        // If caching not provides result
        if($casterClassName === NULL) {
            $casterClassName = $this->resolveCasterClassName($type);
        }

        /** @type \BuildR\TestTools\Caster\CasterInterface $casterObject */
        $casterObject = new $casterClassName($value);
        return $casterObject->cast();
    }

    /**
     * Resolve the correct caster class by defined type
     *
     * @param string $type
     *
     * @return string
     * @throws \BuildR\TestTools\Exception\CasterException
     */
    private function resolveCasterClassName($type) {
        foreach($this->casters as $typeNames => $casterClass) {
            $names = explode('|', $typeNames);

            if(!in_array($type, $names)) {
                continue;
            }

            return $casterClass;
        }
        
        throw CasterException::unresolvableType($type);
    }
    
    /**
     * Try to fetch resolved type caster class from runtime cache
     *
     * @param string $type
     *
     * @return string|NULL
     */
    private function tryGetClassFromCache($type) {
        if(isset($this->cache[$type])) {
            return $this->cache[$type];
        }

        return NULL;
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
