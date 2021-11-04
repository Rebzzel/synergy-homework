<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonSeeder extends Seeder
{
    protected $lessons = [
        'Веб-разработка ',
        'Веб-дизайн',
        'Интернет-маркетинг',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->lessons as $lesson) {
            DB::table('lessons')->insert([
                'name' => $lesson,
            ]);
        }
    }
}
