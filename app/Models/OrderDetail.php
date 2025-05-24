<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
    protected $table = 'order_detail';
    protected $primaryKey = 'id_order_detail';
    public $timestamps = false;

    protected $fillable = ['id_order', 'id_product', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'id_order', 'id_order');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }   
}
