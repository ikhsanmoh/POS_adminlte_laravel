@extends('layouts.master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Produk</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

    <!-- Main content -->
    <section class="content">

    <div class="row mx-auto" style="width:800px">
      <div class="col-md-12">
        <div class="card card-info">
          <div class="card-header">
            <h2>Edit Data Produk</h2>
          </div>
          <!-- /.card-header -->
          <form class="form-horizontal" action="{{ route('product.update.data') }}" method="post">
            {{ csrf_field() }}
            <div class="card-body">
              @foreach($dt_produk as $dt)
                <input type="hidden" name="id" value="{{ $dt->id_barang }}">
                <div class="form-group row">
                  <label for="kode_barang" class="col-sm-2 col-form-label">Kode Produk</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="kode_barang" value="{{ $dt->id_barang }}" disabled>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nama_barang" class="col-sm-2 col-form-label">Nama Produk</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required="required" name="nama_barang" value="{{ $dt->nama_barang }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="kat" class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-10">
                    <select name="kat" class="form-control" required="required">
                      <option value="">Pilih</option>
                      @foreach ($dt_kat as $dt2)
                      <option value="{{ $dt2->id_kat }}">{{ $dt2->nama_kat }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="harga_barang" class="col-sm-2 col-form-label">Harga Produk</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" required="required" name="harga_barang" value="{{ $dt->harga_satuan }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="pp" class="col-sm-2 col-form-label">Foto Produk</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto_barang" id="pp">
                        <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Unggah</span>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right">
              <a href="{{ route('product') }}" class="btn btn-danger" role="button">Batalkan</a>
              <input type="submit" class="btn btn-primary" value="Simpan Data">
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
    </section>

@endsection