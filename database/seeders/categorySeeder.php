<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class categorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Every day', 'Sports', 'Social', 'Network'];
        foreach ($categories as $category) {
            DB::table('categories')->insert(
                [
                    'name' => $category,
                    'slug' => Str::slug($category),
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}