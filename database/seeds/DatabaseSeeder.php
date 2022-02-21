<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PlatformsSeeder::class,
            ActorsSeeder::class,
            DirectorssSeeder::class,
            LanguagesSeeder::class,
            SeriesSeeder::class,
            UserSeeder::class
        ]);
    }
}
