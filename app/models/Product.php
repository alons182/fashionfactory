<?php

class Product extends \Eloquent {
	
	protected $table = 'products';
	
	protected $fillable = [
		'name','slug','description','price','image','published','featured'
	];

	 public function scopeSearch($query, $search)
    {
        return $query->where(function($query) use ($search)
        {
             $query->where('name', 'like', '%'.$search.'%')
                   ->orWhere('description', 'like', '%'.$search.'%');
        });
    }
    public function scopeSearchSlug($query, $search)
    {
        return $query->where(function($query) use ($search)
        {
             $query->where('slug', '=', $search)
                   ->where('published', '=', 1);
        });
    }
     public function scopeFeatured($query)
    {
        return $query->where(function($query)
        {
             $query->where('featured', '=', 1)
                    ->where('published', '=', 1);
        });
    }

	 public function categories()
    {
        return $this->belongsToMany('Category');
    }

     public function photos()
    {
        return $this->hasMany('Photo');
    }
}