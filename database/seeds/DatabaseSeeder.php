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
        $this->call(PhotosTableSeeder::class);
        $this->call(UnitesEnseignementsTableSeeder::class);
        $this->call(Responsable_unitee_enseignementsTableSeeder::class);
        $this->call(Enseignant_dans_u_esTableSeeder::class);
    }
}
