<?php

namespace Database\Seeders;

use App\Models\ExtraordinaryFee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExtraordinaryFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $extraordinaryFee = ExtraordinaryFee::create([
            'concept' => 'Pago para el pintado del edificio',
            'details' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam labore voluptatibus facilis, eos enim ab laudantium atque eaque, quia delectus impedit repellendus? Saepe voluptatum nemo dignissimos dolorem nulla sint accusamus.',
            'date' => now(),
            'value' => 500,
            'user_id' => 1
        ]);

        $extraordinaryFee->properties()->attach([1 => ['status' => true],2 => ['status' => false],3 => ['status' => true],4 => ['status' => false],5 => ['status' => true],6 => ['status' => true]]);

        $extraordinaryFee2 = ExtraordinaryFee::create([
            'concept' => 'Cuota para mantenimiento al ascensor',
            'details' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam labore voluptatibus facilis, eos enim ab laudantium atque eaque, quia delectus impedit repellendus? Saepe voluptatum nemo dignissimos dolorem nulla sint accusamus.',
            'date' => now(),
            'value' => 500,
            'status' => true,
            'user_id' => 1
        ]);

        $extraordinaryFee2->properties()->attach([2 => ['status' => true], 4 => ['status' => true],6 => ['status' => true], 8 => ['status' => false], 3 => ['status' => false]]);

        $extraordinaryFee3 = ExtraordinaryFee::create([
            'concept' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit',
            'details' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusantium molestiae officiis, culpa perferendis similique quam, perspiciatis minima debitis voluptatibus corrupti veritatis cum at voluptatum libero reiciendis. Cumque aspernatur tenetur ratione?.',
            'date' => now()->subMonth(3),
            'value' => 500,
            'user_id' => 1
        ]);

        $extraordinaryFee3->properties()->attach([1 => ['status' => false],3 => ['status' => false],5 => ['status' => true],7 => ['status' => false], 9 => ['status' => false], 12 => ['status' => true]]);
        
    }
}
