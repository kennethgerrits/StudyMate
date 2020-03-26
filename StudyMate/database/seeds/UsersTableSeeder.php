<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('role_user')->delete();

        $adminRole = Role::where('name', 'admin')->first();
        $teacherRole = Role::where('name', 'teacher')->first();
        $guestRole = Role::where('name', 'guest')->first();

        $admin = User::create([
            'name' => 'Admin user',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);

        $overseer = User::create([
            'name' => 'Stefan :(',
            'email' => 'stefan@avans.nl',
            'password' => Hash::make('password')
        ]);

        $teacher = User::create([
            'name' => 'Rik Meijer',
            'email' => 'teacher@teacher.com',
            'password' => Hash::make('password')
        ]);

        $guest = User::create([
            'name' => 'Niels Smits',
            'email' => 'niels@smits.nl',
            'password' => Hash::make('password')
        ]);

        $teacher2 = User::create([
            'name' => 'Eric Kuijpers',
            'email' => 'Eric@kuijpers.com',
            'password' => Hash::make('password')
        ]);

        $teacher3 = User::create([
            'name' => 'Jasper van Rosmalen',
            'email' => 'jasper@vanrosmalen.com',
            'password' => Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $overseer->roles()->attach($teacherRole);
        $teacher->roles()->attach($teacherRole);
        $guest->roles()->attach($guestRole);
        $teacher2->roles()->attach($teacherRole);
        $teacher3->roles()->attach($teacherRole);
    }
}
