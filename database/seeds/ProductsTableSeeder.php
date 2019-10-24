<?php

use Illuminate\Database\Seeder;
use App\Products;
class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1;$i<=10;$i++) {
            Products::create([
                'name'=>"Product1".$i,
                'slug'=>"product1".$i,
                'amount'=>rand(50,300),
                'description'=>"This is the ".$i." product of bathroum category".Str::random(20),
                'details'=>"This is the ".$i." product of bathroum category"
            ])->categories()->attach(1);
        }
        

        for ($i=1;$i<=11;$i++) {
            Products::create([
                'name'=>"Product2".$i,
                'slug'=>"product2".$i,
                'amount'=>rand(50,300),
                'description'=>"This is the ".$i." product of kitchen category".Str::random(20),
                'details'=>"This is the ".$i." product of kitchen category"
            ])->categories()->attach(2);
        }

        for ($i=1;$i<=11;$i++) {
            Products::create([
                'name'=>"Product3".$i,
                'slug'=>"product3".$i,
                'amount'=>rand(50,300),
                'description'=>"This is the ".$i." product of makeup category".Str::random(20),
                'details'=>"This is the ".$i." product of makeup category"
            ])->categories()->attach(3);
        }


        
    }
}
