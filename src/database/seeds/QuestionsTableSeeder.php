<?php

use Illuminate\Database\Seeder;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
// この二つ追加

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('questions')->truncate();
        $now = CarbonImmutable::now();

        $params =[
            [
                'big_question_id' => 1,
                'image' => 'takanawa.png',
                'sort' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'big_question_id' => 1,
                'sort' => 1,
                'image' => 'kameido.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'big_question_id' => 2,
                'sort' => 1,
                'image' => 'mukainada.png',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('questions')->insert($params);
        
    }
}
