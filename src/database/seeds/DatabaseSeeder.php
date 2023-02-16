<?php

use Illuminate\Database\Seeder;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;
// この二つ追加

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BigQuestionsTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(ChoicesTableSeeder::class);
    }
}
