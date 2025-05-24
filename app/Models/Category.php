<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $primaryKey = 'id_categories';
    protected $table = 'categories';
    protected $fillable = ['id_categories', 'nama_categories', 'description'];

    public function product()
    {
        return $this->hasMany(Product::class, 'id_categories');
    }
}
