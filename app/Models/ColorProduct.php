<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorProduct extends Model
{
    protected $fillable = ['name', 'product_id'];
    public function sizes()
    {
        return $this->hasMany('App\Models\ColorSize', 'color_id', 'id');
    }
    public function pictures()
    {
        return $this->hasMany('App\Models\ColorProductPicture', 'color_id', 'id');
    }
}
