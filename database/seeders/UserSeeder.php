<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    protected $firstNames = [
        'Александр',
        'Иван',
        'Данииил',
        'Артём',
    ];

    protected $lastNames = [
        'Иванов',
        'Петров',
        'Волков',
        'Соколов',
        'Кузнецов',
    ];

    protected $middleNames = [
        'Алексеевич',
        'Сергеевич',
        'Иванович',
        'Петрович',
        'Александрович',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'email'            => Str::random().'@'.Str::random(5).'.com',
                'password'         => Hash::make('root'),
                'first_name'       => $this->firstNames[array_rand($this->firstNames)],
                'last_name'        => $this->lastNames[array_rand($this->lastNames)],
                'middle_name'      => $this->middleNames[array_rand($this->middleNames)],
                'birthday_at'      => now(),
                'passport_id'      => random_int(1000, 99999).' '.random_int(10000, 999999),
                'passport_given_by'=> 'Хогвартс',
            ]);
        }
    }
}