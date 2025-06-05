<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    //
    public $primaryKey = 'id_customers';
    protected $table = 'customers';
    protected $fillable = ['id_customers','nama',  'alamat', 'tanggal_daftar', 'poin', 'status','no_hp'];

}
