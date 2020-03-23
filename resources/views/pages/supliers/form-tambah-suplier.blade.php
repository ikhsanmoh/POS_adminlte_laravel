@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Supliers</h1>
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
              <h2>Tambah Suplier</h2>
            </div>
            <!-- /.card-header -->
            <form class="form-horizontal" action="{{ route('supliers.tambah.data') }}" method="post">
              {{ csrf_field() }}
              <div class="card-body">
                  <div class="form-group">
                    <label for="nm">Nama Suplier</label>
                    <input type="text" name="nama_suplier" class="form-control" id="nama_suplier" placeholder="Masukan Nama Suplier">
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat"  rows="3" class="form-control" placeholder="Masukan Alamat"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="nomor_telepon">No. Telelpon</label>
                    <input type="text" name="nomor_telepon" class="form-control" id="nomor_telepon" placeholder="Masukan Nomor Telepon">
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
                <a href="{{ route('supliers') }}" class="btn btn-danger" role="button">Batalkan</a>
              </div>
              <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
      </div>

    </section>
    <!-- /.content -->
@endsection
