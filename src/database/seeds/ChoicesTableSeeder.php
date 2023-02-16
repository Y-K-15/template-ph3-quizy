<?php

use Illuminate\Database\Seeder;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
// この二つ追加

class ChoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('choices')->truncate();
        $now = CarbonImmutable::now();

        $params = [
            [
                'question_id' => 1,
                'name' => 'たかなわ',
                'is_valid' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 1,
                'name' => 'たかわ',
                'is_valid' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 1,
                'name' => 'こうわ',
                'is_valid' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 2,
                'name' => 'かめと',
                'is_valid' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 2,
                'name' => 'かめど',
                'is_valid' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 2,
                'name' => 'かめいど',
                'is_valid' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 3,
                'name' => 'むこうひら',
                'is_valid' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 3,
                'name' => 'むきひら',
                'is_valid' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_id' => 3,
                'name' => 'むかいなだ',
                'is_valid' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('choices')->insert($params);
    }
}
