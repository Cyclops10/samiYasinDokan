<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = ['name','desc'];

    public static function rules($id)
    {
        return [
            'name' => 'required|string|min:1|unique:elements,name,'.$id,
            'desc'=>'required|string|min:3',
            'parent_id'=>'string|nullable'
        ];
    }

    public function parent()
    {
        return $this->belongsTo('App\Element', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Element', 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'products_elements','sub_element_id','product_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'categories_elements','element_id','cat_id');
    }
}
