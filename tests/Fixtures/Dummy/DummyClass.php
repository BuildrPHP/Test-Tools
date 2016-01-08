<?php namespace BuildR\TestTools\Tests\Fixtures\Dummy;


class DummyClass {

    protected $propertyDefaultValue = 'testValue';

    private $propertyValueOverwritten = '';

    private static $staticProperty = 'staticValue';

    public function __construct($value = 'constructorValue') {
        $this->propertyValueOverwritten = $value;
    }

    private static function add($int1, $int2) {
        return $int1 + $int2;
    }

    protected function neg($int) {
        return $int * -1;
    }

    private function returnConstructorValue() {
        return $this->propertyValueOverwritten;
    }
}
