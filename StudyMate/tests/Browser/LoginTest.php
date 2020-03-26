<?php

namespace Tests\Browser;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
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
        $admin = Role::create(['name' => 'admin',]);
        Role::create(['name' => 'teacher',]);
        Role::create(['name' => 'student',]);

        $user = User::create([
            'name' => 'Niels',
            'email' => '123@123.nl',
            'password' => 'password',
        ]);
        //dd($user);
//        factory(\App\RoleUser::class)->create([
//            'user_id' => $user->id,
//            'role_id' => Role::ADMIN,
//        ]);
        $user->roles()->attach($admin);
        $this->browse(function (Browser $browser){
            dd(User::find(1));
            $browser
                ->loginAs(User::find(1))
                ->screenshot('login_screen')
                ->assertSeeIn('@header', 'user');
        });
    }
}
