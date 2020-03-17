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
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $teacherRole = Role::where('name', 'teacher')->first();
        $studentRole = Role::where('name', 'student')->first();

        $admin = User::create([
            'name' => 'Admin user',
            'email'=> 'admin@admin.com',
            'password'=> Hash::make('password')
        ]);

        $teacher = User::create([
            'name' => 'Teacher user',
            'email'=> 'teacher@teacher.com',
            'password'=> Hash::make('password')
        ]);

        $student = User::create([
            'name' => 'Student user',
            'email'=> 'student@student.com',
            'password'=> Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $teacher->roles()->attach($teacherRole);
        $student->roles()->attach($studentRole);




    }
}
