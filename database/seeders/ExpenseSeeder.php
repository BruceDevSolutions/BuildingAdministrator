<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expense::create([
            'concept' => 'Pofficia beatae quos aliquid soluta a laborum culpa!',
            'details' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam labore voluptatibus facilis, eos enim ab laudantium atque eaque, quia delectus impedit repellendus? Saepe voluptatum nemo dignissimos dolorem nulla sint accusamus.',
            'date' => now(),
            'value' => 500,
            'user_id' => 1
        ]);
       
        Expense::create([
            'concept' => 'Pest mollitia doloribus tempore ab ipsam, quibusdam, adipisci nemo!',
            'details' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam labore voluptatibus facilis, eos enim ab laudantium atque eaque, quia delectus impedit repellendus? Saepe voluptatum nemo dignissimos dolorem nulla sint accusamus.',
            'date' => now(),
            'value' => 500,
            'user_id' => 1
        ]);

        Expense::create([
            'concept' => 'Nam aliquid in error unde libero vel id dicta minima praesentium quia corrupti',
            'details' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam labore voluptatibus facilis, eos enim ab laudantium atque eaque, quia delectus impedit repellendus? Saepe voluptatum nemo dignissimos dolorem nulla sint accusamus.',
            'date' => now()->subMonth(3),
            'value' => 1000,
            'user_id' => 1
        ]);

        Expense::create([
            'concept' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.  !',
            'details' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam labore voluptatibus facilis, eos enim ab laudantium atque eaque, quia delectus impedit repellendus? Saepe voluptatum nemo dignissimos dolorem nulla sint accusamus.',
            'date' => now()->subMonth(2),
            'value' => 500,
            'user_id' => 1
        ]);
        
        Expense::create([
            'concept' => 'sapiente labore, qui maiores,',
            'details' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam labore voluptatibus facilis, eos enim ab laudantium atque eaque, quia delectus impedit repellendus? Saepe voluptatum nemo dignissimos dolorem nulla sint accusamus.',
            'date' => now(),
            'value' => 500,
            'user_id' => 1
        ]);

        Expense::create([
            'concept' => 'Eligendi, officiis nobis!',
            'details' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam labore voluptatibus facilis, eos enim ab laudantium atque eaque, quia delectus impedit repellendus? Saepe voluptatum nemo dignissimos dolorem nulla sint accusamus.',
            'date' => now(),
            'value' => 500,
            'user_id' => 1
        ]);

        Expense::create([
            'concept' => 'expedita provident earum itaque quod aperiam. ',
            'details' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam labore voluptatibus facilis, eos enim ab laudantium atque eaque, quia delectus impedit repellendus? Saepe voluptatum nemo dignissimos dolorem nulla sint accusamus.',
            'date' => now(),
            'value' => 500,
            'user_id' => 1
        ]);
    }
}
