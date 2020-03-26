@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Product</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

    <!-- Main content -->
    <section class="content">

    @include('partials.alerts')

    <!-- Cara Pagination 2 : Memanfaatkan CSS & Plugin Pada Bootstrap -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <a href="" data-target="#formTambahKategori" data-toggle="modal" role="button" class="btn btn-primary col-md-2"><i class="fas fa-plus"></i> Tambah Kategori</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered">
            @php
                $no = 1;
            @endphp
            <thead>
              <tr class="text-center">
                <th style="width: 20px">No</th>
                <th style="width: 30px">Kode</th>
                <th>Nama Kategori</th>
                <th style="width: 200px">Opsi</th>
              </tr>
            </thead>
            <tbody>
            @if($dt->isEmpty())
              <tr>
                <td class="text-center"></td>
                <td></td>
                <td></td>
                <td class="text-center"></td>
              </tr>
            @else
              @foreach($dt as $d)
                <tr>
                  <td class="text-center">{{ $no++ }}</td>
                  <td class="text-center">{{ $d->id_kat }}</td>
                  <td>{{ $d->nama_kat }}</td>
                  <td class="text-center">
                    <a href="{{ route('category.delete.data', $d->id_kat) }}" class="btn btn-danger btn-sm" role="button" title="Hapus Barang">Hapus</a>
                  </td>
                </tr>
              @endforeach
            @endif
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.card-body -->
    </div>


    <!-- MODAL FORM - TAMBAH BARANG -->
    <div class="modal fade" id="formTambahKategori" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Form Tambah User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            
            <div class="modal-body">
              <form role="form" action="{{ route('category.tambah.data') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="nama_kategori">Nama Kategori</label>
                  <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" placeholder="Masukan Nama Kategori">
                </div>
            </div>
            <!-- /.modal-body -->
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </form>
        </div>
      </div>
    </div>
    
    </section>
    <!-- /.content -->
@endsection

@section('productjs')

<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
@endsection