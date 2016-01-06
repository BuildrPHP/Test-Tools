<?php namespace BuildR\TestTools\Traits;

use Faker\Factory as FakerFactory;
use PHPUnit_Framework_TestCase;
use \InvalidArgumentException;

/**
 * Common trait that allow easy integration of Faker PHP library
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
trait FakeDataGenerator {

    /**
     * Store faker instances by locale
     *
     * @type \Faker\Generator[]
     */
    protected $fakerInstances = [];

    /**
     * Returns a new faker instance with the defined locale.
     * This function store created instances by locale, if you want to create
     * a new instance pass TRUE to $forceReCreate parameter
     *
     * @param string $locale The locale of the instance you want
     * @param bool $forceReCreate When passed any stored instance overwritten by a new one
     *
     * @return \Faker\Generator
     */
    public function getFaker($locale = 'en_US', $forceReCreate = FALSE) {
        if(isset($this->fakerInstances[$locale]) && $forceReCreate === FALSE) {
            return $this->fakerInstances[$locale];
        }

        try {
            $faker = FakerFactory::create($locale);
            $this->fakerInstances[$locale] = $faker;

            return $this->fakerInstances[$locale];
        } catch(InvalidArgumentException $e) {
            //If this is a PHPUnit test case we fail the test
            if($this instanceof PHPUnit_Framework_TestCase) {
                $this->fail('Failed to create Faker instance with locale: ' . $locale . ' Message: ' . $e->getMessage());
            }
        }
    }

}
