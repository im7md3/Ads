<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps=false;
    protected $guarded = [];  

    public function ads(){
        return $this->hasMany(Ad::class);
    }

    public function setSlugAttribute($value){
        $slug=slug($value);
        $uniqueSlug=uniqueSlug($slug,'categories');
        $this->attributes['slug']=$uniqueSlug;
    }
}
