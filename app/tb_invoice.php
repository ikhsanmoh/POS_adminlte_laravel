<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_invoice extends Model
{
    protected $primaryKey = 'id_invoice';
    public $incrementing = false;
    public $keyType = "string";
    protected $table ="tb_invoice";
    protected $fillable = ["id_invoice", "id_user", "id_customer", 'total', 'tunai', 'kembali'];
}
