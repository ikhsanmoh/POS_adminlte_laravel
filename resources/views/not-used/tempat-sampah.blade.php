@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Transaction</h1>
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
            <h3 class="card-title">Tempat Sampah</h3>
            <div class="card-tools">
              <a href="kembalikanSemua-trans" class="btn btn-success" role="button" title="Kembalikan Semua Data"><i class="fas fa-trash-restore"></i></a>
              <a href="hapusPermanenSemua-trans" class="btn btn-danger" role="button" title="Hapus Permanen Semua Data "><i class="fas fa-dumpster-fire"></i></a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table-trans1" class="table table-bordered table-striped">
              <thead>
                <tr role="row">
                  <th>No</th>
                  <th>Nama Barang</th>
                  <th>Harga Satuan</th>
                  <th>Jumlah</th>
                  <th>Total Harga</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
              @if($dt->isEmpty())
                <tr>
                  <td colspan="7" class="text-center"><h3>Tempat Sampah Kosong</h3></td>
                </tr>
              @else
                @foreach($dt as $d)
                  <tr role="row" class="odd">
                    <td>{{ $no++ }}</td>
                    <td>{{ $d->nama_barang }}</td>
                    <td>Rp. {{ $d->harga_satuan }}</td>
                    <td>{{ $d->jml_barang }}</td>
                    <td>Rp. {{ $d->total_harga }}</td>
                    <td class="text-center">
                    <a href="kembalikan-trans{{ $d->id_transaksi }}" class="btn btn-success" role="button" title="Kembalikan Data"><i class="fas fa-undo"></i></a>
                    <a href="hapusPermanen-trans{{ $d->id_transaksi }}" class="btn btn-danger" role="button" title="Hapus Permanen Data"><i class="fas fa-times"></i></a>
                    </td>
                  </tr>
                @endforeach
              @endif
              </tbody>
              <tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>

    </section>
    <!-- /.content -->
  @endsection

  @section('transactionjs')

  <script>
    $(function () {
      $("#table-trans1").DataTable();
    });
  </script>

  @endsection