<?php

use Database\Seeders\LessonAndHomeworkSeeder;
use Database\Seeders\LessonSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            LessonSeeder::class,
        ]);
    }
}
