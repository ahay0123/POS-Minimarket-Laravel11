<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public $primaryKey = 'id_product';
    protected $table = 'products';
    protected $fillable = ['id_product', 'nama_produk', 'description', 'stock', 'price','id_categories', 'foto'];

    public function categories()
    {
        return $this->hasOne('\App\Models\Category', 'id_categories', 'id_categories');
    }
}
