<?php

namespace Tests\Browser;

use App\Block;
use App\Module;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DashboardTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     * @test
     */
    public function ProgressbarFiftyPercentTest()
    {

        //Roles
        Role::create(['name' => 'admin',]);
        $teacher = Role::create(['name' => 'teacher',]);
        $guestrole = Role::create(['name' => 'guest',]);
        //Blocks
        for ($i = 0; $i < 12; $i++) {
            Block::create();
        }
        //Periods
        $guest = factory(User::class)->create();
        $guest->roles()->attach($guestrole);
        $teachers = factory(User::class, 10)->create()->each(function ($user) use ($teacher) {
            $user->roles()->attach($teacher);
        });
        factory(Module::class, 5)->create([
            'overseer' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'taught_by' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'followed_by' => $guest->id,
            'is_finished' => 1,
            'study_points' => 1
        ]);
        factory(Module::class, 5)->create([
            'overseer' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'taught_by' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'followed_by' => $guest->id,
            'is_finished' => 0,
            'study_points' => 1
        ]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/dashboard')
                ->screenshot('progress-bar')
                ->assertPresent('.fiftypercent');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     * @test
     */

    public function Block1EmptyTest()
    {

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
        $this->browse(function (Browser $browser) {
            $browser->visit('/dashboard')
                ->screenshot('no-modules-dashboard')
                ->assertPresent('.nullpercent')
                ->click('@periodbtn1')
                ->click('@blockbtn1')
                ->screenshot('block1page')
                ->assertSee('We are sorry to tell you that there are currently no courses available for this block!');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     * @test
     */

    public function Block1AccomplishedTest()
    {

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
        factory(Module::class, 1)->create([
            'name' => 'DB1',
            'overseer' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'taught_by' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'followed_by' => $guest->id,
            'is_finished' => 1,
            'study_points' => 1,
            'block_id' => 1
        ]);
        $this->browse(function (Browser $browser) {
            $browser->visit('/dashboard')
                ->assertPresent('.onehundredpercent')
                ->click('@periodbtn1')
                ->click('@blockbtn1')
                ->assertPresent('.onehundredpercent')
                ->screenshot('block1page')
                ->assertSee('DB1');
        });
    }
}
