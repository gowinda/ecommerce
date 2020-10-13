<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function getRules(){
        return [
            'title' => 'required|string',
            'image' => 'sometimes|image|max:5120',
            'summary' => 'required|string',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',

        ];
    }
    public function user_info(){
        return $this->hasOne('App\User','id','updated_by');
    }
    protected $fillable = ['title','slug','summary','description','status','image','updated_by'];
}
