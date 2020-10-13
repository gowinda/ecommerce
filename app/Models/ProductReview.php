<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    public function reviewed_by(){
        return $this->hasOne('App\User','id','user_id')->with('user_info');
    }
    protected $fillable =['user_id','product_id','rate','review','status'];
}
