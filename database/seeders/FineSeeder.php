<?php

namespace Database\Seeders;

use App\Models\Fine;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fine::create([
            'concept' => 'Daño a áreas públicas',
            'details' => 'El copropietario dañó la puerta de ingreso al edificio por descuido',
            'value' => 500.00,
            'status' => 0,
            'date' => now(),
            'user_id' => 1,
            'property_id' => 1,
        ]);

        Fine::create([
            'concept' => 'Daño a áreas públicas II',
            'details' => 'El copropietario dañó la puerta de ingreso al edificio por descuido',
            'value' => 200.00,
            'status' => 0,
            'date' => now(),
            'user_id' => 1,
            'property_id' => 1,
        ]);

        Fine::create([
            'concept' => 'Daño a áreas públicas III',
            'details' => 'El copropietario dañó la puerta de ingreso al edificio por descuido',
            'value' => 500.00,
            'status' => 0,
            'date' => now(),
            'user_id' => 1,
            'property_id' => 1,
        ]);

        Fine::create([
            'concept' => 'Inasistencia a reunión',
            'details' => 'El copropietario no asistió a la reunión de copropietarios con penalidad de multa',
            'value' => 250.00,
            'status' => 0,
            'date' => now()->subMonth(2),
            'user_id' => 1,
            'property_id' => 2,
        ]);

        Fine::create([
            'concept' => 'Inasistencia a reunión II',
            'details' => 'El II copropietario no asistió a la reunión de copropietarios con penalidad de multa',
            'value' => 250.00,
            'status' => 1,
            'date' => now(),
            'user_id' => 1,
            'property_id' => 3,
        ]);
    }
}
