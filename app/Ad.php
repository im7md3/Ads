<?php

namespace App;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $guarded=['id'];
    public function images(){
        return $this->hasMany(Image::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function currency(){
        return $this->belongsTo(Currency::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class)->where('parent_id',null);
    }

    public function setSlugAttribute($value){
        $slug=slug($value);
        $uniqueSlug=uniqueSlug($slug,'ads');
        $this->attributes['slug']=$uniqueSlug;
    }

    public function favorites(){
        return $this->belongsToMany(User::class,'favorites')->withPivot(['ad_id','user_id']);
    }
    
    public function scopeFilter($query,Request $request){
        if($request->country){
            $query->where('country_id',$request->country);
        }
        if($request->category){
            $query->where('category_id',$request->category);
        }
        if($request->keyword){
            $query->where('title','like','%'.$request->keyword.'%');
        }
        return $query->with('images')->get();
    }

    
}
