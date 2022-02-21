<?php

use Illuminate\Database\Seeder;

class DirectorssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_directors')->insert([
            ['firstName' => 'Christopher Edward','lastName' => 'Nolan','birthDate' => '30-06-1970','nationality' => 'Britanica'],
            ['firstName' => 'George','lastName' => 'Gilligan','birthDate' => '10-02-1967','nationality' => 'Americano'],
            ['firstName' => 'Daniel','lastName' => 'Brett Weiss','birthDate' => '23-04-1971','nationality' => 'Americano'],
            ['firstName' => 'David','lastName' => 'Benioff','birthDate' => '25-09-1970','nationality' => 'Americano'],
            ['firstName' => 'Craig','lastName' => 'Mazin','birthDate' => '08-04-1971','nationality' => 'Americano'],
            ['firstName' => 'Michael','lastName' => 'Hirst','birthDate' => '21-09-1952','nationality' => 'Británico'],
            ['firstName' => 'Matt','lastName' => 'Groenig','birthDate' => '15-02-1954','nationality' => 'Americano'],
            ['firstName' => 'Juie','lastName' => 'Plec','birthDate' => '26-05-1972','nationality' => 'Americano']
        ]);
    }
}
