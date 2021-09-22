<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{  // classe de base pour les tests (ils sont des extends de TestCase)
    use CreatesApplication;
}
