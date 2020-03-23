@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Users</h1>
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
              <h2>Tambah User</h2>
            </div>
            <!-- /.card-header -->
            <form class="form-horizontal" action="{{ route('users.tambah.data') }}" method="post">
              {{ csrf_field() }}
              <div class="card-body">
                <form role="form" action="proses-tambah-user" method="post">
                  <div class="form-group">
                    <label for="nm">Nama</label>
                    <input type="text" name="nm" class="form-control" id="nm" placeholder="Masukan Nama">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Masukan Alamat Email">
                  </div>
                  <div class="form-group">
                    <label for="pos">Jabatan</label>
                    <select class="form-control custom-select" name="pos" id="pos">
                      <option selected>Pilih</option>
                      <option value="0">Admin</option>
                      <option value="1">Kasir</option>
                    </select>
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </form>
                <a href="{{ route('users') }}" class="btn btn-danger" role="button">Batalkan</a>
              </div>
              <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
      </div>

    </section>
    <!-- /.content -->
@endsection
