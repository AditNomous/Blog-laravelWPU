<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Agama',
            'slug' => 'agama',
            'color' => 'red'
        ]);
        
        Category::create([
            'name' => 'Sosial Budaya',
            'slug' => 'sosial-budaya',
            'color' => 'yellow'
        ]);
        
        Category::create([
            'name' => 'Politic',
            'slug' => 'politic',
            'color' => 'blue'
        ]);
    }
}
