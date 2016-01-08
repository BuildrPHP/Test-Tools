<?php namespace BuildR\TestTools\Traits;

use BuildR\Foundation\Exception\Exception;
use ReflectionClass;
use ReflectionObject;

/**
 * Common trait that contains helper function to working with PHP reflection API
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package TestTools
 * @subpackage Traits
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Test-Tools/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Test-Tools
 */
trait ReflectionUtilities {

    /**
     * Read a property value from a given class or concrete object. This function can handle automatic creation
     * of new instances of the given class.
     *
     * If no concrete object provided and the 'callConstructor' option is FALSE reads the property default value
     * from the class.
     *
     * If a concrete object is provided returns the property value from the given concrete object.
     *
     * If the 'callConstructor' is TRUE and concrete object is not provided this method try to instantiate a
     * new object from thi given class using the 'constructorParams' option.
     *
     * options:
     * 'callConstructor' => bool
     * 'constructorParams' => array (key is variable name, value is the value of the variable)
     *
     * @param string $className The FQCN
     * @param string $propertyName The property name
     * @param object|NULL $concreteClass Optionally concrete class
     * @param array $options Options defined as an array
     *
     * @return NULL|mixed
     */
    public function getPropertyValue($className, $propertyName, $concreteClass = NULL, $options = []) {
        $callConstructor = (isset($options['callConstructor'])) ? (bool) $options['callConstructor'] : FALSE;
        $reflector = new ReflectionClass($className);

        //This is a default property
        if($concreteClass === NULL && $callConstructor === FALSE) {
            $properties = $reflector->getDefaultProperties();

            return (isset($properties[$propertyName])) ? $properties[$propertyName] : NULL;
        }

        //Return NULL if this class not has the given property
        if(!$reflector->hasProperty($propertyName)) {
            return NULL;
        }

        //Get reflector for property and set it accessible
        $propertyReflector = $reflector->getProperty($propertyName);
        $propertyReflector->setAccessible(TRUE);

        //If we give a concrete class returns the value from this class
        if($concreteClass !== NULL) {
            return $propertyReflector->getValue($concreteClass);
        }

        //Needs to call the class constructor
        if($callConstructor === TRUE) {
            $constructorParams = (isset($options['constructorParams'])) ? (array) $options['constructorParams'] : [];

            return $propertyReflector->getValue($reflector->newInstanceArgs($constructorParams));
        }

        //This should never happen
        //@codeCoverageIgnoreStart
        return NULL;
        //@codeCoverageIgnoreEnd
    }

    /**
     * Returns a static property from the given class. You can pass this function an object or
     * a FQCN as string.
     *
     * @param object|string $object A concrete class or a FQCN
     * @param string $propertyName The property name
     *
     * @return NULL|mixed
     */
    public function getStaticPropertyValue($object, $propertyName) {
        $className = $object;

        if(is_object($className)) {
            $className = get_class($object);
        }

        $reflector = new ReflectionClass($className);
        $properties = $reflector->getStaticProperties();

        return (isset($properties[$propertyName])) ? $properties[$propertyName] : NULL;
    }

    /**
     * Set a property value on the given object. If the property is not found in the given object
     * an Exception will be thrown.
     *
     * @param object $object A concrete object
     * @param string $property The property name
     * @param mixed $value The property new value
     *
     * @return bool
     *
     * @throws \BuildR\Foundation\Exception\Exception
     */
    public function setProperty($object, $property, $value) {
        $objectReflector = new ReflectionObject($object);

        if(!$objectReflector->hasProperty($property)) {
            throw new Exception('Property cannot be set! This property not exist inside the given object!');
        }

        $propertyReflector = $objectReflector->getProperty($property);
        $propertyReflector->setAccessible(TRUE);
        $propertyReflector->setValue($object, $value);

        return TRUE;
    }

    /**
     * @param $className
     * @param $methodName
     * @param null $concreteClass
     * @param array $options
     *
     * options:
     * 'callConstructor' => bool
     * 'constructorParams' => array (key is variable name, value is the value of the variable)
     * 'methodParams' => array (key is variable name, value is the value of the variable)
     *
     * @return mixed
     *
     * @throws \BuildR\Foundation\Exception\Exception
     */
    public function invokeMethod($className, $methodName, $concreteClass = NULL, array $options = []) {
        $callConstructor = (isset($options['callConstructor'])) ? (bool) $options['callConstructor'] : FALSE;
        $methodParams = (isset($options['methodParams'])) ? (array) $options['methodParams'] : [];
        $objectReflector = new ReflectionClass($className);

        if(!$objectReflector->hasMethod($methodName)) {
            throw new Exception('Cannot invoke method! Method not found!');
        }

        $methodReflector = $objectReflector->getMethod($methodName);
        $methodReflector->setAccessible(TRUE);

        //If this is a static method we simply call it without object creation
        if($methodReflector->isStatic()) {
            return $methodReflector->invokeArgs(NULL, $methodParams);
        }

        //If concrete is given
        if($concreteClass !== NULL) {
            return $methodReflector->invokeArgs($concreteClass, $methodParams);
        }

        $calledObject = $objectReflector->newInstanceWithoutConstructor();
        if($callConstructor === TRUE) {
            $constructorParams = (isset($options['constructorParams'])) ? (array) $options['constructorParams'] : [];
            $calledObject = $objectReflector->newInstanceArgs($constructorParams);
        }

        return $methodReflector->invokeArgs($calledObject, $methodParams);
    }

}
