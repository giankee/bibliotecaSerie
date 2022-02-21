<?php

use Illuminate\Database\Seeder;

class PlatformsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_platforms')->insert([
            ['name' => 'Netflix'],
            ['name' => 'Amazon Prime'],
            ['name' => 'Filmin'],
            ['name' => 'Disney+'],
            ['name' => 'MOVISTAR+']
        ]);
    }
}
