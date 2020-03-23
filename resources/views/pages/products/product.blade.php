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

    <!-- Cara Pagination 1 : Memanfaatkan Fungsi "Paginate()" Dalam Laravel -->
    {{-- <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Pagination Using a Paginate Function In Laravel</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12 col-md-12">
              <form action="cari" method="GET">
                {{ csrf_field() }}
                <div class="form-group text-right">
                  <input type="text" name="cari" placeholder="Cari Barang..." value="{{ old('cari') }}">
                  <input type="submit" value="Cari">
                </div>
              </form>
            </div>
          </div>
          <table class="table table-bordered">
            <thead>                  
              <tr class="text-center">
                <th style="width: 50px">ID</th>
                <th>Nama Produk</th>
                <th style="width: 300px">Harga</th>
                <th style="width: 100px">Stok</th>
              </tr>
            </thead>
            <tbody>
            @foreach($dataProduk as $dt)
              <tr>
                <td class="text-center">{{ $dt->id_barang }}</td>
                <td>{{ $dt->nama_barang }}</td>
                <td>Rp. {{ $dt->harga_satuan }}</td>
                <td class="text-center">{{ $dt->stok }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          Jumlah Produk : {{ $dataProduk->total() }} 
          <ul class="pagination pagination-sm m-0 float-right">
            {{ $dataProduk->links() }}
          </ul>
        </div>
      </div>
      <!-- /.card -->
    </div> --}}

    <!-- Cara Pagination 2 : Memanfaatkan CSS & Plugin Pada Bootstrap -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <a href="" data-target="#formTambahBarang" data-toggle="modal" role="button" class="btn btn-primary col-md-2"><i class="fas fa-plus"></i> Tambah Barang</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            @php
                $no = 1;
            @endphp
            <thead>
              <tr class="text-center">
                <th style="width: 20px">No</th>
                <th style="width: 30px">Kode</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th style="width: 300px">Harga</th>
                <th style="width: 100px">Stok</th>
                <th>Opsi</th>
              </tr>
            </thead>
            <tbody>
            @if($dataProdukAll->isEmpty())
              <tr>
                <td class="text-center"></td>
                <td></td>
                <td></td>
                <td class="text-center"></td>
              </tr>
            @else
              @foreach($dataProdukAll as $dt2)
                <tr>
                  <td class="text-center">{{ $no++ }}</td>
                  <td class="text-center">{{ $dt2->id_barang }}</td>
                  <td>{{ $dt2->nama_barang }}</td>
                  <td>{{ $dt2->nama_kat }}</td>
                  <td>Rp. {{ $dt2->harga_satuan }}</td>
                  <td class="text-center">{{ $dt2->stok }}</td>
                  <td class="text-center">
                    <a href="{{ route('product.edit.data', $dt2->id_barang) }}" class="btn btn-success btn-sm" role="button" title="Ubah Data Barang">Edit</a>
                    <a href="{{ route('product.delete.data', $dt2->id_barang) }}" class="btn btn-danger btn-sm" role="button" title="Hapus Barang">Hapus</a>
                  </td>
                </tr>
              @endforeach
            @endif
            </tbody>
            <tfoot>
              <tr class="text-center">
                <th>No</th>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Opsi</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- /.card-body -->
    </div>


    <!-- MODAL FORM - TAMBAH BARANG -->
    <div class="modal fade" id="formTambahBarang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalScrollableTitle">Form Tambah User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            
            <div class="modal-body">
              <form role="form" action="{{ route('product.tambah.data') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="nama_barang">Nama Barang</label>
                  <input type="text" name="nama_barang" class="form-control" id="nama_barang" placeholder="Masukan Nama Barang">
                </div>
                <div class="form-group">
                  <label for="kat">Kategori </label>
                  <select class="form-control custom-select" name="kat" id="kat">
                    <option selected>Pilih</option>
                    
                    @foreach ($dt_kat as $dt)
                    <option value="{{ $dt->id_kat }}">{{ $dt->nama_kat }}</option>
                    @endforeach
                  
                  </select>
                </div>
                <div class="form-group">
                  <label for="harga">Harga</label>
                  <input type="number" name="harga" class="form-control" id="harga" placeholder="Masukan Harga Barang">
                </div>
                <div class="form-group">
                  <label for="stok">Stok</label>
                  <input type="number" name="stok" class="form-control" id="stok" placeholder="Masukan Stok Barang">
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