@extends('layouts.master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>User</h1>
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
            <h2>Info Lainnya</h2>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-borderless table-responsive">
              <tbody>
                @foreach ($dataUser as $dt)
                  <tr>
                    <th scope="row">ID </th>
                    <td>:</td>
                    <td>{{ $dt->id }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Nama </th>
                    <td>:</td>
                    <td>{{ $dt->name }}</td>
                  </tr>
                  {{-- <tr>
                    <th scope="row">Jenis Kelamin</th>
                    <td>:</td>
                    <td>{{ $dt->jenis_kelamin }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Username</th>
                    <td>:</td>
                    <td>{{ $dt->username }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Password</th>
                    <td>:</td>
                    <td>{{ $dt->pass }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Posisi</th>
                    <td>:</td>
                    <td>{{ $dt->jabatan }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Shift</th>
                    <td>:</td>
                    <td>{{ $dt->shift }}</td>
                  </tr>
                  <tr>
                    <th scope="row">No. Tel</th>
                    <td>:</td>
                    <td>{{ $dt->no_tlp }}</td>
                  </tr> --}}
                  <tr>
                    <th scope="row">Email</th>
                    <td>:</td>
                    <td>{{ $dt->email }}</td>
                  </tr>
                  {{-- <tr>
                    <th scope="row">Alamat</th>
                    <td>:</td>
                    <td>{{ $dt->alamat }}</td>
                  </tr> --}}
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer text-right">
            <a href="{{ route('users') }}" class="btn btn-danger" role="button">Kembali</a>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
    </section>

@endsection