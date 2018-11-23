<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pro_id','type', 'file_path'
    ];

    public function products()
    {
        return $this->belongsTo('App\Product');
    }
}
