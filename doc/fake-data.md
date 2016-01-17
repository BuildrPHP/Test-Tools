---
currentMenu: fake-data
baseUrl: ..
---

# FakeDataGenerator

This trait is provides easy way to generate fake data for unit testing. Its practically used in
various `data provider` you define.

This is use `faker` library by Francois Zaninotto. [Github](https://github.com/fzaninotto/Faker)

Faker can instantiated with all locale.

## Usage

Method signature:

`FakeDataGenerator::getFaker($locale = 'en_US', $forceReCreate = FALSE)`

This trait use multiton pattern to store instances of faker with various locale.
Optionally you can set second argument to TRUE to re-create instances with the given local.

## Faker documentation

View `Faker` documentation for more information: [Faker documentation](https://github.com/fzaninotto/Faker/blob/master/readme.md)
