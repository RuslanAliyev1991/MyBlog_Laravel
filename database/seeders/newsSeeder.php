<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;

class newsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.";

        for ($i = 1; $i < 5; $i++) {
            DB::table('news')->insert(
                [
                    'category_id' => rand(1, 4),
                    'title' => 'title' . $i,
                    'slug' => Str::slug('title' . $i),
                    'news_content' => $content,
                    'image' => 'image' . $i,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}