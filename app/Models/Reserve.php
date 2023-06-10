<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reserve extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id','shop_id','date','time','hc','delete_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }
}
