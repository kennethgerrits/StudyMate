<?php

namespace Tests\Browser;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @test
     */
    public function LoginSuccessTest()
    {
        Role::create(['name' => 'admin',]);
        Role::create(['name' => 'teacher',]);
        Role::create(['name' => 'guest',]);

        $user = factory(\App\User::class)->create();

        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->loginAs(User::find(1))
                ->assertAuthenticated();
        });
    }
}
