---
currentMenu: assertions
baseUrl: ..
---

# Assertions

This class provides a custom `test case` called `BuildR_TestCase`.
You can use this case instead of `\PHPUnit_Framework_TestCase`. This test case provide some
custom assertions that `PHPUnit` not provide by default.

## Constants assertions

Constants are really convenient way to test interfaces dummy implementations. For example a dummy
class loader can define a constant with `LOADED_<CLASS_NAME>` to indicate that this successfully loaded a class.

Method signatures:

```php
BuildR_TestCase::assertConstantDefined(string $constantName)
```

```php
BuildR_TestCase::assertConstantEquals(string $constantName, mixed $constantValue)
```
