<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as FakerFactory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        $faker = FakerFactory::create(); // Generate a new instance of Faker

        User::create([
            'name' => 'John Doe',
            'email' => $faker->unique()->safeEmail,
            'password' => Hash::make('password'),
        ])->assignRole('user');

   
        $faker = FakerFactory::create(); // Generate a new instance of Faker

        User::create([
            'name' => 'John Doe2',
            'email' => $faker->unique()->safeEmail,
            'password' => Hash::make('password'),
        ])->assignRole('admin');
    }
}
