<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatutsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(FormationsTableSeeder::class);
	$this->call(UnitesEnseignementsTableSeeder::class);
	$this->call(PhotosTableSeeder::class);	
    }
}
