<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         //Comment::factory()->count(20)->create();
        DB::table('data')->insert([
            'title'=>'phone',
            'description'=>'cart',
            'create_by_id'=>'1200',
            'updated_by_id'=>'100',
            'created_at'=> \Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }

}
