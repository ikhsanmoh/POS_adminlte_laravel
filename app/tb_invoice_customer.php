<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_invoice_customer extends Model
{
    protected $primaryKey = 'id';
    protected $table ="tb_invoice_customer";
    protected $fillable = ["id_invoice", "id_barang", "qty"];
    public $timestamps = false;
}
