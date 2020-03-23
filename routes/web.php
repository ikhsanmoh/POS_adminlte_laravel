<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

//Dashboard Page
Route::get('/dashboard', 'WebController@dashboard')->name('dashboard');

//Supliers Page
Route::get('/supliers', 'WebController@supliers')->name('supliers');
Route::prefix('supliers')->name('supliers.')->group(function(){
    Route::get('/form-tambah', function () {
        return view('pages.supliers.form-tambah-suplier');
    })->name('form.tambah');
    Route::post('/tambah', 'WebController@proses_tambah_suplier')->name('tambah.data');
    Route::get('/edit/{id}', 'WebController@edit_suplier')->name('edit.data');
    Route::post('/update', 'WebController@update_suplier')->name('update.data');
    Route::get('/delete/{id}', 'WebController@delete_suplier')->name('delete.data');
});

//Customers Page
Route::get('/customers', 'WebController@customers')->name('customers');
Route::prefix('customers')->name('customers.')->group(function(){
    Route::get('/form-tambah', function () {
        return view('pages.customers.form-tambah-customer');
    })->name('form.tambah');
    Route::post('/tambah', 'WebController@proses_tambah_customer')->name('tambah.data');
    Route::get('/edit/{id}', 'WebController@edit_customer')->name('edit.data');
    Route::post('/update', 'WebController@update_customer')->name('update.data');
    Route::get('/delete/{id}', 'WebController@delete_customer')->name('delete.data');
});

//Users Page
Route::get('/users', 'WebController@users')->middleware('can:admin-only')->name('users');
Route::prefix('users')->name('users.')->middleware('can:admin-only')->group(function(){
    Route::get('/form-tambah', function () {
        return view('pages.users.form-tambah-user');
    })->name('form.tambah');
    Route::post('/tambah', 'WebController@proses_tambah_users')->name('tambah.data');
    Route::get('/detail/{id}', 'WebController@detail_user')->name('detail.data');
    Route::get('/edit/{id}', 'WebController@edit_user')->name('edit.data');
    Route::put('/update/{id}', 'WebController@update')->name('update.data');
    Route::get('/delete/{id}', 'WebController@delete')->name('delete.data');
});

//Items Page
Route::get('/product', 'WebController@product')->name('product');
Route::prefix('product')->name('product.')->group(function(){
    Route::post('/tambah', 'WebController@produk_tambah')->name('tambah.data');
    Route::get('/edit/{id}', 'WebController@edit_produk')->name('edit.data');
    Route::post('/update', 'WebController@update_produk')->name('update.data');
    Route::get('/delete/{id}', 'WebController@delete_produk')->name('delete.data');
    Route::get('/cari', 'WebController@cari')->name('cari.data');
});

//Category Page
Route::get('/category', 'WebController@kategori')->name('category');
Route::prefix('category')->name('category.')->group(function(){
    Route::post('/tambah', 'WebController@kategori_tambah')->name('tambah.data');
    Route::get('/edit/{id}', 'WebController@edit_kategori')->name('edit.data');
    Route::get('/delete/{id}', 'WebController@delete_kategori')->name('delete.data');
});

//Transaction Page
Route::get('/transaction', 'WebController@transaction')->name('transaction');
Route::prefix('transaction')->name('transaction.')->group(function(){
    Route::post('/proses', 'WebController@olah_transaksi')->name('input.data');
});

//Reports Page
Route::get('/reports', 'WebController@reports')->name('reports');
Route::prefix('reports')->name('reports.')->group(function(){
    Route::post('/filter', 'WebController@filter_laporan')->name('filter');
    Route::get('/pdf', 'WebController@lap_pdf')->name('pdf');
});

// //Fixed old Transaction
// Route::get('/input', 'WebController@input')->name('transaction.form.tambah');
// Route::post('/transaction_formulir', 'WebController@proses_transaction')->name('transaction.tambah.data');
// Route::get('/trans-edit/{id}', 'WebController@edit_trans')->name('transaction.edit.data');
// Route::put('/update-trans/{id}', 'WebController@update_trans')->name('transaction.update.data');
// Route::get('/trans-hapus/{id}', 'WebController@delete_trans')->name('transaction.delete.data');
// Route::get('/trash', 'WebController@tempat_sampah')->name('transaction.bin.data');
// Route::get('/kembalikan-trans/{id}', 'WebController@restore_trans')->name('transaction.restore.data');
// Route::get('/hapusPermanen-trans/{id}', 'WebController@alt_del_trans')->name('transaction.force.delete.data');
// Route::get('/kembalikanSemua-trans', 'WebController@restore_all_trans')->name('transaction.restore.all.data');
// Route::get('/hapusPermanenSemua-trans', 'WebController@alt_del_all_trans')->name('transaction.force.delete.all.data');


//---------------------------------------------- Old Routes -----------------------------------------------------

// Route::get('/login', 'WebController@login');
// Route::post('/login', 'WebController@proses_login');
// Route::get('/forgot-pass', 'WebController@forgotpass');

// // Routes untuk Dashboard
// Route::get('/web-admin/dashboard', 'WebController@dashboard');

// // Routes untuk CRUD Supliers
// Route::get('/web-admin/supliers', 'WebController@supliers');
// Route::get('/web-admin/suplier-tambah', function () {
//     return view('pages.form-tambah-suplier');
// });
// Route::post('/web-admin/proses-tambah-suplier', 'WebController@proses_tambah_suplier');
// Route::get('/web-admin/suplier-edit{id}', 'WebController@edit_suplier');
// Route::post('/web-admin/suplier-update', 'WebController@update_suplier');
// Route::get('/web-admin/suplier-delete{id}', 'WebController@delete_suplier');

// // Routes untuk CRUD Customers
// Route::get('/web-admin/customers', 'WebController@customers');
// Route::get('/web-admin/customer-tambah', function () {
//     return view('pages.form-tambah-customer');
// });
// Route::post('/web-admin/proses-tambah-customer', 'WebController@proses_tambah_customer');
// Route::get('/web-admin/customer-edit{id}', 'WebController@edit_customer');
// Route::post('/web-admin/customer-update', 'WebController@update_customer');
// Route::get('/web-admin/customer-delete{id}', 'WebController@delete_customer');

// // Routes untuk CRUD Users
// Route::get('/web-admin/users', 'WebController@users');
// Route::get('/web-admin/user-tambah', function () {
//     return view('pages.form-tambah-user');
// });
// Route::post('/web-admin/proses-tambah-user', 'WebController@proses_tambah_users');
// Route::get('/web-admin/detail{id}', 'WebController@detail_user');
// Route::get('/web-admin/edit{id}', 'WebController@edit_user');
// Route::post('/web-admin/update', 'WebController@update');
// Route::get('/web-admin/delete{id}', 'WebController@delete');

// // Routes untuk CRUD Items
// Route::get('/web-admin/product', 'WebController@product');
// Route::post('/web-admin/produk-tambah', 'WebController@produk_tambah');
// Route::get('/web-admin/produk-edit{id}', 'WebController@edit_produk');
// Route::post('/web-admin/produk-update', 'WebController@update_produk');
// Route::get('/web-admin/produk-delete{id}', 'WebController@delete_produk');
// Route::get('/web-admin/cari', 'WebController@cari');

// //Routes untuk Category
// Route::get('/web-admin/category', 'WebController@kategori');
// Route::post('/web-admin/kategori-tambah', 'WebController@kategori_tambah');
// Route::get('/web-admin/kategori-edit{id}', 'WebController@edit_kategori');
// Route::get('/web-admin/kategori-delete{id}', 'WebController@delete_kategori');

// // Routes untuk CRUD Transacation (Using Eloquent Laravel)
// Route::get('/web-admin/transaction', 'WebController@transaction');
// Route::get('/web-admin/input-trans', 'WebController@input');
// Route::post('/web-admin/transaction_formulir', 'WebController@proses_transaction');
// Route::get('/web-admin/trans-edit{id}', 'WebController@edit_trans');
// Route::put('/web-admin/update-trans{id}', 'WebController@update_trans');
// Route::get('/web-admin/trans-hapus{id}', 'WebController@delete_trans');
// Route::get('/web-admin/trash', 'WebController@tempat_sampah');
// Route::get('/web-admin/kembalikan-trans{id}', 'WebController@restore_trans');
// Route::get('/web-admin/hapusPermanen-trans{id}', 'WebController@alt_del_trans');
// Route::get('/web-admin/kembalikanSemua-trans', 'WebController@restore_all_trans');
// Route::get('/web-admin/hapusPermanenSemua-trans', 'WebController@alt_del_all_trans');
// Route::post('/web-admin/olah-transaksi', 'WebController@olah_transaksi');

// // Routes Untuk Report Form
// Route::get('/web-admin/reports', 'WebController@reports');
// Route::post('/web-admin/filterLaporan', 'WebController@filter_laporan');
// Route::get('/web-admin/lapPdf', 'WebController@lap_pdf');


// //Latihan Eloquent Laravel
// Route::get ('/coba2', 'Coba2Controller@showCoba2');
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
