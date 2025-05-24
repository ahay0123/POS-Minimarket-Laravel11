<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    protected $primaryKey = 'id_order';
    protected $fillable = ['invoice', 'customer_id', 'id_user', 'total', 'tanggal_transaksi'];

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'id_order', 'id_order');
    }
}
