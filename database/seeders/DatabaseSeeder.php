<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Enquete;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'id' => '1',
            'voornaam' => 'test',
            'achternaam' => 'employee',
            'email' => 'employee@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$RsBNBcttqcBqJvcbdSv3jOlq6NN.Ly3JD7OR52gOyilAKdWXHWkJO',
            'is_employee' => '1',
            'remember_token' => Str::random(10)
        ]);
        User::create([
            'id' => '2',
            'voornaam' => 'test',
            'achternaam' => 'customer',
            'email' => 'customer@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$RsBNBcttqcBqJvcbdSv3jOlq6NN.Ly3JD7OR52gOyilAKdWXHWkJO',
            'is_employee' => '0',
            'remember_token' => Str::random(10)
        ]);

        Category::create([
            'id' => '1',
            'name' => 'IT'
        ]);

        Category::create([
            'id' => '2',
            'name' => 'Gezondheid'
        ]);
        Category::create([
            'id' => '3',
            'name' => 'Voeding'
        ]);
        Enquete::create([
            'id' => '1',
            'title' => 'Provinciale verkiezen enquete',
            'category_id' => '2'
        ]);
        Enquete::create([
            'id' => '2',
            'title' => 'Relaties tussen moslima en ethiest',
            'category_id' => '1'
        ]);
        Enquete::create([
            'id' => '3',
            'title' => 'Ramadan',
            'category_id' => '3'
        ]);
    }
}
