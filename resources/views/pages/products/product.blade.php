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
        {{-- <div class="card-header">
          <a href="" data-target="#formTambahBarang" data-toggle="modal" role="button" class="btn btn-primary col-md-2"><i class="fas fa-plus"></i> Tambah Barang</a>
        </div> --}}
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
                <th style="width: 250px">Harga</th>
                <th style="width: 170px">Stok</th>
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
                  <td class="text-center">
                    @if ($dt2->stok < 20 && $dt2->stok > 0)
                      <button style="pointer-events: none;" class="btn btn-sm btn-warning">
                        Low Stock <span class="badge badge-light badge-pill">{{ $dt2->stok }}</span>
                      </button>
                    @elseif ($dt2->stok == 0)
                      <button style="pointer-events: none;" class="btn btn-sm btn-danger">
                        Out Of Stock <span class="badge badge-light badge-pill">{{ $dt2->stok }}</span>
                      </button>
                    @else
                      <button style="pointer-events: none;" class="btn btn-sm btn-success">
                        Ready Stock <span class="badge badge-light badge-pill">{{ $dt2->stok }}</span>
                      </button>
                    @endif
                  </td>
                  <td class="text-center">
                    <a href="{{ route('product.edit.data', $dt2->id_barang) }}" class="btn btn-info btn-sm" role="button" title="Ubah Data Barang">Edit</a>
                    <a href="{{ route('product.delete.data', $dt2->id_barang) }}" class="btn btn-danger btn-sm" role="button" title="Hapus Barang" onclick="return confirm('Apa Anda Yakin Ingin Menghapus {{$dt2->nama_barang}} ?')">Hapus</a>
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
    {{-- <div class="modal fade" id="formTambahBarang" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
    </div> --}}
    
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