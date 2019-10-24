<?php

use Illuminate\Database\Seeder;
use App\Categories;
use Carbon\carbon;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now=Carbon::now()->toDateTimeString();
        Categories::insert([
            ['name'=>'Bathroom','slug'=>'bathroom','created_at'=>$now,'updated_at'=>$now],
            ['name'=>'Kitchen','slug'=>'kitchen','created_at'=>$now,'updated_at'=>$now],
            ['name'=>'Makeup','slug'=>'makeup','created_at'=>$now,'updated_at'=>$now]
        ]);
    }
}
