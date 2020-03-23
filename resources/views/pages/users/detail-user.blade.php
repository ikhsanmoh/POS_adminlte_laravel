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
                  <tr>
                    <th scope="row">Email</th>
                    <td>:</td>
                    <td>{{ $dt->email }}</td>
                  </tr>
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