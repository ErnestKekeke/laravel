<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Post;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Simple example: create one user
        Post::create([
            'author' => 'Alice',
            'title' => 'My First Post',
            'body' => 'This is the content of the post.',
        ]);

        
        // Create multiple posts using Faker
        $faker = Faker::create(); // create Faker instance once

        for($i = 0; $i < 10; $i++){
            Post::create([
                'author' => $faker->name,
                'title' => $faker->sentence(6), // random title
                'body' => $faker->paragraph(3), // random body
            ]);
        }
        
    }
}
