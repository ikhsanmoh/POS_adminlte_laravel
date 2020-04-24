@extends('layouts.master')

@section('content')

  <!-- Content Header (Page header) -->
  <section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
    <div class="col-sm-6">
        <h1>Report Form - Sales</h1>
    </div>
    </div>
  </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">

              <form action="{{ route('reports.sales.filter') }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                
                <div class="form-row">
                  <div class="col">
                    <label for="fromDate">Dari</label>
                    <input type="text" class="form-control form-control-sm form-control-mb-2 rentang-tgl" placeholder="Pilih Tanggal Awal" name="fromDate" value={{$tglDari??''}}>
                  </div>
                  <div class="col">
                    <label for="toDate">Ke</label>
                    <input type="text" class="form-control form-control-sm form-control-mb-2 rentang-tgl" placeholder="Pilih Tanggal Akhir" name="toDate" value={{$tglKe??''}}>
                  </div>
                  <div class="col-2">
                    <label for="customer">Customer</label>
                    <select class="custom-select custom-select-sm" name="customer_filter">
                      <option value="">-All-</option>
                      @foreach ($filter_nama as $dt)
                          <option value="{{ $dt->nama_customer }}">{{ $dt->nama_customer }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col">
                    <label for="invoice">Invoice</label>
                    <input type="number" class="form-control form-control-sm" name="invoice_filter" placeholder="Masukan Invoice">
                  </div>
                </div>  
                <br>
                <div class="form-row">
                  <div class="col text-right">
                    <input type="submit" class="btn btn-primary btn-sm" name="filtering" value="Filter">&nbsp;&nbsp;
                  </div>
                </div>
              
              </form>

            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-12">
          
          <div class="card">
            <div class="card-header text-right">
              <button type="button" class="btn btn-success btn-sm" onclick="window.open('sales/pdf?id1={{$tglDari ?? ''}}&id2={{$tglKe ?? ''}}&id3={{$input_customer ?? ''}}&id4={{$input_invoice ?? ''}}','_blank')">Cetak</button>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-sm">
                @php
                  $no=1;
                  $total_hrg=0;
                @endphp
      
                <thead>
                <tr class="text-center">
                  <th scope="col" style="width:50px">No</th>
                  <th scope="col">Invoice</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Customer</th>
                  <th scope="col" style="width:250px">Sub Total</th>
                  <th scope="col" style="width:150px">Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($dt_invoice_customer as $d)
                    <tr>
                      <td class="text-center">{{ $no++ }}</td>
                      <td>{{ $d->id_invoice }}</td>
                      <td>{{ $d->created_at }}</td>
                      <td>{{ $d->nama_customer }}</td>
                      <td>Rp. {{ $total = $d->harga_satuan*$d->qty }}</td>
                      <td class="text-center">
                        <a href="detail-invoice{{ $d->id_invoice }}" class="btn btn-info btn-sm" role="button" title="Lihat Detail">Detail</a>
                      </td>
                    </tr>
                    <div hidden>{{ $total_hrg += $total }}</div>
                  @endforeach
                </tbody>
                <tfoot>
                  <th class="text-center" scope="col" colspan="4">Total</th>
                  <td>Rp. {{ $total_hrg }}</td>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
    </div>
    

  </section>

@endsection

@section('reportsjs')
  <script>
    $( function() {
      $( ".rentang-tgl" ).datepicker({
        dateFormat : 'yy-mm-dd'
      });
    } );
  </script>
@endsection