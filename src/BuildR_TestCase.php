<?php namespace BuildR\TestTools;

use BuildR\TestTools\Traits\FakeDataGenerator;
use BuildR\TestTools\Traits\ReflectionUtilities;
use PHPUnit_Framework_TestCase;

/**
 * Test case that use the traits for testing that this package provides
 *
 * BuildR PHP Framework
 *
 * @author Zoltán Borsos <zolli07@gmail.com>
 * @package TestTools
 *
 * @copyright    Copyright 2016, Zoltán Borsos.
 * @license      https://github.com/BuildrPHP/Test-Tools/blob/master/LICENSE.md
 * @link         https://github.com/BuildrPHP/Test-Tools
 */
class BuildR_TestCase extends PHPUnit_Framework_TestCase {

    use FakeDataGenerator;
    use ReflectionUtilities;

}
