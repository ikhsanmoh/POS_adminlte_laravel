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

    @php
        $no = 1;
    @endphp

    @include('partials.alerts')

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="{{ route('supliers.form.tambah') }}" class="btn btn-primary" role="button" title="Tambah Suplier"><i class="fas fa-user-plus"></i> Tambah</a>
            <div class="card-tools mt-2">
              
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>NAMA SUPLIER</th>
                  <th>ALAMAT</th>
                  <th>NO. TELEPON</th>
                  <th>AKSI</th>
                </tr>
              </thead>
              <tbody>
              @if($dt->isEmpty())
              <tr>
                <td colspan="7" class="text-center"><h3>Data Kosong</h3></td>
              </tr>
              @else
              @foreach($dt as $d)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $d->nama_suplier }}</td>
                  <td>{{ $d->alamat }}</td>
                  <td>{{ $d->nomor_telepon }}</td>
                  <td>
                    <a href="{{ route('supliers.edit.data', $d->id_suplier) }}" class="btn btn-success" role="button" title="Ubah Data"><i class="fas fa-user-edit"></i></a>
                    <a href="{{ route('supliers.delete.data', $d->id_suplier) }}" class="btn btn-danger" role="button" title="Hapus Data" onclick="return confirm('Apa Anda Yakin Ingin Menghapus {{$d->nama_suplier}} ?')"><i class="fas fa-user-minus"></i></a>
                  </td>
                </tr>
              @endforeach
              @endif
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>

</section>
    <!-- /.content -->
  @endsection