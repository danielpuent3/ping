<?php

namespace Tests;

use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{

    use CreatesApplication;
    use RefreshDatabase;
    use WithFaker;

    protected function headers($token)
    {
        return [
            'Authorization' => "Bearer {$token}",
        ];
    }
}
