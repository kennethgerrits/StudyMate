<?php

namespace Tests\Browser;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class UserManagementTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Admin can delete user.
     *
     * @test
     */
    public function AdminCanDeleteUserTest()
    {
        $adminRole = Role::create(['name' => 'admin',]);
        $teacherRole = Role::create(['name' => 'teacher',]);

        $teacher = factory(\App\User::class)->create();
        $teacher->roles()->attach($teacherRole);

        $admin = factory(\App\User::class)->create();
        $admin->roles()->attach($adminRole);

        $this->browse(function ($browser) {
            $browser
                ->loginAs(User::find(2))
                ->assertAuthenticated()
                ->visit('/admin/users')
                ->assertSeeIn('@header', 'Users')
                ->assertSee('admin')
                ->assertSee('teacher')
                ->click('@deleteUserBtn')
                ->assertSee(' has been deleted')
                ->assertDontSee('teacher')
                ->screenshot('deletedUserConfirmation');
        });
    }

    /**
     * Admin can edit user.
     *
     * @test
     */
    public function AdminCanEditUserTest()
    {
        $adminRole = Role::create(['name' => 'admin',]);
        $teacherRole = Role::create(['name' => 'teacher',]);

        $teacher = factory(\App\User::class)->create();
        $teacher->roles()->attach($teacherRole);

        $admin = factory(\App\User::class)->create();
        $admin->roles()->attach($adminRole);

        $this->browse(function ($browser) {
            $browser
                ->loginAs(User::find(2))
                ->assertAuthenticated()
                ->visit('/admin/users')
                ->assertSeeIn('@header', 'Users')
                ->assertSee('admin')
                ->assertSee('teacher')
                ->click('@editUserBtn')
                ->type('name', 'Kenneth Gerrits')
                ->click('@updateUserBtn')
                ->assertSee('Kenneth Gerrits has been updated.')
                ->screenshot('userNameIsEdited');
        });
    }

    /**
     * A teacher cannot delete an user.
     *
     * @test
     */
    public function TeacherCantDeleteUserTest()
    {
        $teacherRole = Role::create(['name' => 'teacher',]);

        $teacher = factory(\App\User::class)->create();
        $teacher->roles()->attach($teacherRole);

        $this->browse(function ($browser) {
            $browser
                ->loginAs(User::find(1))
                ->assertAuthenticated()
                ->visit('/admin/users')
                ->assertSee('403')
                ->assertSee('This action is unauthorized.');
        });
    }
}
