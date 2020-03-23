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
              {{-- @foreach($usersDt as $dt) --}}
                {{-- <input type="hidden" name="id" value="{{ $dt->id }}"> --}}
                <div class="form-group row">
                  <label for="nm" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required="required" name="nm" value="{{ $usersDt->name }}">
                  </div>
                </div>
                {{-- <div class="form-group row">
                  <label for="usrnm" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required="required" name="usrnm" value="{{ $dt->username }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="pass" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" required="required" name="pass" value="{{ $dt->pass }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                  <div class="col-sm-10">
                    <select name="jk" class="form-control" required="required">
                      <option value="">Pilih</option>
                      <option value="0">Laki-laki</option>
                      <option value="1">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="almt" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" required="required" name="almt">{{ $dt->alamat }}</textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="notlp" class="col-sm-2 col-form-label">No. Telepon</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" required="required" name="notlp" value="{{ $dt->no_tlp }}">
                  </div>
                </div> --}}
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
                {{-- <div class="form-group row">
                  <label for="shift" class="col-sm-2 col-form-label">Shift</label>
                  <div class="col-sm-10">
                    <select name="shift" class="form-control" required="required">
                      <option value="">Pilih</option>
                      <option value="0">Pagi</option>
                      <option value="1">Malam</option>
                    </select>
                  </div>
                </div> --}}
              {{-- @endforeach --}}
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