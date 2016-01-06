<?php namespace BuildR\TestTools\Traits;

use Faker\Factory as FakerFactory;
use \InvalidArgumentException;

class FakeDataGenerator {

    /**
     * Faker instances default localization
     */
    const FAKER_LOCALE = 'en_US';

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
    public function getFaker($locale = self::FAKER_LOCALE, $forceReCreate = FALSE) {
        if(isset($this->fakerInstances[$locale]) && $forceReCreate === FALSE) {
            return $this->fakerInstances[$locale];
        }

        try {
            $faker = FakerFactory::create($locale);
            $this->fakerInstances[$locale] = $faker;

            return $this->fakerInstances[$locale];
        } catch(InvalidArgumentException $e) {
            $this->fail('Failed to create Faker instance with locale: ' . $locale . ' Message: ' . $e->getMessage());
        }
    }

}
