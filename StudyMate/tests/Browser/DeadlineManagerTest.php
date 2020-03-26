<?php

namespace Tests\Browser;

use App\Role;
use App\User;
use Facebook\WebDriver\WebDriverBy;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeadlineManagerTest extends DuskTestCase
{
    /**
     * Admin can delete user.
     *
     * @test
     */
    public function tbdTest()
    {
        Role::create(['name' => 'admin',]);
        Role::create(['name' => 'teacher',]);
        $guestRole = Role::create(['name' => 'guest',]);

        $guest = factory(\App\User::class)->create();
        $guest->roles()->attach($guestRole);

        $this->browse(function ($browser) {

            $browser->visit('/login')
                ->loginAs(User::find(1))
                ->assertAuthenticated()
                ->visit('/deadlines')
                ->screenshot('deadlinepage');

            $elements = $browser->visit('/deadlines')
                ->elements('.table tr');

            foreach ($elements as $element) {
                $subElements = collect($element->findElements(WebDriverBy::xpath('*')));

                if ($subElements->slice(1, 1)->first()->getText() === 'iets') {

                }
            }
        });
    }
}
