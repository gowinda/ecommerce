<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id','product_id','user_id','quantity','price','after_discount','total_amount','delivery_charge'];
}
