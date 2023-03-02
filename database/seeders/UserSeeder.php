<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Phone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Mauricio',
            'last_name' => 'Arana',
            'ci' => '4568789',
            'departament_id' => 4,
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);

        Phone::create([
            'phone' => '77584546',
            'phoneable_id' => $user->id,
            'phoneable_type' => User::class,
        ]);

        Phone::create([
            'phone' => '98745658',
            'phoneable_id' => $user->id,
            'phoneable_type' => User::class,
        ]);
    }
}
