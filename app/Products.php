<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public function categories(){
        return $this->belongsToMany('App\Categories');
    }

    public function presentAmount(){
        
        return money_format('%(#1n', $this->amount / 10);
    }
}
