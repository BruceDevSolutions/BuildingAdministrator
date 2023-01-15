<?php

namespace Database\Seeders;

use App\Models\Departament;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departament::create([
            'name' => 'Beni'
        ]);

        Departament::create([
            'name' => 'Chuquisaca'
        ]);

        Departament::create([
            'name' => 'Cochabamba'
        ]);

        Departament::create([
            'name' => 'La Paz'
        ]);

        Departament::create([
            'name' => 'Oruro'
        ]);

        Departament::create([
            'name' => 'Pando'
        ]);

        Departament::create([
            'name' => 'Potosí'
        ]);

        Departament::create([
            'name' => 'Santa Cruz'
        ]);

        Departament::create([
            'name' => 'Tarija'
        ]);
    }
}
