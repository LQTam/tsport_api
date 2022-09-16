<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    protected $guarded = [];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'madh';
    }

    public function detail()
    {
        # code...
        return $this->hasMany('App\Models\OrderDetail');
    }
    public function customer()
    {
        # code...
        return $this->hasOne('App\Models\Customer', 'user_id', 'user_id');
    }
    public function payment()
    {
        # code...
        return $this->hasOne('App\Models\Payment', 'id', 'payment_id');
    }
}
