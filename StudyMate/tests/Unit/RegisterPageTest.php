<?php

namespace Tests\Unit;


use Tests\TestCase;

class RegisterPageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     */
    public function correctPageInfoTest()
    {
        $response = $this->get('/register');
        $response->assertSee('Register');
    }
}
