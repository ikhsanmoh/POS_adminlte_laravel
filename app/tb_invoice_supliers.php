<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_invoice_supliers extends Model
{
    protected $fillable = ["id_invoice", "id_barang", "harga_beli", "qty"];
    public $timestamps = false;
}
