<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title','slug','summary','parent_id','status','image','added_by'];

    public function category_products(){
        return $this->hasMany('App\Models\Product','cat_id','id')->where('status','active');
    }

    public function sub_category_products(){
        return $this->hasMany('App\Models\Product','sub_cat_id','id')->where('status','active');
    }

    public function created_by(){
        return $this->hasOne('App\User','id','added_by');
    }
    public function parent_info(){
        return $this->hasOne('App\Models\Category','id','parent_id');
    }
    public function child_cats(){
        return $this->hasMany('App\Models\Category','parent_id','id')->where('status','active')->orderBy('title','ASC');
    }

    public function getSlug($str){
        $slug = \Str::slug($str);
        if ($this->where('slug',$slug)->count() > 0){
            $slug .= date("Ymdhis").rand(0,9999);
        }
        return $slug;
    }
    public function getRules(){
        $rules = [
            'title' => 'required|string',
            'summary' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'image' => 'sometimes|image|max:5120',
        ];
        return $rules;
    }

}
