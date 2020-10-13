<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getSlug($str){
        $slug = \Str::slug($str);
        if ($this->where('slug',$slug)->count() > 0){
            $slug .= date("Ymdhis").rand(0,9999);
        }
        return $slug;
    }

    public function cat_info(){
        return $this->hasOne('App\Models\Category','id','cat_id');
    }
    public function sub_cat_info(){
        return $this->hasOne('App\Models\Category','id','sub_cat_id');
    }
    public function seller_info(){
        return $this->hasOne('App\User','id','seller_id');
    }

    public function reviews(){
        return $this->hasMany('App\Models\ProductReview','product_id','id')->where('status','active')->with('reviewed_by');
    }

    public function related(){
        return $this->hasMany('App\Models\Product','cat_id','cat_id')->where('status','active')->with('images')->orderBy('id','DESC')->limit('8');
    }

    public function images(){
        return $this->hasMany('App\Models\ProductImage','product_id','id');
    }
    protected $fillable = ['title','slug','summary','detail','cat_id','sub_cat_id','price','discount','brand','is_featured','status','seller_id','added_by'];
   public function getRules(){
        $rules = array(
            'title' => 'required|string',
            'detail' => 'nullable|string',
            'summary' => 'required|string',
            'price' => 'required|numeric|min:100',
            'discount' => 'nullable|numeric|min:0|max:70',
            'cat_id' => 'required|exists:categories,id',
            'sub_cat_id' => 'nullable|exists:categories,id',
            'brand' => 'nullable|string',
            'is_featured' => 'sometimes|in:1',
            'seller_id' => 'nullable|exists:users,id',
            'image.*' => 'sometimes|image|max:5120',
            'status' => 'required|in:active,inactive'
        );
        return $rules;
   }
}
