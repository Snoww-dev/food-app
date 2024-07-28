<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class FoodType extends Model
{

    //table name
    protected $table = 'food_types';

    public function getList(){
        return $this->get();
    }
}
