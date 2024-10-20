<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::create([
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('123456'),
        ]);

        User::create([
            'name'=>'user',
            'email'=>'user@user.com',
            'password'=>Hash::make('123456'),
        ]);
    }
}
