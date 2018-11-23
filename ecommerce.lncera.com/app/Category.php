<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    /*public static $rules = array(
                                    'name' => 'required|string|min:3|unique:categories,name',
                                    'desc'=>'required|string|min:3',
                                    'parent_id'=>'string|nullable'
                                );*/

    public static function rules($id)
    {
        return [
            'name' => 'required|string|min:3|unique:categories,name,'.$id,
            'desc'=>'required|string|min:3',
            'parent_id'=>'string|nullable'
        ];
    }

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function elements()
    {
        return $this->belongsToMany('App\Element', 'categories_elements','cat_id','element_id');
    }

    public function products()
    {
        return $this->hasMany('App\Product', 'cat_id');
    }
}
