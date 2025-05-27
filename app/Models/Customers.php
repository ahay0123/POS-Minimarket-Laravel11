<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    //
    public $primaryKey = 'customer_id';
    protected $table = 'customers';
    protected $fillable = ['customer_id','nama',  'alamat', 'tanggal_daftar', 'poin', 'status','no_hp'];

}
