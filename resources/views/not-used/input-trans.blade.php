@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Transaksi</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

<div class="row mx-auto" style="max-width:800px">
  <div class="col-md-12">

    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Masukan Transaksi</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form role="form" action="transaction_formulir" method="post">
        {{ csrf_field() }}
        <div class="card-body">
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" class="form-control" name="namaBrg" placeholder="Masukan Nama Barang">
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input type="number" class="form-control" name="hrgSatuan" placeholder="Harga Satuan" required>
          </div>
          <div class="form-group">
            <label>Jumlah</label>
            <input type="number" class="form-control" name="jml" placeholder="Jumlah" required>
          </div>
          <div class="form-group">
            <label>Total Harga</label>
            <input type="number" class="form-control" name="totalHrg" placeholder="Total Harga" disabled>
          </div>
          <div class="form-group">
            <label>Jumlah Bayar</label>
            <input type="number" class="form-control" name="tunai" placeholder="Masukan Tunai" required>
          </div>
        </div>
        <!-- /.card-body -->
        @if(count($errors)>0)
          <div class="alert alert-danger mx-auto mb-3" style="max-width:750px">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>

  </div>
</div>

  

</section>

@endsection