<?php

namespace Database\Seeders;

use App\Models\Income;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fine1 = Income::create([
            'concept' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.', 
            'details' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic nulla velit magnam. Ad dicta voluptatibus repellat quos, aliquid aspernatur unde rem omnis facere possimus adipisci quis. Commodi illum natus quo.',
            'value' => 400,
            'date' => now(),
            'type' => 1,
            'user_id' => 1,
        ]);

        $fine1->property_fine()->attach([1]);

        $fine2 = Income::create([
            'concept' => ' Facilis, nisi! Facere quam suscipit.',
            'details' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus blanditiis eum cum hic omnis aspernatur incidunt est ullam, eius magni commodi. Qui consectetur quos exercitationem eligendi quo fugit voluptatum minus!',
            'value' => 350,
            'date' => now(),
            'type' => 1,
            'user_id' => 1,
        ]);

        $fine2->property_fine()->attach([1]);
        
        $cuota_extraordinaria1 = Income::create([
            'concept' => 'nostrum fugit error molestiae nesciunt .',
            'details' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque quos itaque quibusdam error expedita debitis, ex quis ipsam! Impedit libero mollitia ipsa sed exercitationem voluptas vero temporibus molestias expedita similique?.',
            'value' => 400,
            'date' => now()->subMonth(2),
            'type' => 2,
            'user_id' => 1,
        ]);

        $cuota_extraordinaria1->property_fine()->attach([2]);

        $expense1 = Income::create([
            'concept' => 'accusantium, libero similique cupiditate eum provident? .',
            'details' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum fugiat at harum molestias tempora non illum beatae id voluptatem officia in aperiam omnis dolores voluptate, soluta perferendis, cum rem perspiciatis!.',
            'value' => 500,
            'date' => now(),
            'type' => 3,
            'user_id' => 1,
        ]);

        $expense1->property_expense()->attach([2 => ['paid_up_to' => now()->subMonth(4), 'names' => 'Nombre prueba']]);

        $expense2 = Income::create([ 
            'concept' => 'Laborum esse ex dolores officia totam.',
            'details' => 'Lipsum dolor sit amet consectetur adipisicing elit. Neque beatae blanditiis accusamus tempore dolores suscipit doloribus quos sunt. Eligendi ipsam dicta asperiores est at laboriosam autem voluptatum molestias, earum impedit!.',
            'value' => 400,
            'date' => now()->subMonth(1),
            'type' => 3,
            'user_id' => 1,
        ]);

        $expense2->property_expense()->attach([2 => ['paid_up_to' => now()->subMonth(2), 'names' => 'Nombre prueba']]);

        $expense3 = Income::create([ 
            'concept' => 'Hic nulla velit magnam.',
            'details' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio consequuntur sit sed eum iste dicta est, nesciunt, earum explicabo sapiente accusantium vero tenetur. Atque incidunt nam voluptas dolores voluptatibus perferendis.',
            'value' => 400,
            'date' => now(),
            'type' => 3,
            'user_id' => 1,
        ]);

        $expense3->property_expense()->attach([2 => ['paid_up_to' => now()->subMonth(1), 'names' => 'Nombre prueba']]);

        $expense4 = Income::create([ 
            'concept' => 'Ad dicta voluptatibus repellat quos.',
            'details' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis tempora repudiandae repellat aut minus quidem laboriosam blanditiis quia minima quae debitis similique, porro adipisci iste animi velit laborum quod provident.',
            'value' => 400,
            'date' => now(),
            'type' => 3,
            'user_id' => 1,
        ]);

        $expense4->property_expense()->attach([3 => ['paid_up_to' => now()->subMonth(4), 'names' => 'Nombre prueba']]);

        $expense5 = Income::create([ 
            'concept' => 'Commodi illum natus.',
            'details' => 'Hic  ipsum dolor sit amet consectetur adipisicing elit. Odit, iste harum facilis, perspiciatis amet aliquid voluptates ex dignissimos nemo laboriosam nisi nulla fuga repellat exercitationem? Dolorum hic odio optio inventore.',
            'value' => 400,
            'date' => now(),
            'type' => 3,
            'user_id' => 1,
        ]);

        $expense5->property_expense()->attach([4 => ['paid_up_to' => now()->subMonth(1), 'names' => 'Nombre prueba']]);

        $expense6 = Income::create([
            'concept' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit.',
            'details' => 'Voluptatem exercitationem ipsum quam aliquid molestiae asperiores enim possimus adipisci. Optio quidem reprehenderit eveniet mollitia, molestias temporibus ut eos necessitatibus quas ullam.',
            'value' => 400,
            'date' => now(),
            'type' => 3,
            'user_id' => 1,
        ]);

        $expense6->property_expense()->attach([5 => ['paid_up_to' => now()->subMonth(1), 'names' => 'Nombre prueba']]);
    }
}
