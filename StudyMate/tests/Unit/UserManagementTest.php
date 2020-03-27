<?php

namespace Tests\Unit;

use App\Role;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     */

    public function GuestUnauthorizedTest()
    {
        // 1. Arrange
        $adminRole = Role::create(['name' => 'admin',]);
        $teacherRole = Role::create(['name' => 'teacher',]);
        $guestRole = Role::create(['name' => 'guest',]);
        $guest = factory(User::class)->create();
        $guest->roles()->attach($guestRole);
        // 2. Act
        $bool = Gate::forUser($guest)->denies('manage-modules');
        // 3. Assert
        $this->assertEquals(true, $bool);

    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     */

    public function TeacherUnauthorizedTest()
    {
        // 1. Arrange
        $adminRole = Role::create(['name' => 'admin',]);
        $teacherRole = Role::create(['name' => 'teacher',]);
        $guestRole = Role::create(['name' => 'guest',]);
        $teacher = factory(User::class)->create();
        $teacher->roles()->attach($teacherRole);
        // 2. Act
        $bool = Gate::forUser($teacher)->denies('manage-modules');
        // 3. Assert
        $this->assertEquals(true, $bool);

    }

    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     */

    public function AdminUnauthorizedTest()
    {
        // 1. Arrange
        $adminRole = Role::create(['name' => 'admin',]);
        $teacherRole = Role::create(['name' => 'teacher',]);
        $guestRole = Role::create(['name' => 'guest',]);
        $admin = factory(User::class)->create();
        $admin->roles()->attach($adminRole);
        // 2. Act
        $bool = Gate::forUser($admin)->denies('manage-modules');
        // 3. Assert
        $this->assertEquals(false, $bool);

    }
}