<?php

namespace Tests\Browser;

use App\Block;
use App\Exam;
use App\ExamType;
use App\Module;
use App\Period;
use App\Role;
use App\Tag;
use App\User;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeadlineManagerTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Admin can delete user.
     *
     * @test
     */
    public function tbdTest()
    {
        //Roles, User, Module, Block and Period
        //Roles
        Role::create(['name' => 'admin',]);
        $teacher = Role::create(['name' => 'teacher',]);
        $guestrole = Role::create(['name' => 'guest',]);

        //Blocks
        for ($i = 0; $i < 12; $i++) {
            Block::create();
        }
        //Periods
        for ($i = 0; $i < 4; $i++) {
            Period::create();
        }
        $guest = factory(User::class)->create();
        $guest->roles()->attach($guestrole);

        $teachers = factory(User::class, 10)->create()->each(function ($user) use ($teacher) {
            $user->roles()->attach($teacher);
        });

        factory(Module::class, 10)->create([
            'overseer' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'taught_by' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'followed_by' => User::find(1)->id,
            'is_finished' => 0,
            'study_points' => 1
        ]);

        //Tags
        $fun = Tag::create(['tag' => 'fun']);
        $boring = Tag::create(['tag' => 'boring']);
        $timeconsuming = Tag::create(['tag' => 'timeconsuming']);

        //Examtypes
        //To use ID's just call ExamType::EXAM etc.
        ExamType::create(['type' => 'exam']);
        ExamType::create(['type' => 'assessment']);
        ExamType::create(['type' => 'assignment']);

        factory(Exam::class, 10)->create([
            //If you want to set a specific type or module, do it here
            //By nature these ID's will be randomnized
            'examtype_id' => ExamType::ASSIGNMENT,
            'module_id' => 1
        ])->each(function ($exam) use ($fun, $boring, $timeconsuming) {
            //Just an example, by nature it won't have any tag
            //$exam->tags()->attach($fun);
        });

        $this->browse(function ($browser) {

            $browser->visit('/login')
                ->loginAs(User::find(1))
                ->assertAuthenticated()
                ->visit('/deadlines')
                ->screenshot('deadlinepage');

//            $elements = $browser->visit('/deadlines')
//                ->elements('.table tr');
//
//            foreach ($elements as $element) {
//                $subElements = collect($element->findElements(WebDriverBy::xpath('*')));
//
//                if ($subElements->slice(1, 1)->first()->getText() === 'iets') {
//
//                }
//            }
        });
    }

    protected function PakAanDieData()
    {
        //Roles, User, Module, Block and Period
        //Roles
        Role::create(['name' => 'admin',]);
        $teacher = Role::create(['name' => 'teacher',]);
        $guestrole = Role::create(['name' => 'guest',]);
        //Blocks
        for ($i = 0; $i < 12; $i++) {
            Block::create();
        }
        //Periods
        for ($i = 0; $i < 4; $i++) {
            Period::create();
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
        //Tags
        $fun = Tag::create(['tag' => 'fun']);
        $boring = Tag::create(['tag' => 'boring']);
        $timeconsuming = Tag::create(['tag' => 'timeconsuming']);
        //Examtypes
        //To use ID's just call ExamType::EXAM etc.
        ExamType::create(['type' => 'exam']);
        ExamType::create(['type' => 'assessment']);
        ExamType::create(['type' => 'assignment']);

        factory(Exam::class, 10)->create([
            //If you want to set a specific type or module, do it here
            //By nature these ID's will be randomnized
            'examtype_id' => ExamType::ASSIGNMENT,
//            'module_id' => themoduleidyouwant
        ])->each(function ($exam) use ($fun, $boring, $timeconsuming) {
            //Just an example, by nature it won't have any tag
            $exam->tags()->attach($fun);
        });


    }
}
