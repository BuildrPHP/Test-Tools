---
currentMenu: reflection-utils
baseUrl: ..
---

# ReflectionUtilities

Reflection is really useful during writing integration and unit test. This trait provide
many useful method to easily use PHP's reflection API.

## Retrieving property value

Method signature:

```php
ReflectionUtilities::getPropertyValue(string $className, string $propertyName, object $concreteClass = NULL, array $options = []);
```

Properties can give from classes or concrete objects. When property is read from a class the property
default property will be returned. When you give a concrete object the property is read from the concrete
object instead of default value.

Available options:

 - callConstructor (bool)
 - constructorParams (array) (key is property name value is the property value)

When you not pass a concrete object, this method need to create a new instance. The `callConstructor`
option is used to determine that the new instance is created without the constructor calling or not.

This useful (and slightly faster) when you try to read the property initial value. But set `TRUE` when the constrcutor
is can modify the property you want to read.

## Retrieving static properties value

Method signature:

```php
ReflectionUtilities::getStaticPropertyValue(object|string $object, string $propertyName)
```

You can pass string (FQCN) or concrete objects. and the property you want to be read.

## Set objects properties

Method signature:

```php
ReflectionUtilities::setProperty(object $object, string $property, mixed $value)
```

This method can use to set values on concrete objects. When the given object not has the defined property
this method will throw an `\BuildR\Foundation\Exception\Exception`

## Method invocation

This method provides a way to call methods declared with `private` or `protected` visibility.

Method signature:

```php
ReflectionUtilities::invokeMethod(string $className, string $methodName, object $concreteClass = NULL, array $options = [])
```

Methods are invoked from classes or concrete objects. When you not give a concrete object a new instance from the class
is created.

Available options:

 - methodParams (array) (key is variable name, value is the value of the variable)
 - callConstructor (bool)
 - constructorParams (array) (key is property name value is the property value)

The `callConstructor` param defines that this method needs to create a new instance with the class constructor ow not.
When ypu want to pass values to constructor you can use `constructorParams` options to pass it.

Method parameters also defined by an option called `methodParams`.

This method throws an `\BuildR\Foundation\Exception\Exception` when the object not define a method with the given name.
