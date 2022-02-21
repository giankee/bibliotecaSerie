<?php

use Illuminate\Database\Seeder;

class SeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_series')->insert([
            ['title' => 'Breaking Bad','synopsis' => 'ejemplo','platformId' => 1,'directorId' => 2],
            ['title' => 'Game of Thrones','synopsis' => 'ejemplo','platformId' => 3,'directorId' => 4]
        ]);
            
        DB::table('tb_series_actors')->insert([
            ['serieId' => 1,'actorId' => 1],
            ['serieId' => 1,'actorId' => 2],
            ['serieId' => 1,'actorId' => 3],
            ['serieId' => 2,'actorId' => 4],
            ['serieId' => 2,'actorId' => 5],
            ['serieId' => 2,'actorId' => 6]
        ]);
        
        
        DB::table('tb_series_languages')->insert([
            ['serieId' => 1,'languageId' => 2,'type' => 'Audio'],
            ['serieId' => 1,'languageId' => 3,'type' => 'Audio'],
            ['serieId' => 1,'languageId' => 2,'type' => 'Subtítulo'],
            ['serieId' => 1,'languageId' => 3,'type' => 'Subtítulo'],
            ['serieId' => 2,'languageId' => 2,'type' => 'Audio'],
            ['serieId' => 2,'languageId' => 3,'type' => 'Audio'],
            ['serieId' => 2,'languageId' => 2,'type' => 'Subtítulo'],
            ['serieId' => 2,'languageId' => 3,'type' => 'Subtítulo']
        ]);
    }
}
