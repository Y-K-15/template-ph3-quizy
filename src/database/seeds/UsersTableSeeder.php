<?php

use Illuminate\Database\Seeder;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// この三つ追加

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->truncate();
        $now = CarbonImmutable::now();

        $params = [
            [
                'name' => 'KentoYokoyama',
                'email' => 'kento@kuizy.com',
                'password' => Hash::make('kento'),
                // 'password' => 'kento',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'ちいかわ',
                'email' => 'chikawa@kuizy.com',
                'password' => Hash::make('chikawa'),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'ミッキーマウス',
                'email' => 'mickey@kuizy.com',
                'password' => Hash::make('mickey'),
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ];

        DB::table('users')->insert($params);
        

    }
}
