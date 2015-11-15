<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'year',
        'title',
        'description',
        'price',
        'availability',
        'image'
    ];

    // public static $rules = [
    //     'category_id' => 'required|integer',
    //     'title'       => 'required|min:3',
    //     'description' => 'required|min:20',
    //     'price'       => 'required',
    //     'availability' => 'integer',
    //     'image'       => 'required|image|mimes:jpeg,jpg,bmp,png,gif'
    // ];

    public function category()
    {
        return $this->belongsTo('App\Category');
        //$category = \App\Category::find($this->category_id);
        //return $category->name;
    }

    // each product belongs to an author
    public function user()
    {
        return $this->belongsTo('\App\User');
        //$category = \App\Category::find($this->category_id);
        //return $category->name;
    }

    public function categoryName()
    {
        $category = \App\Category::find($this->category_id);
        return $category->name;
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    // get a list of tag ids associated with the current product
    // ->tagList or ->tag_list
    public function getTagListAttribute()
    {
        return $this->tags->lists('id');
    }
}
