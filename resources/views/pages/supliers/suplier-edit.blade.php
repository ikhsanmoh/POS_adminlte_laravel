@extends('layouts.master')

@section('content')

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
            <h2>Edit Data Suplier</h2>
          </div>
          <!-- /.card-header -->
          <form class="form-horizontal" action="{{ route('supliers.update.data') }}" method="post">
            {{ csrf_field() }}
            <div class="card-body">
              @foreach($dt as $d)
                <input type="hidden" name="id" value="{{ $d->id_suplier }}">
                <div class="form-group row">
                  <label for="nama_suplier" class="col-sm-2 col-form-label">Nama Suplier</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required="required" name="nama_suplier" value="{{ $d->nama_suplier }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" required="required" name="alamat">{{ $d->alamat }}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nomor_telepon" class="col-sm-2 col-form-label">No. Telepon</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required="required" name="nomor_telepon" value="{{ $d->nomor_telepon }}">
                  </div>
                </div>
              @endforeach
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right">
              <a href="{{ route('supliers') }}" class="btn btn-danger" role="button">Batalkan</a>
              <input type="submit" class="btn btn-primary" value="Simpan Data">
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
    </section>

@endsection