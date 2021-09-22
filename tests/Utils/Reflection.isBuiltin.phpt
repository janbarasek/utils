<?php

declare(strict_types=1);

use Nette\Utils\Reflection;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


Assert::true(Reflection::isBuiltinType('int'));
Assert::true(Reflection::isBuiltinType('Int'));
Assert::false(Reflection::isBuiltinType('Foo'));

Assert::true(Reflection::isSpecialType('self'));
Assert::true(Reflection::isSpecialType('Self'));
Assert::true(Reflection::isSpecialType('static'));
Assert::true(Reflection::isSpecialType('parent'));
Assert::false(Reflection::isSpecialType('Foo'));
