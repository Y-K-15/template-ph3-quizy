<?php

use Illuminate\Database\Seeder;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
// この二つ追加

class BigQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
                // https://www.earthlink.co.jp/engineerblog/technology-engineerblog/2680/
                DB::table('big_questions')->truncate();

                // https://qiita.com/hitochan/items/91ec5245bcb9bae9184c
                $now = CarbonImmutable::now();
        
                $params = [
                    [
                        'name' => '東京の難読地名クイズ',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                    [
                        'name' => '広島の難読地名クイズ',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ],
                ];
        
                DB::table('big_questions')->insert($params);
    }
}
