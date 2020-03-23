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
                  {{-- <th>SHIFT</th> --}}
                  {{-- <th>NO. TELEPON</th> --}}
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
                  {{-- <td>{{ $data = $dt->roles()->get() }}</td> --}}
                  {{-- <td>{{ $dt->no_tlp }}</td> --}}
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


    <!-- MODAL FORM - TAMBAH USER -->
    {{-- <div class="modal fade" id="myForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Form Tambah User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            {{ csrf_field() }}
            <div class="modal-body">
              <form role="form" action="proses" method="post">
                <div class="form-group">
                  <label for="nm">Nama</label>
                  <input type="text" name="nm" class="form-control" id="nm" placeholder="Masukan Nama">
                </div>
                <div class="form-group">
                  <label for="un">Username</label>
                  <input type="text" name="usrnm" class="form-control" id="un" placeholder="Masukan Username">
                </div>
                <div class="form-group">
                  <label for="pass">Password</label>
                  <input type="password" name="pass" class="form-control" id="pass" placeholder="Masukan Password">
                </div>
                <div class="form-group">
                  <label for="jk">Jenis Kelamin </label>
                  <select class="form-control custom-select" name="jk" id="jk">
                    <option selected>Pilih</option>
                    <option value="0">Pria</option>
                    <option value="1">Wanita</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="almt">Alamat</label>
                  <textarea name="almt" id="almt"  rows="3" class="form-control" placeholder="Masukan Alamat"></textarea>
                </div>
                <div class="form-group">
                  <label for="ntlp">No. Tel</label>
                  <input type="text" name="notlp" class="form-control" id="ntlp" placeholder="Masukan Nomor Telepon">
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
                <div class="form-group">
                  <label for="shift">Shift</label>
                  <select class="form-control custom-select" name="shift" id="shift">
                    <option selected>Pilih</option>
                    <option value="0">Pagi</option>
                    <option value="1">Malam</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="pp">Foto</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="pp">
                      <label class="custom-file-label" for="exampleInputFile">Pilih File</label>
                    </div>
                    <div class="input-group-append">
                      <span class="input-group-text" id="">Unggah</span>
                    </div>
                  </div>
                </div>
            </div>
            <!-- /.modal-body -->
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </form>
        </div>
      </div>
    </div> --}}


    <!-- MODAL FORM - DETAIL USER -->
    {{-- <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Detail User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-borderless table-responsive">
              <tbody>
                @if(count($usersData))
                <tr>
                  <th scope="row">ID </th>
                  <td>:</td>
                  <td>{{ $dt->id_user }}</td>
                </tr>
                <tr>
                  <th scope="row">Nama </th>
                  <td>:</td>
                  <td>{{ $dt->nama_lengkap }}</td>
                </tr>
                <tr>
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
                </tr>
                <tr>
                  <th scope="row">Email</th>
                  <td>:</td>
                  <td>{{ $dt->email }}</td>
                </tr>
                <tr>
                  <th scope="row">Alamat</th>
                  <td>:</td>
                  <td>{{ $dt->alamat }}</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div> --}}
</section>
    <!-- /.content -->
  @endsection