<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

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
            'email'=> 'admin@admin.com',
            'password'=> Hash::make('password')
        ]);

        $overseer = User::create([
            'name' => 'Stefan :(',
            'email'=> 'stefan@avans.nl',
            'password'=> Hash::make('password')
        ]);

        $teacher = User::create([
            'name' => 'Teacher user',
            'email'=> 'teacher@teacher.com',
            'password'=> Hash::make('password')
        ]);

        $guest = User::create([
            'name' => 'Niels Smits',
            'email'=> 'ngasmits@avans.nl',
            'password'=> Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $overseer->roles()->attach($teacherRole);
        $teacher->roles()->attach($teacherRole);
        $guest->roles()->attach($guestRole);
    }
}
