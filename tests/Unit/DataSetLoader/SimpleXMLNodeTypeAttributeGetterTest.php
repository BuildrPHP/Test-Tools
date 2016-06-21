<?php namespace BuildR\TestTools\Tests\Unit\DataSetLoader;

use BuildR\TestTools\BuildR_TestCase;
use BuildR\TestTools\DataSetLoader\XML\StaticType\SimpleXMLNodeTypedAttributeGetter;

class SimpleXMLNodeTypeAttributeGetterTest extends BuildR_TestCase {

    /**
     * @expectedException \BuildR\TestTools\Exception\CasterException
     * @expectedExceptionMessage Cannot find any caster for this type: nonExist
     */
    public function testItThrowsExceptionWithNonDefinedCaster() {
        $fakeNode = new \SimpleXMLElement('<dataSetProperty name="test" value="testValue" type="nonExist" />');

        $getter = new SimpleXMLNodeTypedAttributeGetter($fakeNode);
        $getter->getValue();
    }

}
