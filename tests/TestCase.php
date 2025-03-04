<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use WithFaker;
    protected function setUpFaker(): void
    {
        $this->faker = $this->makeFaker('pt_BR');
    }
}
