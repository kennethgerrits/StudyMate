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
use Carbon\Carbon;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeadlineManagerTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * The user can mark the 'finished' checkbox, save the table which would result into removing the finalized checkboxes.
     *
     * @test
     */
    public function UserCanFinalizeTest()
    {
        $teacherRole = Role::create(['name' => 'teacher',]);
        $guestRole = Role::create(['name' => 'guest',]);

        for ($i = 0; $i < 12; $i++) {
            Block::create();
        }
        for ($i = 0; $i < 4; $i++) {
            Period::create();
        }

        $guest = factory(User::class)->create();
        $guest->roles()->attach($guestRole);

        $teachers = factory(User::class, 1)->create()->each(function ($user) use ($teacherRole) {
            $user->roles()->attach($teacherRole);
        });

        factory(Module::class, 1)->create([
            'overseer' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'taught_by' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'followed_by' => User::find(1)->id,
        ]);

        $fun = Tag::create(['tag' => 'fun']);

        ExamType::create(['type' => 'exam']);
        ExamType::create(['type' => 'assessment']);
        ExamType::create(['type' => 'assignment']);

        factory(Exam::class, 1)->create([
            'examtype_id' => ExamType::ASSIGNMENT,
            'is_finished' => false,
        ])->each(function ($exam) use ($fun) {
            $exam->tags()->attach($fun);
        });

        $this->browse(function ($browser) use ($guest) {
            $browser
                ->loginAs($guest)
                ->assertAuthenticated()
                ->visit('/deadlines')
                ->assertSee('fun')
                ->assertSee('1')
                ->click('@finalizeExamBtn')
                ->click('@saveDeadlineChangesBtn')
                ->assertDontSee('fun')
                ->assertDontSee('1');
        });
    }

    /**
     * The user can add multiple tags to an exam.
     *
     * @test
     */
    public function UserCanAddTagsTest()
    {
        $teacher = Role::create(['name' => 'teacher',]);
        $guestRole = Role::create(['name' => 'guest',]);

        for ($i = 0; $i < 12; $i++) {
            Block::create();
        }
        for ($i = 0; $i < 4; $i++) {
            Period::create();
        }

        $guest = factory(User::class)->create();
        $guest->roles()->attach($guestRole);

        $teachers = factory(User::class, 1)->create()->each(function ($user) use ($teacher) {
            $user->roles()->attach($teacher);
        });

        factory(Module::class, 1)->create([
            'overseer' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'taught_by' => $teachers[random_int(0, $teachers->count() - 1)]->id,
            'followed_by' => User::find(1)->id,
        ]);

        Tag::create(['tag' => 'fun']);
        Tag::create(['tag' => 'boring']);
        Tag::create(['tag' => 'timeconsuming']);

        ExamType::create(['type' => 'exam']);
        ExamType::create(['type' => 'assessment']);
        ExamType::create(['type' => 'assignment']);

        factory(Exam::class, 1)->create([
            'examtype_id' => ExamType::ASSIGNMENT,
            'is_finished' => false,
        ]);

        $this->browse(function ($browser) use ($guest) {
            $browser
                ->loginAs($guest)
                ->assertAuthenticated()
                ->visit('/deadlines')
                ->select('@tagsdropdown', '[1,1]')
                ->assertSee('fun')
                ->click('@saveDeadlineChangesBtn')
                ->assertSee('fun')
                ->select('@tagsdropdown', '[1,2]')
                ->assertSee('boring')
                ->click('@saveDeadlineChangesBtn')
                ->assertSee('fun')
                ->assertSee('boring');
        });
    }

    /**
     * A teacher cannot manages deadlines.
     *
     * @test
     */
    public function TeacherCantManageDeadlinesTest()
    {
        $teacherRole = Role::create(['name' => 'teacher',]);

        $teacher = factory(\App\User::class)->create();
        $teacher->roles()->attach($teacherRole);

        $this->browse(function ($browser) {
            $browser
                ->loginAs(User::find(1))
                ->assertAuthenticated()
                ->visit('/deadlines')
                ->assertSee('403')
                ->assertSee('This action is unauthorized.');
        });
    }
}
