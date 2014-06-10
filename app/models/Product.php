<?php

class Product extends \Eloquent {
	
	protected $table = 'products';
	
	protected $fillable = [
		'name','slug','description','price','promo_price','discount','image','sizes','colors','relateds','published','featured'
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
    

    public function setPriceAttribute($price)
    {
       
        $this->attributes['price'] = (number($price) == "") ? 0 : number($price);
       

    }
    public function setPromoPriceAttribute($promo_price)
    {
       
        $this->attributes['promo_price'] = (number($promo_price) == "") ? 0 : number($promo_price);
       

    }
    public function setSizesAttribute($sizes)
    {
       
        //dd(json_encode($sizes));
        $this->attributes['sizes'] = json_encode($sizes);
       

    }
     public function getSizesAttribute()
    {
       
      
       return json_decode($this->attributes['sizes']);
       

    }

    public function setColorsAttribute($sizes)
    {
       
        //dd(json_encode($sizes));
        $this->attributes['colors'] = json_encode($sizes);
       

    }
     public function getColorsAttribute()
    {
       
      
       return json_decode($this->attributes['colors']);
       

    }

     public function setRelatedsAttribute($relateds)
    {
       
        //dd(json_encode($sizes));
        $this->attributes['relateds'] = json_encode($relateds);
       

    }
     public function getRelatedsAttribute()
    {
       
      
       return json_decode($this->attributes['relateds']);
       

    }

}