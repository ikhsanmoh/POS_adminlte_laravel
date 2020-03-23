<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_produk extends Model
{
    protected $primaryKey = 'id_barang';
    protected $table ="tb_produk";
    protected $fillable = ["id_barang", "nama_barang", "harga_satuan", 'stok'];
}
