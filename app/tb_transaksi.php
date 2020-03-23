<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// this line is defined so soft delete feature can be used
use Illuminate\Database\Eloquent\SoftDeletes;

class tb_transaksi extends Model
{

    // call it once more so we can use it in our model class
    use SoftDeletes;

    protected $primaryKey = 'id_transaksi';
    protected $table ="tb_transaksi";
    protected $fillable = ["id_transaksi", "nama_barang", "harga_satuan", 'jml_barang', 'total_harga'];
    protected $dates =  ['deleted_at'];

    //Digunakan untuk men-disable spesifik column pada model/table agar tidak bisa di create & edit. biarkan kosong untuk aktifkan semua column
    // protected $guarded = [];

    //Digunakan untuk Men-disable autofill updated_at & created_at column pada model/table
    // public $timestamps = false;
}
