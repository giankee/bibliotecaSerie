<?php

use Illuminate\Database\Seeder;

class ActorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_actors')->insert([
            ['firstName' => 'Bryan Lee','lastName' => 'Cranston','birthDate' => '07-03-1956','nationality' => 'Americano'],
            ['firstName' => 'Aaron Paul','lastName' => 'Sturtevant','birthDate' => '27-08-1979','nationality' => 'Americano'],
            ['firstName' => 'Anna','lastName' => 'Gunn','birthDate' => '11-05-1968','nationality' => 'Americano'],
            ['firstName' => 'Peter','lastName' => 'Hayden Dinklage','birthDate' => '11-06-1969','nationality' => 'Americano'],
            ['firstName' => 'Christopher','lastName' => 'Catesby Harington','birthDate' => '26-12-1986','nationality' => 'Británico'],
            ['firstName' => 'Emilia','lastName' => 'Clarke','birthDate' => '23-10-1986','nationality' => 'Británico']
        ]);
    }
}
