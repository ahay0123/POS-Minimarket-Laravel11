<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    //
    public $primaryKey = 'customer_id';
    protected $table = 'customers';
    protected $fillable = ['customer_id', 'nama', 'no_hp', 'alamat', 'tanggal_daftar', 'poin', 'status'];

}
