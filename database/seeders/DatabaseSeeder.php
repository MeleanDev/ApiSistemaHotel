<?php

namespace Database\Seeders;

use App\Models\MesCantidade;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = [
            array('mes' => 'Ene', 'cantidad' => 0),
            array('mes' => 'Feb', 'cantidad' => 0),
            array('mes' => 'Mar', 'cantidad' => 0),
            array('mes' => 'Abr', 'cantidad' => 0),
            array('mes' => 'May', 'cantidad' => 0),
            array('mes' => 'Jun', 'cantidad' => 0),
            array('mes' => 'Jul', 'cantidad' => 0),
            array('mes' => 'Ago', 'cantidad' => 0),
            array('mes' => 'Sep', 'cantidad' => 0),
            array('mes' => 'Oct', 'cantidad' => 0),
            array('mes' => 'Nov', 'cantidad' => 0),
            array('mes' => 'Dic', 'cantidad' => 0),
        ];
        MesCantidade::insert($data);
    }
}
