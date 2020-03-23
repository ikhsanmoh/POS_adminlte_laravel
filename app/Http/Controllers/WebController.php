<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Dipanggil agar kita dapat menggunakan "Query Builder" pada laravel
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\tb_transaksi;
use App\tb_produk;
use App\tb_invoice;
use App\tb_invoice_detail;
use Gate;
use Auth;
use PDF;
use Illuminate\Support\Str;

class WebController extends Controller
{
    //-------------------------------- Reuse Code --------------------------------------

    public function get_tb_kategori_data() {
        return $data_kategori = DB::table('tb_kategori')->get();
    }

    //------------------------------ URL Protection -----------------------------------

    public function __construct(){
        $this->middleware('auth');
    }

    //------------------------------- PAGE LOGIN --------------------------------------

    // public function login(){
    //     return view('pages.login');
    // }

    // // public function proses_login(Request $req){
    // //     $usrnm = $req->username;
    // //     $pass = $req->password;

    // //     if (Auth::attempt(['username' => $usrnm, 'password' => $pass])) {
    // //         return 'Halooo';
    // //     } else {
    // //         return 'Gagall';
    // //     }
    // // }

    // public function forgotPass(){
    //     return view('pages.forgotpass');
    // }

    //------------------------------- PAGE DASHBOARD --------------------------------------

    public function dashboard(){

        // $data = tb_transaksi::all();
        // $dt = $data->only(['total_harga']);
        // $dt->all();

        // $dt = DB::table('tb_transaksi')
        //         ->select(DB::raw('monthname(updated_at), total_harga'))
        //         ->whereMonth('updated_at', $month)
        //         ->get();

        // $total_pemasukan = $dt->sum('total_harga');

        /* 
        jumlahkan total pemasukan penjualan barang group by date(bulan update)
        *
        */

        // Visitor Counter
        function counter(){	
            $filename = 'counter.txt';

            if(file_exists($filename)){		
                $value = file_get_contents($filename);	
            }else{		
                $value = 0;		
            }
        
            file_put_contents($filename, ++$value);
            
            return $filename;
        }

        $hasil = counter();	
        $hitung_pengunjung = file_get_contents($hasil);

        // Total Penjualan
        $get_jml_barang = tb_transaksi::select('jml_barang')->get();

        $hitung_total_barang = $get_jml_barang->sum('jml_barang');

        // Total Masukan
        $get_total_harga = tb_transaksi::select('total_harga')->get();

        $hitung_total_masukan = $get_total_harga->sum('total_harga');

        // Line Chart - Masukan Bulanan
        $month = 1;
        $total_pemasukan = collect([]);

        $dtloop = DB::table('tb_transaksi')
            ->select(DB::raw('monthname(updated_at)'))
            ->distinct()
            ->get();
        $dtloop2 = $dtloop->count('updated_at');

        while ($month <= $dtloop2) {
            
            $dt = DB::table('tb_transaksi')
                ->select(DB::raw('monthname(updated_at), total_harga'))
                ->whereMonth('updated_at', $month)
                ->get();


            $dt2 = DB::table('tb_transaksi')
                ->select(DB::raw('monthname(updated_at)'))
                ->whereMonth('updated_at', $month)
                ->limit(1)
                ->get();

            $nm_bulan = $dt2->get('updated_at');
            $jml_pemasukan = $dt->sum('total_harga');

            $total_pemasukan->put($nm_bulan, $jml_pemasukan);         
            $month++;
        }

        //Pie Chart - Kategori Terlaris
        $get_transaksi = tb_transaksi::join('tb_produk', 'tb_transaksi.id_barang', '=', 'tb_produk.id_barang')
                            ->join('link_kategori','tb_produk.id_barang', '=', 'link_kategori.id_barang')
                            ->join('tb_kategori', 'link_kategori.id_kat', '=', 'tb_kategori.id_kat')
                            ->select(DB::raw('tb_kategori.nama_kat, COUNT(tb_kategori.nama_kat) as kat_terlaris'))
                            ->groupBy('tb_kategori.nama_kat')
                            ->get();

        //Daftar Produk Terbaru
        $get_produk = tb_produk::select('id_barang', 'nama_barang', 'stok', 'created_at')
                    // ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();

        $sort_produk = $get_produk->sortByDesc('created_at')->all();

        return view('pages.dashboard.dashboard', [
            'total' => $total_pemasukan, 
            'jml_visitor' => $hitung_pengunjung, 
            'total_jual' => $hitung_total_barang, 
            'total_masukan' => $hitung_total_masukan,
            'produk_terbaru' => $sort_produk,
            'jml_sales' => $get_transaksi]);
    }

    //------------------------------- PAGE USERS --------------------------------------

    // // Fungsi untuk menampilkan data users dari database
    // public function users(){

    //     // mengirim data pegawai ke view index
    //     // $dataUsr = DB::table('users')
    //     //     ->Join('users_bio', 'users.id', '=', 'users_bio.id')
    //     //     ->where('users.id', $id)
    //     //     ->get();

    //     // $dataUsr0 = DB::table('users')
    //     //     ->where('users.id', 1 )
    //     //     ->get();
    //     // $a = $dataUsr0->nama_lengkap;
    //     // $a = "Mohamad Ikhsan";

    //     // $dtUsrBaru = DB::table('users')->insert([
    //     //     'nama_lengkap' => $a
    //     // ]);

    //     // Mengambil data dari database (Query Builder)
    //     $dataUsr = DB::table('users')
    //         ->get();

    //     // Mengoper data ke page daftar user
    //     return view('pages.users', ['usersData'=>$dataUsr]);
    // }


    // // Fungsi untuk memasukan data user baru ke database
    // public function proses_tambah_users(Request $reqs){

    //     //setting value of 0 & 1 data
    //     if ($reqs->jk == 0) {
    //         $jk = "Laki-laki";
    //     } else {
    //         $jk = "Perempuan";
    //     }

    //     if ($reqs->pos == 0 ) {
    //         $pos = "Admin";
    //     } else {
    //         $pos = "Kasir";
    //     }

    //     if ($reqs->shift == 0) {
    //         $shift = "Pagi";
    //     } else {
    //         $shift = "Malam";
    //     }


    //    // Memasukan data user baru ke database
    //    $dtUsrBaru = DB::table('users')
    //         ->insert([
    //             'nama_lengkap' => $reqs->nm,
    //             'username' => $reqs->usrnm,
    //             'pass'=> $reqs->pass,
    //             'jenis_kelamin' => $jk,
    //             'alamat'=> $reqs->almt,
    //             'no_tlp'=> $reqs->notlp,
    //             'email'=> $reqs->email,
    //             'jabatan'=> $pos,
    //             'shift'=> $shift
    //         ]);

    //     // Mengarahkan kembali Route yang di tuju
    //     return redirect()->route('users');
    // }

    // //Fungsi untuk Menampilkan Data lengkap User
    // public function detail_user($id) {
    //     $dt = DB::table('users')
    //             ->where('users.id_user', $id)
    //             ->get();
    //     // ->find($id);

    //     return view('pages.detail-user', ['dataUser' => $dt]);
    // }

    // //Fungsi untuk mengambil dan mengedit data dari user yang di inginkan
    // public function edit_user($id){

    //     // Menyeleksi/men-select data user dengan id yang di inginkan
    //     $users = DB::table('users')
    //                 ->where('users.id_user', $id)
    //                 ->get();

    //     return view('pages.edit', ['usersDt'=>$users]);

    // }

    // // Fungsi untuk menyimpan data user yang sudah di edit
    // public function update(Request $req){

    //      //setting value of 0 & 1 data
    //      if ($req->jk == 0) {
    //         $jk = "Laki-laki";
    //     } else {
    //         $jk = "Perempuan";
    //     }

    //     if ($req->pos == 0 ) {
    //         $pos = "Super Admin";
    //     } else {
    //         $pos = "Admin";
    //     }

    //     if ($req->shift == 0) {
    //         $shift = "Pagi";
    //     } else {
    //         $shift = "Malam";
    //     }

    //     // Memasukan data baru user yang telah di edit dan meniban(overwrites) data lama
    //     $dtUpdate = DB::table('users')
    //         ->where('users.id_user', $req->id)
    //         ->update([
    //             'nama_lengkap'=> $req->nm,
    //             'username'=> $req->usrnm,
    //             'pass'=> $req->pass,
    //             'jenis_kelamin' => $jk,
    //             'alamat'=> $req->almt,
    //             'no_tlp'=> $req->notlp,
    //             'email'=> $req->email,
    //             'jabatan'=> $pos,
    //             'shift'=> $shift
    //         ]);
        
    //         return redirect()->route('users');
    // }

    // // Fungsi menghapus data user tertentu
    // public function delete($id){
    //     DB::table('users')
    //         ->where('id_user', $id)
    //         ->delete();

    //     return redirect()->route('users');
    // }

    //------------------------------- PAGE NEW USERS --------------------------------------

    // Fungsi untuk menampilkan data users dari database
    public function users(){

        // mengirim data pegawai ke view index
        // $dataUsr = DB::table('users')
        //     ->Join('users_bio', 'users.id', '=', 'users_bio.id')
        //     ->where('users.id', $id)
        //     ->get();

        // $dataUsr0 = DB::table('users')
        //     ->where('users.id', 1 )
        //     ->get();
        // $a = $dataUsr0->nama_lengkap;
        // $a = "Mohamad Ikhsan";

        // $dtUsrBaru = DB::table('users')->insert([
        //     'nama_lengkap' => $a
        // ]);

        // Mengambil data dari database (Query Builder)
        $dataUsr = User::all();

        // Mengoper data ke page daftar user
        return view('pages..users.users', ['usersData'=>$dataUsr]);
    }


    // Fungsi untuk memasukan data user baru ke database
    public function proses_tambah_users(Request $reqs){

        //setting value of 0 & 1 data
        // if ($reqs->jk == 0) {
        //     $jk = "Laki-laki";
        // } else {
        //     $jk = "Perempuan";
        // }

        if ($reqs->pos == 0 ) {
            // $pos = "Admin";
            $Role = Role::where('jabatan', 'Admin')->first();
        } else {
            // $pos = "Kasir";
            $Role = Role::where('jabatan', 'Kasir')->first();
        }

        // if ($reqs->shift == 0) {
        //     $shift = "Pagi";
        // } else {
        //     $shift = "Malam";
        // }


       // Memasukan data user baru ke database
       
       $admin = User::create([
           'name' => $reqs->nm,
           'email' => $reqs->email,
           'password' => Hash::make('password')
           ]);
           
        $admin->roles()->attach($Role);

    //    $dtUsrBaru = DB::table('users')
    //         ->insert([
    //             'nama_lengkap' => $reqs->nm,
    //             'username' => $reqs->usrnm,
    //             'pass'=> $reqs->pass,
    //             'jenis_kelamin' => $jk,
    //             'alamat'=> $reqs->almt,
    //             'no_tlp'=> $reqs->notlp,
    //             'email'=> $reqs->email,
    //             'jabatan'=> $pos,
    //             'shift'=> $shift
    //         ]);

        // Mengarahkan kembali Route yang di tuju
        return redirect()->route('users');
    }

    //Fungsi untuk Menampilkan Data lengkap User
    public function detail_user($id) {
        $dt = User::where('id', $id)->get();
        // $dt = DB::table('users')
        //         ->where('users.id', $id)
        //         ->get();
        // ->find($id);

        return view('pages.users.detail-user', ['dataUser' => $dt]);
    }

    //Fungsi untuk mengambil dan mengedit data dari user yang di inginkan
    public function edit_user(User $id){
        
        $roles = Role::all();
        // dd($id, $roles);
        // Menyeleksi/men-select data user dengan id yang di inginkan
        // $users = User::where('id', $id)->get();

        // $users = DB::table('users')
        //             ->where('users.id_user', $id)
        //             ->get();

        return view('pages.users.edit', [
            'usersDt'=>$id, 
            'roles'=>$roles
            ]);

    }

    // Fungsi untuk menyimpan data user yang sudah di edit
    public function update(Request $req, User $id){

         //setting value of 0 & 1 data
        //  if ($req->jk == 0) {
        //     $jk = "Laki-laki";
        // } else {
        //     $jk = "Perempuan";
        // }

        $id->roles()->sync($req->pos);
        $id->name = $req->nm;
        $id->email = $req->email;
        $id->save();

        // dd($req, $id);

        // if ($req->pos == 0 ) {
        //     // $pos = "Super Admin";
        //     $Role = Role::where('jabatan', 'Admin')->first();
        // } else {
        //     // $pos = "Admin";
        //     $Role = Role::where('jabatan', 'Kasir')->first();
        // }

        // if ($req->shift == 0) {
        //     $shift = "Pagi";
        // } else {
        //     $shift = "Malam";
        // }

        // // Memasukan data baru user yang telah di edit dan meniban(overwrites) data lama
        // $admin = User::where('id', $req->id)->update([
        //     'name' => $req->nm,
        //     'email' => $req->email
        //     ]);
            
        // $admin->roles()->attach($Role);
        // $user->roles()->sync();

        // $dtUpdate = DB::table('users')
        //     ->where('users.id_user', $req->id)
        //     ->update([
        //         'nama_lengkap'=> $req->nm,
        //         'username'=> $req->usrnm,
        //         'pass'=> $req->pass,
        //         'jenis_kelamin' => $jk,
        //         'alamat'=> $req->almt,
        //         'no_tlp'=> $req->notlp,
        //         'email'=> $req->email,
        //         'jabatan'=> $pos,
        //         'shift'=> $shift
        //     ]);
        
            return redirect()->route('users');
    }

    // Fungsi menghapus data user tertentu
    public function delete(User $id){

        $id->roles()->detach();
        $id->delete();

        // dd($id);
        // $user->roles()->detach();
        // User::where('id', $id)
        //         ->delete();

        // DB::table('users')
        //     ->where('id_user', $id)
        //     ->delete();

        return redirect()->route('users');
    }

    //------------------------------- PAGE SUPLIERS ---------------------------------


    
    // Menampilkan data Supliers dari database
    public function supliers(){

        $dt = DB::table('tb_suplier')
            ->get();

        // Mengoper data ke page Supliers
        return view('pages.supliers.supliers', ['dt'=>$dt]);
    }


    // Memasukan data Suplier baru ke database
    public function proses_tambah_suplier(Request $reqs){

       // Memasukan data Suplier baru ke database
       $dt = DB::table('tb_suplier')
            ->insert([
                'nama_suplier' => $reqs->nama_suplier,
                'alamat' => $reqs->alamat,
                'nomor_telepon'=> $reqs->nomor_telepon
            ]);

        // Mengarahkan kembali Route yang di tuju
        return redirect()->route('supliers');
    }

    //Fungsi untuk mengambil dan mengedit data dari Suplier yang di inginkan
    public function edit_suplier($id){

        // Menyeleksi/men-select data Suplier dengan id yang di inginkan
        $dt = DB::table('tb_suplier')
                    ->where('tb_suplier.id_suplier', $id)
                    ->get();

        return view('pages.supliers.suplier-edit', ['dt'=>$dt]);
    }

    // Fungsi untuk menyimpan data Suplier yang sudah di edit
    public function update_suplier(Request $req){

        // Memasukan data baru Suplier yang telah di edit dan mengganti(overwrites) data lama
        $dtUpdate = DB::table('tb_suplier')
            ->where('tb_suplier.id_suplier', $req->id)
            ->update([
                'nama_suplier'=> $req->nama_suplier,
                'alamat'=> $req->alamat,
                'nomor_telepon'=> $req->nomor_telepon
            ]);
        
            return redirect()->route('supliers');
    }

    // Fungsi menghapus data Suplier tertentu
    public function delete_suplier($id){
        DB::table('tb_suplier')
            ->where('id_suplier', $id)
            ->delete();

        return redirect()->route('supliers');
    }

    //------------------------------- PAGE CUSTOMERS ----------------------------------

    // Menampilkan data Customer dari database
    public function customers(){
        $dt = DB::table('tb_customer')
            ->where('id_customer', '!=', 0)
            ->get();

        // Mengoper data ke page Customer
        return view('pages.customers.customers', ['dt'=>$dt]);
    }


    // Memasukan data Customer baru ke database
    public function proses_tambah_customer(Request $reqs){

       // Memasukan data Customer baru ke database
       $dt = DB::table('tb_customer')
            ->insert([
                'nama_customer' => $reqs->nama_customer,
                'nomor_telepon'=> $reqs->nomor_telepon,
                'alamat' => $reqs->alamat
            ]);

        // Mengarahkan kembali Route yang di tuju
        return redirect()->route('customers');
    }

    //Fungsi untuk mengambil dan mengedit data dari Customer yang di inginkan
    public function edit_customer($id){

        // Menyeleksi/men-select data Customer dengan id yang di inginkan
        $dt = DB::table('tb_customer')
                    ->where('id_customer', $id)
                    ->get();

        return view('pages.customers.customer-edit', ['dt'=>$dt]);
    }

    // Fungsi untuk menyimpan data Customer yang sudah di edit
    public function update_customer(Request $req){

        // Memasukan data baru Customer yang telah di edit dan mengganti(overwrites) data lama
        $dtUpdate = DB::table('tb_customer')
            ->where('id_customer', $req->id)
            ->update([
                'nama_customer'=> $req->nama_customer,
                'nomor_telepon'=> $req->nomor_telepon,
                'alamat'=> $req->alamat
            ]);
        
            return redirect()->route('customers');
    }

    // Fungsi menghapus data Customer tertentu
    public function delete_customer($id){
        DB::table('tb_customer')
            ->where('id_customer', $id)
            ->delete();

        return redirect()->route('customers');
    }


    //------------------------------- PAGE ITEMS --------------------------------------

    public function product() {

        $dtProduk = DB::table('tb_produk')->paginate(5);
        // $dtProdukAll = DB::table('tb_produk')->get();
        $dtProdukAll = DB::table('tb_produk')
                            ->join('link_kategori', 'tb_produk.id_barang', '=', 'link_kategori.id_barang')
                            ->join('tb_kategori','link_kategori.id_kat', '=', 'tb_kategori.id_kat')
                            ->select('tb_produk.id_barang', 'tb_produk.nama_barang', 'tb_kategori.nama_kat', 'tb_produk.harga_satuan', 'tb_produk.stok')
                            ->get();
        // $data_kategori = DB::table('tb_kategori')->get();
        
        return view('pages.products.product', ['dataProduk' => $dtProduk, 'dataProdukAll' => $dtProdukAll, 'dt_kat' => $this->get_tb_kategori_data()]);
    }

    //Tambah Produk
    public function produk_tambah(Request $req) {
        DB::table('tb_produk')
            ->insert([
                'nama_barang' => $req->nama_barang,
                'harga_satuan' => $req->harga,
                'stok' => $req->stok
            ]);

        $id_barang_terbaru = DB::table('tb_produk')->orderBy('id_barang', 'DESC')->first();

        DB::table('link_kategori')
            ->insert([
                'id_kat' => $req->kat,
                'id_barang' => $id_barang_terbaru->id_barang
            ]);
        return redirect()->route('product');
    }

    //Edit Data Produk
    public function edit_produk($id) {
        $data_produk = DB::table('tb_produk')
        ->where('tb_produk.id_barang', $id)
        ->get();

        return view('pages.products.produk-edit', ['dt_produk' => $data_produk, 'dt_kat' => $this->get_tb_kategori_data()]);
    }

    //Update Data Produk
    public function update_produk(Request $req) {

        DB::table('tb_produk')
            ->where('tb_produk.id_barang', $req->id)
            ->update([
                'nama_barang'=> $req->nama_barang,
                'harga_satuan'=> $req->harga_barang,
                'stok'=> $req->stok
            ]);
        
        DB::table('link_kategori')
            ->where('link_kategori.id_barang', $req->id)
            ->update( ['id_kat' => $req->kat] );

        return redirect()->route('product');
    }

    //Delete Data Produk
    public function delete_produk($id){
        DB::table('tb_produk')
            ->where('id_barang', $id)
            ->delete();

        return redirect()->route('product');
    }

    public function cari(Request $req){
        $cari = $req->cari;

        $dtProduk = DB::table('tb_produk')
            ->where('nama_barang', 'like', "%".$cari."%")
            ->paginate(5);

        $dtProdukAll = DB::table('tb_produk')->get();

        return view('pages.products.product', ['dataProduk' => $dtProduk, 'dataProdukAll' => $dtProdukAll]);
    }

    //------------------------------- PAGE CATEGORY --------------------------------------

    public function kategori() {
        $dt = DB::table('tb_kategori')->get();
        
        return view('pages.products.category', ['dt' => $dt]);
    }
    
    // Tambah Kategori
    public function kategori_tambah(Request $req) {
        DB::table('tb_kategori')
            ->insert([
                'nama_kat' => $req->nama_kategori,
            ]);

        return redirect()->route('category');
    }

    //Delete Data Kategori
    public function delete_kategori($id){
        DB::table('tb_kategori')
            ->where('id_kat', $id)
            ->delete();

        return redirect()->route('category');
    }
    
    //------------------------------- PAGE TRANSACTION --------------------------------------
    
    // // public function transaction(){

    // //     // $dt = DB::table('tb_transaksi')
    // //     //     ->get();
        
    // //     $dt = tb_transaksi::all();

    // //     // $data = tb_produk::select('id_barang', 'nama_barang', 'harga_satuan')->get();
    // //     $data_produk = tb_produk::all();


    // //     return view('pages.transaction', ['transDt'=>$dt, 'dt_barang' => $data_produk]);
    // // }

    // public function input(){
    //     return view('pages.input-trans');
    // }

    // public function proses_transaction(Request $req){

    //     $messages = [
    //         'required' => ':attribute Wajib Di Isi',
    //         'max' => ':attribute Maksimal Berisi :max Karakter',
    //         'numeric' => ':attribute Harus Berisi Angka'
    //     ];

    //     $this->validate($req, [
    //         'namaBrg' => 'required|max:50',
    //         'hrgSatuan' => 'required|numeric',
    //         'jml' => 'required|numeric|max:10',
    //     ], $messages);

    //     $totalhrg = $req->hrgSatuan*$req->jml;

    //     tb_transaksi::create([
    //         'nama_barang' => $req->namaBrg,
    //         'harga_satuan' => $req->hrgSatuan,
    //         'jml_barang' => $req->jml,
    //         'total_harga' => $totalhrg
    //     ]);

    //     // DB::table('tb_transaksi')
    //     //     ->insert([
    //     //         'nama_barang' => $req->namaBrg,
    //     //         'harga_satuan' => $req->hrgSatuan,
    //     //         'jml_barang' => $req->jml,
    //     //         'total_harga' => $totalhrg
    //     //     ]);


    //     return redirect('/web-admin/transaction');
    // }

    // public function edit_trans($id){
        
    //     // $dt = tb_transaksi::where('id_transaksi', $id)->first();

    //     $dt = tb_transaksi::findOrFail($id);

    //     return view('pages.trans-edit', ['dt'=>$dt]); 
    // }

    // public function update_trans($id, Request $req){

    //     $totalhrg = $req->hrgSatuan*$req->jml;

    //     $dt = tb_transaksi::find($id);
    //     $dt->nama_barang = $req->namaBrg;
    //     $dt->harga_satuan = $req->hrgSatuan;
    //     $dt->jml_barang = $req->jml;
    //     $dt->total_harga = $totalhrg;
    //     $dt->save();

    //     return redirect('/web-admin/transaction');
    // }

    // public function delete_trans($id){
    //     $dt = tb_transaksi::find($id);
    //     $dt->delete();

    //     return redirect('/web-admin/transaction');
    // }

    // public function tempat_sampah(){

    //     $dt = tb_transaksi::onlyTrashed()->get();
    //     $no = 1;

    //     return view('pages.tempat-sampah', ['dt' => $dt, 'no' => $no]);
    // }

    // public function restore_trans($id){

    //     $dt = tb_transaksi::onlyTrashed()->where('id_transaksi', $id);
    //     $dt->restore();

    //     return redirect('/web-admin/trash');
    // }

    // public function alt_del_trans($id){
        
    //     $dt = tb_transaksi::onlyTrashed()->where('id_transaksi', $id);
    //     $dt->forceDelete();

    //     return redirect('/web-admin/trash');
    // }

    // public function restore_all_trans(){
    //     $dt = tb_transaksi::onlyTrashed();
    //     $dt->restore();

    //     return redirect('/web-admin/trash');
    // }

    // public function alt_del_all_trans(){
    //     $dt = tb_transaksi::onlyTrashed();
    //     $dt->forceDelete();

    //     return redirect('/web-admin/trash');
    // }

    //------------------------------ TES NEW TRANSAKSI -------------------------------------

    public function transaction(){

        $dt1 = tb_produk::all();
        $dt2 = DB::table('tb_customer')->get();

        return view('pages.transactions.transaction', ['dt_barang' => $dt1, 'dt_customers' => $dt2]);
    }
    
    public function olah_transaksi(Request $req) {

        $cek_Data1 = $req->invoice;
        $cek_Data2 = $req->nama_user;
        $cek_Data3 = $req->jenis_customer;
        $cek_Data4 = $req->total_harga;
        $cek_Data5 = $req->tunai;
        $cek_Data6 = $req->kembalian;
        $cek_DataArr1 = $req->id_barang;
        $cek_DataArr2 = $req->jml_barang;

        tb_invoice::create([
            'id_invoice' => $cek_Data1,
            'id_user' => $cek_Data2,
            'id_customer' => $cek_Data3,
            'total' => $cek_Data4,
            'tunai' => $cek_Data5,
            'kembali' => $cek_Data6
        ]);

        foreach ($cek_DataArr1 as $k => $v) {
            tb_invoice_detail::create([
                'id_invoice' => $cek_Data1,
                'id_barang' => $v,
                'qty' => $cek_DataArr2[$k]
            ]);
        }

        return redirect()->route('transaction');
    }

    //------------------------------- PAGE REPORT FORM --------------------------------------

    public function reports(){

        // $dt = tb_transaksi::all();

        // $get_transaksi = tb_transaksi::join('tb_produk', 'tb_transaksi.id_barang', '=', 'tb_produk.id_barang')
        //                     ->select('tb_transaksi.created_at', 'tb_produk.nama_barang', 'tb_transaksi.jml_barang', 'tb_produk.harga_satuan', 'tb_transaksi.total_harga')
        //                     ->get();
        // $dt = $get_transaksi;

        $get_data_invoiceCustomer = tb_invoice::join('tb_customer', 'tb_invoice.id_customer', '=', 'tb_customer.id_customer')
                                                ->select('tb_invoice.id_invoice', 'tb_invoice.created_at', 'tb_customer.nama_customer', 'tb_invoice.total')
                                                ->get();
        
        $get_data_nama_customer_dalam_invoice = tb_invoice::join('tb_customer', 'tb_invoice.id_customer', '=', 'tb_customer.id_customer')
                                                            ->select('tb_customer.nama_customer')
                                                            ->distinct()
                                                            ->get();

        return view('pages.reports.reports', [
            'dt_invoice_customer' => $get_data_invoiceCustomer, 
            'filter_nama' => $get_data_nama_customer_dalam_invoice
            ]);
    }

    public function filter_laporan(Request $req) {
        $from = $req->fromDate;
        $to = $req->toDate;
        $customer_filter = "%".$req->customer_filter."%";
        $invoice_filter = "%".$req->invoice_filter."%";

        // dd($invoice_filter);

        // $dt = tb_transaksi::join('tb_produk', 'tb_transaksi.id_barang', '=', 'tb_produk.id_barang')
        //                     ->select('tb_transaksi.created_at', 'tb_produk.nama_barang', 'tb_transaksi.jml_barang', 'tb_produk.harga_satuan', 'tb_transaksi.total_harga')
        //                     ->get();

        $get_data_nama_customer_dalam_invoice = tb_invoice::join('tb_customer', 'tb_invoice.id_customer', '=', 'tb_customer.id_customer')
                                                            ->select('tb_customer.nama_customer')
                                                            ->distinct()
                                                            ->get();

        if ($from != null && $to != null) {
            $get_data_invoiceCustomer = tb_invoice::join('tb_customer', 'tb_invoice.id_customer', '=', 'tb_customer.id_customer')
                                                    ->select('tb_invoice.id_invoice', 'tb_invoice.created_at', 'tb_customer.nama_customer', 'tb_invoice.total')
                                                    ->whereRaw('date(created_at) BETWEEN ? AND ?', [$from, $to])
                                                    ->where('id_invoice', 'like', $invoice_filter)
                                                    ->where('nama_customer', 'like', $customer_filter)
                                                    ->get();
        } else {
            $get_data_invoiceCustomer = tb_invoice::join('tb_customer', 'tb_invoice.id_customer', '=', 'tb_customer.id_customer')
                                                    ->select('tb_invoice.id_invoice', 'tb_invoice.created_at', 'tb_customer.nama_customer', 'tb_invoice.total')
                                                    ->where('id_invoice', 'like', $invoice_filter)
                                                    ->where('nama_customer', 'like', $customer_filter)
                                                    ->get();
        }
        
                                                            
        

        // $filtered_dt = $get_data_invoiceCustomer->where('id_invoice', '=', $invoice_filter)->all();

        // $filtered_dt = $get_data_invoiceCustomer->where([
        //     ['created_at', '>=', $from],
        //     ['created_at', '<=', $to],
        //     ['nama_customer', '=', $customer_filter],
        //     ['id_invoice', '=', $invoice_filter]
        // ])->get();

        // dd($customer_filter, $invoice_filter, $get_data_invoiceCustomer);
        

        // $filtered_dt = $dt->whereBetween('created_at', [$from, $to]);
        
        // where('created_at', '<=', $from)->where('created_at', '>=', $to);
        // $final_dt = $filtered_dt->all();

        return view('pages.reports.reports', ['dt_invoice_customer' => $get_data_invoiceCustomer, 
                                      'tglDari' => $from, 
                                      'tglKe' => $to,
                                      'input_customer' => $customer_filter,
                                      'input_invoice' => $invoice_filter, 
                                      'filter_nama' => $get_data_nama_customer_dalam_invoice
                                      ]);
    }

    public function lap_pdf(Request $request) {

        $dari = $request->id1;
        $ke =  $request->id2;
        $input_cus = $request->id3;
        $input_inv = $request->id4;

        // dd($request->id4);
        
        // $dt = tb_transaksi::join('tb_produk', 'tb_transaksi.id_barang', '=', 'tb_produk.id_barang')
        //                     ->select('tb_transaksi.created_at', 'tb_produk.nama_barang', 'tb_transaksi.jml_barang', 'tb_produk.harga_satuan', 'tb_transaksi.total_harga')
        //                     ->get();

        // $dt = tb_invoice::join('tb_customer', 'tb_invoice.id_customer', '=', 'tb_customer.id_customer')
        //                     ->select('tb_invoice.id_invoice', 'tb_invoice.created_at', 'tb_customer.nama_customer', 'tb_invoice.total')
        //                     ->get();

        if ($dari <> '' && $ke != '') {
    
            // $filtered_dt = $dt->whereBetween('created_at', [$dari, $ke]);


            $filtered_dt = tb_invoice::join('tb_customer', 'tb_invoice.id_customer', '=', 'tb_customer.id_customer')
                                ->select('tb_invoice.id_invoice', 'tb_invoice.created_at', 'tb_customer.nama_customer', 'tb_invoice.total')
                                ->whereRaw('date(created_at) BETWEEN ? AND ?', [$dari, $ke])
                                ->Where('id_invoice', 'like', $input_inv)
                                ->where('nama_customer', 'like', $input_cus)
                                ->get();

            $ke =  Str::before($request->id2,'%');
            
            $pdf = PDF::loadview('pages.reports.laporan-pdf', ['data'=>$filtered_dt, 'dari'=>$dari, 'ke'=>$ke]);
            return $pdf->stream();

        } else {

            $filtered_dt = tb_invoice::join('tb_customer', 'tb_invoice.id_customer', '=', 'tb_customer.id_customer')
                                ->select('tb_invoice.id_invoice', 'tb_invoice.created_at', 'tb_customer.nama_customer', 'tb_invoice.total')
                                ->where('id_invoice', 'like', $input_inv)
                                ->where('nama_customer', 'like', $input_cus)
                                ->get();

            $pdf = PDF::loadview('pages.reports.laporan-pdf', ['data'=>$filtered_dt]);
            return $pdf->stream();

        }
    }

}
