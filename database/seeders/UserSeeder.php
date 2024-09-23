<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
           'name'=> 'Admin User',
           'email'=> 'admin@gmail.com',
           'username'=> 'admin7',
           'role'=> User::ADMIN,
           'password'=> Hash::make('password'),
        ]);
        User::create([
           'name'=> 'Student1 User ',
           'email'=> 'student1@gmail.com',
           'username'=> 'student1',
           'role'=> User::STUDENT,
           'password'=> Hash::make('password'),
        ]);
        User::create([
           'name'=> 'Student2 User',
           'email'=> 'student2@gmail.com',
           'username'=> 'student2',
           'role'=> User::STUDENT,
           'password'=> Hash::make('password'),
        ]);
        User::create([
           'name'=> 'Personnel1 User',
           'email'=> 'personnel1@gmail.com',
           'username'=> 'personnel1',
           'role'=> User::PERSONNEL,
           'password'=> Hash::make('password'),
        ]);

        User::create([
            'name'=> 'Personnel2 User',
            'email'=> 'personnel2@gmail.com',
            'username'=> 'personnel2',
            'role'=> User::PERSONNEL,
            'password'=> Hash::make('password'),
         ]);

        User::create([
            'name'=> 'Staff1 User',
            'email'=> 'staff1@gmail.com',
            'username'=> 'staff1',
            'role'=> User::STAFF,
            'password'=> Hash::make('password'),
         ]);

        User::create([
            'name'=> 'Staff2 User',
            'email'=> 'staff2@gmail.com',
            'username'=> 'staff2',
            'role'=> User::STAFF,
            'password'=> Hash::make('password'),
         ]);

    }
}
