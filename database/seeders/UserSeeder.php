<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\data;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        data::factory()->count(20)->create();
        // DB::table('sample')->insert([
        //   'title'=>'phone',
        //   'description'=>'cart',
        //   'create_by_id'=>'500',
        //   'updated_by_id'=>'600',
        //   'created_at'=> \Carbon\Carbon::now(),
        //   'updated_at'=>\Carbon\Carbon::now()

        //]);
    }
}
