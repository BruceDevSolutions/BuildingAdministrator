<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'building_name' => 'BuildingAdministrator',
            'welcome_message' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nulla tempora similique quisquam magnam fugiat sint ullam voluptatum, laudantium tenetur asperiores necessitatibus, deserunt maiores. Similique nemo saepe modi fugiat libero iste!'
        ]);
    }
}
