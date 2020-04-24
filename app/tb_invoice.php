<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_invoice extends Model
{
    protected $primaryKey = 'id_invoice';
    public $incrementing = false;
    // public $keyType = "int";
    protected $table ="tb_invoice";
    protected $fillable = ["id_invoice", "id_user", "id_customer", 'id_suplier', 'total', 'tunai', 'kembali'];
}
