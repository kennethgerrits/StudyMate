<?php

namespace Tests\Unit;

use App\Block;
use App\Module;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class DashboardTests extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function MaxEcIsEqualToTenTest()
    {
        //1. Arrange
        //Roles
        Role::create(['name' => 'admin',]);
        $teacher = Role::create(['name' => 'teacher',]);
        $guestrole = Role::create(['name' => 'guest',]);
        //Blocks
        for ($i = 0; $i < 12; $i++) {
            Block::create();
        }
        $guest = factory(User::class)->create();
        $guest->roles()->attach($guestrole);
        $teachers = factory(User::class, 10)->create()->each(function ($user) use ($teacher) {
            $user->roles()->attach($teacher);
        });
        factory(Module::class, 10)->create([
            'overseer' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'taught_by' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'followed_by' => $guest->id,
            'is_finished' => 1,
            'study_points' => 1
        ]);

        //2. Act
        $maxEC = $guest->max_ec;

        //3. Assert
        $this->assertEquals(10, $maxEC);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function AchievedEcIsEqualToTenTest()
    {
        //1. Arrange
        //Roles
        Role::create(['name' => 'admin',]);
        $teacher = Role::create(['name' => 'teacher',]);
        $guestrole = Role::create(['name' => 'guest',]);
        //Blocks
        for ($i = 0; $i < 12; $i++) {
            Block::create();
        }
        $guest = factory(User::class)->create();
        $guest->roles()->attach($guestrole);
        $teachers = factory(User::class, 10)->create()->each(function ($user) use ($teacher) {
            $user->roles()->attach($teacher);
        });
        factory(Module::class, 10)->create([
            'overseer' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'taught_by' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'followed_by' => $guest->id,
            'is_finished' => 1,
            'study_points' => 1
        ]);

        //2. Act
        $achievedEC = $guest->achieved_ec;

        //3. Assert
        $this->assertEquals(10, $achievedEC);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */
    public function AchievedEcIsEqualTo0Test()
    {
        //1. Arrange
        //Roles
        Role::create(['name' => 'admin',]);
        $teacher = Role::create(['name' => 'teacher',]);
        $guestrole = Role::create(['name' => 'guest',]);
        //Blocks
        for ($i = 0; $i < 12; $i++) {
            Block::create();
        }
        $guest = factory(User::class)->create();
        $guest->roles()->attach($guestrole);
        $teachers = factory(User::class, 10)->create()->each(function ($user) use ($teacher) {
            $user->roles()->attach($teacher);
        });
        factory(Module::class, 10)->create([
            'overseer' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'taught_by' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'followed_by' => $guest->id,
            'is_finished' => 0,
            'study_points' => 1
        ]);

        //2. Act
        $achievedEC = $guest->achieved_ec;

        //3. Assert
        $this->assertEquals(0, $achievedEC);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */

    public function ProgressIsEqualTo100Test()
    {
        //1. Arrange
        //Roles
        Role::create(['name' => 'admin',]);
        $teacher = Role::create(['name' => 'teacher',]);
        $guestrole = Role::create(['name' => 'guest',]);
        //Blocks
        for ($i = 0; $i < 12; $i++) {
            Block::create();
        }
        $guest = factory(User::class)->create();
        $guest->roles()->attach($guestrole);
        $teachers = factory(User::class, 10)->create()->each(function ($user) use ($teacher) {
            $user->roles()->attach($teacher);
        });
        factory(Module::class, 10)->create([
            'overseer' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'taught_by' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'followed_by' => $guest->id,
            'is_finished' => 1,
            'study_points' => 1
        ]);

        //2. Act
        $progress = $guest->progress_percentage;

        //3. Assert
        $this->assertEquals('onehundredpercent', $progress);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * @test
     */

    public function ProgressIsEqualTo90Test()
    {
        //1. Arrange
        //Roles
        Role::create(['name' => 'admin',]);
        $teacher = Role::create(['name' => 'teacher',]);
        $guestrole = Role::create(['name' => 'guest',]);
        //Blocks
        for ($i = 0; $i < 12; $i++) {
            Block::create();
        }
        $guest = factory(User::class)->create();
        $guest->roles()->attach($guestrole);
        $teachers = factory(User::class, 10)->create()->each(function ($user) use ($teacher) {
            $user->roles()->attach($teacher);
        });
        factory(Module::class, 9)->create([
            'overseer' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'taught_by' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'followed_by' => $guest->id,
            'is_finished' => 1,
            'study_points' => 1
        ]);

        factory(Module::class)->create([
            'overseer' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'taught_by' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'followed_by' => $guest->id,
            'is_finished' => 0,
            'study_points' => 1
        ]);

        //2. Act
        $progress = $guest->progress_percentage;

        //3. Assert
        $this->assertEquals('ninetypercent', $progress);
    }
}
