<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_invoice_detail extends Model
{
    protected $primaryKey = 'id';
    protected $table ="tb_invoice_detail";
    protected $fillable = ["id", "id_invoice", "id_barang", "qty"];
    public $timestamps = false;
}
