<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(DepartamentSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AnnouncementSeeder::class);
        $this->call(PropertySeeder::class);
        $this->call(FineSeeder::class);
        $this->call(ExtraordinaryFeeSeeder::class);
        $this->call(ExpenseSeeder::class);
        $this->call(IncomeSeeder::class);
    }
}
