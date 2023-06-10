<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function scopeNameSearch($query,$name){
        if(!empty($name)){
            $query->where('name','like','%'.$name.'%');
        }
    }

    public function scopeAreaSearch($query,$area){
        if(!empty($area)){
            $query->where('area',$area);
        }
    }

    public function scopeCategorySearch($query,$category){
        if(!empty($category)){
            $query->where('category',$category);
        }
    }

    public function reserves(){
        return $this->hasMany(Reserve::class);
    }
}
