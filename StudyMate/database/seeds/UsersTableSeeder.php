<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\Module;

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
        $studentRole = Role::where('name', 'student')->first();

        $db1Module = Module::where('name', 'DB1')->first();

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
        $teacher->modules()->attach($db1Module);
        $student->roles()->attach($studentRole);

    }
}
