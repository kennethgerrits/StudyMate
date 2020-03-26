<?php

namespace Tests\Unit;

use App\Block;
use App\Module;
use App\Period;
use App\Role;
use App\RoleUser;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTests extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        //1. Arrange
        //Roles
        Role::create(['name' => 'admin',]);
        $teacher = Role::create(['name' => 'teacher',]);
        $guestrole = Role::create(['name' => 'guest',]);
        //Blocks
        for ($i = 0; $i<12;$i++){
            Block::create();
        }
        //Periods
        for ($i = 0; $i<4;$i++){
            Period::create();
        }
        $guest = factory(User::class)->create();
        $guest->roles()->attach($guestrole);
        $teachers = factory(User::class, 10)->create()->each(function ($user) use ($teacher){
            $user->roles()->attach($teacher);
        });
        factory(Module::class, 10)->create([
            'overseer' => $teachers[random_int(0, $teachers->count()-1)]->id,
            'taught_by' => $teachers[random_int(0, $teachers->count()-1)]->id,
            'followed_by' => $guest->id,
            'is_finished' => 1,
            'study_points' => 1
        ]);

        //2. Act
        $maxEC = $guest->max_ec;

        //3. Assert
        $this->assertEquals($maxEC, 10);
    }
}
