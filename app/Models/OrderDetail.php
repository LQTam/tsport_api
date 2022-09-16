<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $guarded = [];
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function color1()
    {
        return $this->belongsTo('App\Models\Color', 'color', 'name');
    }
}
