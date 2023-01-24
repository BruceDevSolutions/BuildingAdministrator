<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Property::create([
            'code' => '1A',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi impedit eligendi, laboriosam pariatur officiis suscipit expedita voluptate atque cupiditate incidunt amet voluptatum. Quos, quasi commodi. Ducimus nihil sapiente quisquam alias.',
            'monthly_rate' => 400.00,
            'area' => 130.00,
            'property_type' => 1,
        ]);

        Property::create([
            'code' => '1B',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi impedit eligendi, laboriosam pariatur officiis suscipit expedita voluptate atque cupiditate incidunt amet voluptatum. Quos, quasi commodi. Ducimus nihil sapiente quisquam alias.',
            'monthly_rate' => 400.00,
            'area' => 98.00,
            'property_type' => 1,
        ]);

        Property::create([
            'code' => '1C',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi impedit eligendi, laboriosam pariatur officiis suscipit expedita voluptate atque cupiditate incidunt amet voluptatum. Quos, quasi commodi. Ducimus nihil sapiente quisquam alias.',
            'monthly_rate' => 400.00,
            'area' => 130.00,
            'property_type' => 1,
        ]);

        Property::create([
            'code' => '2A',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi impedit eligendi, laboriosam pariatur officiis suscipit expedita voluptate atque cupiditate incidunt amet voluptatum. Quos, quasi commodi. Ducimus nihil sapiente quisquam alias.',
            'monthly_rate' => 400.00,
            'property_type' => 1,
        ]);

        Property::create([
            'code' => '2B',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi impedit eligendi, laboriosam pariatur officiis suscipit expedita voluptate atque cupiditate incidunt amet voluptatum. Quos, quasi commodi. Ducimus nihil sapiente quisquam alias.',
            'monthly_rate' => 400.00,
            'property_type' => 1,
        ]);

        Property::create([
            'code' => '2C',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi impedit eligendi, laboriosam pariatur officiis suscipit expedita voluptate atque cupiditate incidunt amet voluptatum. Quos, quasi commodi. Ducimus nihil sapiente quisquam alias.',
            'monthly_rate' => 400.00,
            'property_type' => 1,
        ]);

        Property::create([
            'code' => '2A',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi impedit eligendi, laboriosam pariatur officiis suscipit expedita voluptate atque cupiditate incidunt amet voluptatum. Quos, quasi commodi. Ducimus nihil sapiente quisquam alias.',
            'monthly_rate' => 400.00,
            'property_type' => 1,
        ]);

        Property::create([
            'code' => '3B',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi impedit eligendi, laboriosam pariatur officiis suscipit expedita voluptate atque cupiditate incidunt amet voluptatum. Quos, quasi commodi. Ducimus nihil sapiente quisquam alias.',
            'monthly_rate' => 400.00,
            'property_type' => 1,
        ]);

        Property::create([
            'code' => '3C',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi impedit eligendi, laboriosam pariatur officiis suscipit expedita voluptate atque cupiditate incidunt amet voluptatum. Quos, quasi commodi. Ducimus nihil sapiente quisquam alias.',
            'monthly_rate' => 400.00,
            'property_type' => 1,
        ]);
        
        Property::create([
            'code' => 'LC1',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi impedit eligendi, laboriosam pariatur officiis suscipit expedita voluptate atque cupiditate incidunt amet voluptatum. Quos, quasi commodi. Ducimus nihil sapiente quisquam alias.',
            'monthly_rate' => 500.00,
            'property_type' => 2,
        ]);
        
        Property::create([
            'code' => 'LC2',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi impedit eligendi, laboriosam pariatur officiis suscipit expedita voluptate atque cupiditate incidunt amet voluptatum. Quos, quasi commodi. Ducimus nihil sapiente quisquam alias.',
            'monthly_rate' => 500.00,
            'area' => 80.00,
            'property_type' => 2,
        ]);
        
        Property::create([
            'code' => 'LC3',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi impedit eligendi, laboriosam pariatur officiis suscipit expedita voluptate atque cupiditate incidunt amet voluptatum. Quos, quasi commodi. Ducimus nihil sapiente quisquam alias.',
            'monthly_rate' => 500.00,
            'area' => 68.00,
            'property_type' => 2,
        ]);
    }
}
