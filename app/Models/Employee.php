<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];
    public function user()
    {
        # code...
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
