<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('TypesSeeder');
        $this->call('AuthorsSeeder');
        $this->call('CategoryColorsSeeder');
        $this->call('TagColorsSeeder');
    }
}
