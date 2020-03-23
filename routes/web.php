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
