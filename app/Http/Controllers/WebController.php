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
use Session;
use PDF;
use Illuminate\Support\Str;

class WebController extends Controller
{
    //-------------------------------- Reuse Code --------------------------------------

    public function get_tb_kategori_data() {
        return $data_kategori = DB::table('tb_kategori')->get();
    }

    public function stokAlert(){

        $dt = tb_produk::select('stok')->where('stok', '<', 20)->first();
        if ($dt) {
            Session::put('stok-alert', 'Stok Anda Mendekati Kosong');
        } else {
            Session::forget('stok-alert');
        }

    }

    //------------------------------ URL Protection -----------------------------------

    public function __construct(){
        $this->middleware('auth');
    }

    //------------------------------- PAGE DASHBOARD --------------------------------------

    public function dashboard(){

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

        $this->stokAlert();

        return view('pages.dashboard.dashboard', [
            'total' => $total_pemasukan, 
            'jml_visitor' => $hitung_pengunjung, 
            'total_jual' => $hitung_total_barang, 
            'total_masukan' => $hitung_total_masukan,
            'produk_terbaru' => $sort_produk,
            'jml_sales' => $get_transaksi]);
    }

    //------------------------------- PAGE NEW USERS --------------------------------------

    // Fungsi untuk menampilkan data users dari database
    public function users(){

        // Mengambil data dari database (Query Builder)
        $dataUsr = User::all();

        // Mengoper data ke page daftar user
        return view('pages..users.users', ['usersData'=>$dataUsr]);
    }


    // Fungsi untuk memasukan data user baru ke database
    public function proses_tambah_users(Request $reqs){

        if ($reqs->pos == 0 ) {
            // $pos = "Admin";
            $Role = Role::where('jabatan', 'Admin')->first();
        } else {
            // $pos = "Kasir";
            $Role = Role::where('jabatan', 'Kasir')->first();
        }

       // Memasukan data user baru ke database
       
       $dt = User::create([
           'name' => $reqs->nm,
           'email' => $reqs->email,
           'password' => Hash::make('password')
           ]);
           
        $dt->roles()->attach($Role);

        if ($dt) {
            $reqs->session()->flash('tambah-success', ' ' . $reqs->nm . ' ');
        } else {
            $reqs->session()->flash('tambah-error', ' ' . $reqs->nm . ' ');
        }

        // Mengarahkan kembali Route yang di tuju
        return redirect()->route('users');
    }

    //Fungsi untuk Menampilkan Data lengkap User
    public function detail_user($id) {
        $dt = User::where('id', $id)->get();

        return view('pages.users.detail-user', ['dataUser' => $dt]);
    }

    //Fungsi untuk mengambil dan mengedit data dari user yang di inginkan
    public function edit_user(User $id){
        
        $roles = Role::all();

        return view('pages.users.edit', [
            'usersDt'=>$id, 
            'roles'=>$roles
            ]);

    }

    // Fungsi untuk menyimpan data user yang sudah di edit
    public function update(Request $req, User $id){

        $id->roles()->sync($req->pos);
        $id->name = $req->nm;
        $id->email = $req->email;


        if ($id->save()) {
            $req->session()->flash('edit-success', ' ' . $req->nm . ' ');
        } else {
            $req->session()->flash('edit-error', ' ' . $req->nm . ' ');
        }
        
        return redirect()->route('users');
    }

    // Fungsi menghapus data user tertentu
    public function delete(Request $req, User $id){

        $dt = $id->name;
        $id->roles()->detach();

        if ($id->delete()) {
            $req->session()->flash('hapus-success', ' ' . $dt . ' ');
        } else {
            $req->session()->flash('hapus-error', ' ' . $dt . ' ');
        }

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

        if ($dt) {
            $reqs->session()->flash('tambah-success', ' ' . $reqs->nama_suplier . ' ');
        } else {
            $reqs->session()->flash('tambah-error', ' ' . $reqs->nama_suplier . ' ');
        }
        

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
        $dt_update = DB::table('tb_suplier')
            ->where('tb_suplier.id_suplier', $req->id)
            ->update([
                'nama_suplier'=> $req->nama_suplier,
                'alamat'=> $req->alamat,
                'nomor_telepon'=> $req->nomor_telepon
            ]);
        
        if ($dt_update) {
            $req->session()->flash('edit-success', ' ' . $req->nama_suplier . ' ');
        } else {
            $req->session()->flash('edit-error', ' ' . $req->nama_suplier . ' ');
        }

        return redirect()->route('supliers');
    }

    // Fungsi menghapus data Suplier tertentu
    public function delete_suplier(Request $req, $id){
        $dt = DB::table('tb_suplier')->select('nama_suplier')->where('id_suplier', $id)->first();
        $dt_delete = DB::table('tb_suplier')
            ->where('id_suplier', $id)
            ->delete();
        
        if ($dt_delete) {
            $req->session()->flash('hapus-success', ' ' . $dt->nama_suplier . ' ');
        } else {
            $req->session()->flash('hapus-error', ' ' . $dt->nama_suplier . ' ');
        }

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

        if ($dt) {
            $reqs->session()->flash('tambah-success', ' ' . $reqs->nama_customer . ' ');
        } else {
            $reqs->session()->flash('tambah-error', ' ' . $reqs->nama_customer . ' ');
        }

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
        $dt_update = DB::table('tb_customer')
            ->where('id_customer', $req->id)
            ->update([
                'nama_customer'=> $req->nama_customer,
                'nomor_telepon'=> $req->nomor_telepon,
                'alamat'=> $req->alamat
            ]);
        
        if ($dt_update) {
            $req->session()->flash('edit-success', ' ' . $req->nama_customer . ' ');
        } else {
            $req->session()->flash('edit-error', ' ' . $req->nama_customer . ' ');
        }

        return redirect()->route('customers');
    }

    // Fungsi menghapus data Customer tertentu
    public function delete_customer(Request $req, $id){
        $dt = DB::table('tb_customer')->select('nama_customer')->where('id_customer', $id)->first();
        $dt_delete = DB::table('tb_customer')
            ->where('id_customer', $id)
            ->delete();

        if ($dt_delete) {
            $req->session()->flash('hapus-success', ' ' . $dt->nama_customer . ' ');
        } else {
            $req->session()->flash('hapus-error', ' ' . $dt->nama_customer . ' ');
        }

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

        $this->stokAlert();
        
        return view('pages.products.product', [
            'dataProduk' => $dtProduk, 
            'dataProdukAll' => $dtProdukAll, 
            'dt_kat' => $this->get_tb_kategori_data()]);
    }

    //Tambah Produk
    public function produk_tambah(Request $req) {
        $dt = DB::table('tb_produk')
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
        
        if ($dt) {
            $req->session()->flash('tambah-success', ' ' . $req->nama_barang . ' ');
        } else {
            $req->session()->flash('tambah-error', ' ' . $req->nama_barang . ' ');
        }

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

        $dt_update = DB::table('tb_produk')
            ->where('tb_produk.id_barang', $req->id)
            ->update([
                'nama_barang'=> $req->nama_barang,
                'harga_satuan'=> $req->harga_barang,
                'stok'=> $req->stok
            ]);
        
        DB::table('link_kategori')
            ->where('link_kategori.id_barang', $req->id)
            ->update( ['id_kat' => $req->kat] );

        if ($dt_update) {
            $req->session()->flash('edit-success', ' ' . $req->nama_barang . ' ');
        } else {
            $req->session()->flash('edit-error', ' ' . $req->nama_barang . ' ');
        }
        
        return redirect()->route('product');
    }

    //Delete Data Produk
    public function delete_produk(Request $req, $id){
        $dt = tb_produk::select('nama_barang')->where('id_barang', $id)->first();
        $dt_hapus = DB::table('tb_produk')
            ->where('id_barang', $id)
            ->delete();

        if ($dt_hapus) {
            $req->session()->flash('hapus-success', ' ' . $dt->nama_barang . ' ');
        } else {
            $req->session()->flash('hapus-error', ' ' . $dt->nama_barang . ' ');
        }

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
        $dt = DB::table('tb_kategori')
            ->insert([
                'nama_kat' => $req->nama_kategori,
            ]);

        if ($dt) {
            $req->session()->flash('tambah-success', ' ' . $req->nama_kategori . ' ');
        } else {
            $req->session()->flash('tambah-error', ' ' . $req->nama_kategori . ' ');
        }

        return redirect()->route('category');
    }

    //Delete Data Kategori
    public function delete_kategori(Request $req, $id){

        $dt = DB::table('tb_kategori')->select('nama_kat')->where('id_kat', $id)->first();

        $dt_delete = DB::table('tb_kategori')
            ->where('id_kat', $id)
            ->delete();

        if ($dt_delete) {
            $req->session()->flash('hapus-success', ' ' . $dt->nama_kat . ' ');
        } else {
            $req->session()->flash('hapus-error', ' ' . $dt->nama_kat . ' ');
        }

        return redirect()->route('category');
    }

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

        $simpan_data1 = tb_invoice::create([
            'id_invoice' => $cek_Data1,
            'id_user' => $cek_Data2,
            'id_customer' => $cek_Data3,
            'total' => $cek_Data4,
            'tunai' => $cek_Data5,
            'kembali' => $cek_Data6
        ]);

        foreach ($cek_DataArr1 as $k => $v) {

            $simpan_data2 = tb_invoice_detail::create([
                'id_invoice' => $cek_Data1,
                'id_barang' => $v,
                'qty' => $cek_DataArr2[$k]
            ]);

            $stok = tb_produk::select('stok')->where('id_barang', $v)->first();
            $reduce_stok = $stok->stok - $cek_DataArr2[$k];
            tb_produk::where('id_barang', $v)->update(['stok' => $reduce_stok]);
            
        }

        if ($simpan_data1 && $simpan_data2) {
            $req->session()->flash('input-success', 'Input Transaction Success');
        } else {
            $req->session()->flash('input-error', 'Input Transaction Fail');
        }

        return redirect()->route('transaction');
    }

    //------------------------------- PAGE REPORT FORM --------------------------------------

    public function reports(){

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

        if ($dari <> '' && $ke != '') {

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
