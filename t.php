<?php

include 'bootstrap.php';

$p = new \BuildR\TestTools\DataSetLoader\XML\Parser\StandardXMLDefinitionParser();
$p->setTestGroup('testUpper');
$L = \BuildR\TestTools\DataSetLoader\DataSetLoaderFactory::XML(__DIR__ . '/examples/DataSet/XML/ExampleDataSet.xml', $p);
$r = $L->load()->getResult();

var_dump($r);
