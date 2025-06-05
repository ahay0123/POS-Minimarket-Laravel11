<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $primaryKey = 'id_order';
    protected $fillable = ['invoice', 'customer_id', 'id_user', 'total', 'tanggal_transaksi','no_hp','paid_amount', 'return_amount'];


    public function users()
    {
        return $this->hasOne(User::class, 'id_user', 'id_user');
    }

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'no_hp', 'no_hp');
    }
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'id_order', 'id_order');
    }
}
