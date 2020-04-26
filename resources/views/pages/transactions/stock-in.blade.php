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
  
    <div class="container-fluid">

        @php
          $no = 1;
          $tgl = date('d-m-y');
          $tgl2 = date('dmy');
        @endphp
      {{-- <div class="row">

        <div class="col-md-4">
          <table class="table table-sm table-borderless">
            <tbody>
              <tr>
                <td scope="row">Tanggal</td>
                <td>:</td>
                <td>{{ $tgl }}</td>
              </tr>
              <tr>
                <td scope="row">Kasir</td>
                <td>:</td>
                <td>{{ Auth::user()->name }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col-md-4 -->

        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <table class="table table-sm table-borderless">
                <form name="formProduk" id="formProduk">
                  <tbody>
                    <tr>
                      <th scope="row"><label for="nama_barang"><span style="color:red;">*</span>Pilih Produk</label></th>
                      <td>
                        <select class="form-control custom-select" name="nama_barang" id="nama_barang" required>
                          <option selected>Pilih</option>
                          
                          @foreach ($dt_barang as $dt)
                            <option value="{{ $dt->nama_barang }}">{{ $dt->nama_barang }}</option>
                          @endforeach

                        </select>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row"><label for="jumlah"><span style="color:red;">*</span>Jumlah</label></th>
                      <td><input type="number" name="jumlah" class="form-control" id="jumlah" placeholder="Masukan Jumlah Produk" required></td>
                    </tr>
                    <tr>
                      <th scope="row"></th>
                      <td class="text-right"><button type="reset" class="btn btn-primary" role="button" onclick='terimaInput()'>Masukan Keranjang</button></td>
                    </tr>
                  </tbody>
                </form>
              </table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col-md-8 -->

      </div>
      <!-- /.row --> --}}

      <div class="row">
        <div class="col-md-12">
          @include('partials.alerts')
          <div class="card">

            <div class="card-header">
              <div class="col-6">
                <table class="table table-sm table-borderless">
                  <tbody>
                    <tr>
                      <th scope="row"><label for="tanggal">Tanggal</label></th>
                      <td>
                        <input type="text" name="tanggal" class="form-control" id="tanggal" value="{{ $tgl }}" disabled>
                        <input type="text" name="waktu" id="waktu" value="{{$tgl2}}" hidden>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row"><label for="nama_user">Kasir</label></th>
                      <td>
                        <input type="text" name="nama_user" class="form-control" id="nama_user" value="{{ Auth::user()->name }}" disabled>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row"><label for="">Nama Suplier</label></th>
                      <td>
                        <select class="custom-select" name="suplier" id="supplierSelect" onchange="myFunction()">
                          <option selected value="12">Pilih</option>
                          @foreach ($data_suplier as $dt)
                            <option value="{{ $dt->id_suplier }}">{{ $dt->nama_suplier}}</option>
                          @endforeach
                        </select>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <form class="form-horizontal" name="formProduk" id="formProduk">

              <div class="card-body">
  
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nama_barang"><span style="color:red;">*</span>Nama Produk</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="harga_beli"><span style="color:red;">*</span>Harga Beli</label>
                    <input type="number" class="form-control" id="harga_beli" name="harga_beli">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="jumlah_barang"><span style="color:red;">*</span>Jumlah Barang</label>
                    <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="number" class="form-control" id="harga_jual" name="harga_jual">
                  </div>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer text-right">
                <button type="reset" class="btn btn-info" role="button" onclick='terimaInput()'>Masukan</button>
              </div>
              <!--/.card-footer -->

            </form>
            <!--/.form -->
            
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col-12 -->

        {{-- <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              
              <div class="form-group row">
                <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama_produk" placeholder="Masukan Nama Produk">
                </div>
              </div>
              <div class="form-group row">
                <label for="harga_beli" class="col-sm-2 col-form-label">Harga Beli</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="harga_beli" placeholder="Masukan Harga Satuan">
                </div>
              </div>
              <div class="form-group row">
                <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="harga_jual" placeholder="Masukan Harga Jual Satuan">
                </div>
              </div>
              <div class="form-group row">
                <label for="jumlah_barang" class="col-sm-2 col-form-label">Jumlah Barang</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="jumlah_barang" placeholder="Masukan Jumlah Barang Masuk">
                </div>
              </div>

            </div>
          </div>
        </div> --}}
        
      </div>
      <!--/.row -->

      <div class="row">
        <div class="col-sm-12">
          
          <div class="card">

            <div class="card-header">
              <h4>Keranjang</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-4">

                  <p>Supplier : <span id="suppInfo"></span></p> 
                  <p>Invoice : <span id="invInfo"></span></p> 
          
                  
                </div>
              </div>
              
              <div class="row">
                <div class="col-sm-12">
                  <table class="table table-sm table-bordered text-center">
                    <thead>
                      <tr role="row" class="text-center">
                        <th style="width: 50px">No</th>
                        <th>Nama Produk</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th style="width: 60px">Jumlah</th>
                        <th>Opsi</th>
                      </tr>
                    </thead>
    
                    <tbody id="keranjang">
    
                    </tbody>
    
                  </table>

                  <form action="{{ route('stockin.input.data') }}" method="post" name="finalForm" id="finalForm" hidden>
                    @csrf
                    <div id="finalDataInput">
                      <input type="text" name="invoice" value="" id="inv">
                      <input type="number" name="kd_user" value="{{ Auth::user()->id }}" id="kd_usr">
                      <input type="text" name="kode_supp" value="" id="kd_supp">
                    </div>
                  </form>
                </div>
              </div>

            </div>

            <div class="card-footer text-right">
                <button type="submit" form="finalForm" class="btn btn-primary" role="button">Simpan</button>
            </div>

          </div>

        </div>
      </div>

    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection

@section('stockinjs')

<script>

  // Variabel support
  var no, id, passing;
  var test, kd_supp, kd_urutan, noUr_max;
  var noUr = [];

  // Variabel untuk di passing
  var total;

  if (typeof no == 'undefined') {
    no = 0;
  }

  function terimaInput() {
    var nama_barang = document.forms['formProduk']['nama_barang'].value;
    var harga_beli = document.forms['formProduk']['harga_beli'].value;
    var harga_jual = document.forms['formProduk']['harga_jual'].value;
    var jumlah_barang = document.forms['formProduk']['jumlah_barang'].value;
    
    no = no + 1;

    var tabel_keranjang = document.getElementById("keranjang");
    var rowIndex = no - 1;
    var row = tabel_keranjang.insertRow(rowIndex);
    var cellNo = row.insertCell(0);
    var cellNamaBarang = row.insertCell(1);
    var cellHargaBeli = row.insertCell(2);
    var cellHargaJual = row.insertCell(3);
    var cellJumlahBarang = row.insertCell(4);
    var cellAksi = row.insertCell(5);

    var aksi = "<button class='btn btn-danger btn-sm' role='button' onclick='hapusRow("+rowIndex+");'>x</button>"; 
    
    cellNo.innerHTML = no;
    cellNamaBarang.innerHTML = nama_barang;
    cellHargaBeli.innerHTML = harga_beli;
    cellHargaJual.innerHTML = harga_jual;
    cellJumlahBarang.innerHTML = jumlah_barang;
    cellAksi.innerHTML = aksi;

    /* Simpan kedalam table data Keranjang */
    var brTag = document.createElement("br"); 
    var checkData1 = document.createElement("input");
    checkData1.setAttribute("type", "checkbox");
    checkData1.setAttribute("name", "nama_barang[]");
    checkData1.setAttribute("value", nama_barang);
    checkData1.checked = true;

    var checkData2 = document.createElement("input");
    checkData2.setAttribute("type", "checkbox");
    checkData2.setAttribute("name", "harga_beli[]");
    checkData2.setAttribute("value", harga_beli);
    checkData2.checked = true;

    var checkData3 = document.createElement("input");
    checkData3.setAttribute("type", "checkbox");
    checkData3.setAttribute("name", "harga_jual[]");
    checkData3.setAttribute("value", harga_jual);
    checkData3.checked = true;

    var checkData4 = document.createElement("input");
    checkData4.setAttribute("type", "checkbox");
    checkData4.setAttribute("name", "jumlah_barang[]");
    checkData4.setAttribute("value", jumlah_barang);
    checkData4.checked = true;

    var wadah = document.getElementById("finalDataInput");

    wadah.appendChild(checkData1);
    wadah.appendChild(checkData2);
    wadah.appendChild(checkData3);
    wadah.appendChild(checkData4);
    wadah.appendChild(brTag);

  }

  function hapusRow(id) {
    document.getElementById('keranjang').deleteRow(id);
    document.getElementById('simpanDataCart').deleteRow(id);
  }

  function myFunction() {
    var supplier = document.getElementById("supplierSelect");
    var x = supplier.options[supplier.selectedIndex].text;
    if (x != "Pilih") {
      document.getElementById("suppInfo").innerHTML = x;   

      /* Membuat Kode Invoice */
      var kd1 = 2;
      var kd2 = document.getElementById("kd_usr").value;
      var kd3 = document.getElementById("supplierSelect").value;
      var kd4 = document.getElementById("waktu").value;

      @if( !$dt_urutan_inv->isEmpty() )

        @foreach($dt_urutan_inv as $dt)
          {{ $dtcek = $dt->id_invoice }}
          kd_supp = "{{ substr($dtcek, 2, 3) }}";
          kd_urutan = {{ substr($dtcek, -3, 3) }}

          if (parseInt(kd_supp) == kd3) {
            noUr.push(kd_urutan);
          }
          
        @endforeach

        if (noUr.length > 0) {
          noUr_max = Math.max(...noUr);
          noUr = [];
        } else {
          noUr_max = 0;
        }

      @else

        noUr_max = 0;

      @endif
      
      if (kd3 > 9 && kd3 < 100) {
        kd3 = "0" + kd3;
      } else if (kd3 > 0 && kd3 < 10) {
        kd3 = "00" + kd3
      }

      var dataUr = noUr_max + 1;

      if ( dataUr > 9 && dataUr < 100 ) {
        var kd5 = '0' + dataUr;  
      } else if ( dataUr > 99 ) {
        var kd5 = dataUr;
      } else {
        var kd5 = '00' + dataUr;
      }

      var invKode = kd1 + kd2 + kd3 + kd4 + kd5;
      var cekHiddenInv = document.getElementById("invInfo").value;

      document.getElementById("invInfo").innerHTML = invKode;
      document.getElementById("inv").value = invKode;
      document.getElementById("kd_supp").value = kd3;
    
    } else {
      document.getElementById("suppInfo").innerHTML = '';
      document.getElementById("invInfo").innerHTML = '';

      document.getElementById("inv").value = '';
      document.getElementById("kd_supp").value = '';
    }

  }

</script>
    
@endsection