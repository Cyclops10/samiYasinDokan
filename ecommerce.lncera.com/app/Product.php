<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'desc'
    ];

    public static function rules()
    {
        return [
            'name' => 'required|string|min:5',
            'desc'=>'required|string|min:50',
            'price'=>'required|string',
            'available'=>'required|string',
            'images'=>'required'
        ];
    }


    public function elements()
    {
        return $this->belongsToMany('App\Element', 'products_elements', 'product_id' ,'sub_element_id');
    }

    public function images()
    {
        return $this->belongsToMany('App\Images', 'products_images', 'prod_id' ,'id');
    }

    public function categories()
    {
        return $this->belongsTo('App\Category', 'cat_id', 'id');
    }
}
