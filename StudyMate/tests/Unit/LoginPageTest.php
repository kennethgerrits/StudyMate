<?php

namespace Tests\Unit;


use Tests\TestCase;

class LoginPageTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     */
    public function correctPageInfoTest()
    {
        $response = $this->get('/login');
        $response->assertSee('Login');
    }
}
