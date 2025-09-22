<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            'title' => 'Judul Pertama', 'content' => 'Ini adalah isi dari konten pertama.',
            'title' => 'Judul Kedua', 'content' => 'Ini adalah isi dari konten kedua.',
        ]);
    }
}
