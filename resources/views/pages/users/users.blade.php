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

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="{{ route('users.form.tambah') }}" class="btn btn-primary" role="button" title="Tambah Data"><i class="fas fa-user-plus"></i> Tambah</a>
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
                  <th>ID</th>
                  <th>NAMA</th>
                  <th>EMAIL</th>
                  <th>POSISI</th>
                  <th>AKSI</th>
                </tr>
              </thead>
              <tbody>
              @if($usersData->isEmpty())
              <tr>
                <td colspan="7" class="text-center"><h3>Data Kosong</h3></td>
              </tr>
              @else
              @foreach($usersData as $dt)
                <tr>
                  <td>{{ $dt->id }}</td>
                  <td>{{ $dt->name }}</td>
                  <td>{{ $dt->email }}</td>
                  <td>{{ implode("", $dt->roles()->get()->pluck('jabatan')->toArray() ) }}</td>
                  <td>
                    <a href="{{ route('users.detail.data', $dt->id) }}" class="btn btn-primary" role="button" title="Info Lainnya"><i class="fas fa-info-circle"></i></a>
                    <a href="{{ route('users.edit.data', $dt->id) }}" class="btn btn-success" role="button" title="Ubah Data"><i class="fas fa-user-edit"></i></a>
                    <a href="{{ route('users.delete.data', $dt) }}" class="btn btn-danger" role="button" title="Hapus Data"><i class="fas fa-user-minus"></i></a>
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