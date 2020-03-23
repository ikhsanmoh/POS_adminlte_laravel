@extends('layouts.master')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">

        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Total Pendatang</span>
                <span class="info-box-number">
                  {{ $jml_visitor }}
                  <!--
                  10
                  <small>%</small>
                  -->
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Total Penjualan</span>
                <span class="info-box-number">{{ $total_jual }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
  
          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
  
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill-wave"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Total Masukan</span>
                <span class="info-box-number">Rp. {{ number_format($total_masukan, 0, '.', '.') }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-hand-holding-usd"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Laba</span>
                <span class="info-box-number">Rp. 57.000.000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
  
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-area"></i>
                Chart Pemasukan Bulanan
              </div>
              <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <canvas id="myAreaChart" width="3372" height="1010" class="chartjs-render-monitor" style="display: block; height: 505px; width: 1686px;"></canvas>
              </div>
              <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
          </div>
        </div>

        <div class="row">

          <div class="col-md-4">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-chart-pie"></i>
                Kategori Produk Terlaris
              </div>
              <div class="card-body">
                <canvas id="myPieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <div class="card-footer small text-muted">
                Updated yesterday at 11:59 PM
              </div>
            </div>
          </div>

          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Produk Baru</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">

                  @php
                      $nomor = 1;
                  @endphp

                  @foreach ($produk_terbaru as $p)
                    <li class="item">
                      <div class="product-img">
                        {{ $nomor++.'.' }}
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">{{ $p->nama_barang }}
                          <span class="badge badge-success float-right">{{ $p->stok }}</span></a>
                      </div>
                    </li>
                  @endforeach
                  
                  <!-- /.item -->
                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                <a href="{{ route('product') }}" class="uppercase">View All Products</a>
              </div>
              <!-- /.card-footer -->
            </div>
          </div>
        
        </div>

        {{-- <div class="row">
          <table class="table table-bordered">
            <thead>                  
              <tr class="text-center">
                <th>Data 1</th>
                <th>Data 2</th>
              </tr>
            </thead>
            <tbody>
            @foreach($jml_sales as $dt)
              <tr>
                <td>{{ $dt->nama_kat }}</td>
                <td>{{ $dt->kat_terlaris }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div> --}}

      </div>

    </section>
    <!-- /.content -->

    <!-- PAGE SCRIPT FOR DASHBOARD -->
<!-- <script src="adminlte/js/pages/dashboard.js"></script> -->
  @endsection

@section('dashboardjs')

<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

  // Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
    datasets: [{
      label: "Total Pemasukan",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data: [
        @foreach($total as $t)
          {{ $t }},
        @endforeach()
        // 3200000, {{ $total }}, 2750000, 3000000, 6500000, 6000000
      ]
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 12
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 100000000,
          maxTicksLimit: 10
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        },
      }],
    },
    legend: {
      display: false
    },
    title: {
      display: true,
      text: '2019',
      fontSize : 30,
      fontStyle : 'bold',
    }
  }
});


// Pie Chart Example
// var ctx = document.getElementById("myPieChart");
// var myPieChart = new Chart(ctx, {
//   type: 'pie',
//   data: {
//     labels: ["Blue", "Red", "Yellow", "Green"],
//     datasets: [{
//       data: [12.21, 15.58, 11.25, 8.32],
//       backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
//     }],
//   },
// });

//pie
var ctxP = document.getElementById("myPieChart").getContext('2d');
var myPieChart = new Chart(ctxP, {
type: 'pie',
data: {
labels: [
  @foreach($jml_sales as $dt)
    "{{ $dt->nama_kat }}",
  @endforeach
],
datasets: [{
data: [
  @foreach($jml_sales as $dt)
    {{ $dt->kat_terlaris }},
  @endforeach
],
backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1"],
hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
}]
},
options: {
responsive: true
}
});

</script>

@endsection