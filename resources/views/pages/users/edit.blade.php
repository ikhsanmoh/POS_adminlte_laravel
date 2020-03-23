@extends('layouts.master')

@section('content')

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
            <h2>Edit Data User</h2>
          </div>
          <!-- /.card-header -->
          <form class="form-horizontal" action="{{ route('users.update.data', $usersDt) }}" method="post">
            @csrf
            {{ method_field('PUT') }}
            <div class="card-body">
                <div class="form-group row">
                  <label for="nm" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required="required" name="nm" value="{{ $usersDt->name }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" required="required" name="email" value="{{ $usersDt->email }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="pos" class="col-sm-2 col-form-label">Posisi</label>
                  <div class="col-sm-10">
                    <select name="pos" class="form-control" required="required">
                      <option value="">Pilih</option>
                      @foreach ($roles as $r)
                        <option value="{{$r->id}}">{{ $r->jabatan }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right">
              <a href="{{ route('users') }}" class="btn btn-danger" role="button">Batalkan</a>
              <input type="submit" class="btn btn-primary" value="Simpan Data">
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
    </section>

@endsection