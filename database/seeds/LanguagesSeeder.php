<?php

use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_languages')->insert([
            ['name' => 'Alemán','isoCode' => 'de'],
            ['name' => 'Inglés','isoCode' => 'en'],
            ['name' => 'Español','isoCode' => 'es'],
            ['name' => 'Francés','isoCode' => 'fr'],
            ['name' => 'Italiano','isoCode' => 'it'],
            ['name' => 'Portugués','isoCode' => 'pt']
        ]);  
    }
}