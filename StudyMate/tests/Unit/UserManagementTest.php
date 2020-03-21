<?php

namespace Tests\Unit;


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        // you can call
        $this->artisan('db:seed');

        // or
        //$this->seed();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     *
     */
    public function seeUsersCrudTest()
    {
        $users = User::all();
        $this->us
        $this->assertTrue($users->name->has('eyJpdiI6ImJGNi9ObHFHdkxES210dkFDbmFzSXc9PSIsInZhbHVlIjoid2tWWGtTRExQaTNSNUpPQ3pGQlNXUT09IiwibWFjIjoiMTQxN2U5NDRlODFlMTg3M2JjYTJiZGUyMzI0ZmUzZDUyM2U3ZmE1NGExODAzMGExOWJmNGUxNGE5NTIyNTNkNCJ9'));
        /*   $response = $this->get('/admin/users');
           $response->*/
        //$response->assertSee('Users');
    }
}
