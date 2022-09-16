<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorSize extends Model
{
    protected $fillable = ['color_id', 'name', 'quantity'];
}
