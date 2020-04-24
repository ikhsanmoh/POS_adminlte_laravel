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

        <div class="row">

          @php
            $no = 1;
            $tgl = date('d-m-y');
            $tgl2 = date('dmy');
          @endphp

          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
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
                      <td><input type="text" name="nama_user" class="form-control" id="nama_user" value="{{ Auth::user()->name }}" disabled></td>
                    </tr>
                    <tr>
                      <th scope="row"><label for="customer"><span style="color:red;">*</span>Customer </label></th>
                      <td>
                        <select class="form-control custom-select" name="customer" id="customer" required>
                          
                          @foreach ($dt_customers as $dt)
                            <option value="{{ $dt->id_customer }}">{{ $dt->nama_customer }}</option>
                          @endforeach

                        </select>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
        <!-- /.row -->

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Keranjang</h4>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <table class="table table-sm table-bordered text-center">
                  <thead>
                    <tr role="row" class="text-center">
                      <th style="width: 50px">No</th>
                      <th style="width: 80px">Kode</th>
                      <th>Nama Produk</th>
                      <th>Harga Satuan</th>
                      <th style="width: 60px">Jumlah</th>
                      <th>Sub Total</th>
                      <th>Opsi</th>
                    </tr>
                  </thead>

                  <tbody id="keranjang">

                  </tbody>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-12 -->
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">

                <table class="table table-sm table-borderless">
                  <form action="{{ route('sales.input.data') }}" method="post" id="formAkhir" name="formAkhir">
                    @csrf
                    <tbody>
                      <tr>
                        <th scope="row"><label for="total">Total</label></th>
                        <td><input type="number" name="total_harga" class="form-control" id="total_harga" readonly></td>
                        
                      </tr>
                      <tr>
                        <th scope="row"><label for="tunai">Tunai</label></th>
                        <td><input type="number" name="tunai" class="form-control" id="tunai" placeholder="Masukan Jumlah Tunai" onkeyup="kurang();" required></td>
                      </tr>
                      <tr>
                        <th scope="row"><label for="kembali">Kembali</label></th>
                        <td><input type="number" name="kembalian" class="form-control" id="kembali" readonly></td>
                      </tr>
                      
                      
                      <div id="dataTersembunyi" hidden>
                        <input type="text" name="invoice" value="" id="inv">
                        <input type="number" name="kd_user" value="{{ Auth::user()->id }}" id="kd_usr">
                        <input type="text" name="jenis_customer" value="" id="jn_cus">
                        <br>
                      </div>

                      <tr>
                        <th scope="row"></th>
                        <td class="text-right">
                          <button type="button" class="btn btn-danger" onclick="window.location.reload();">Ulangi</button>&nbsp;&nbsp;
                          <button type="submit" class="btn btn-success">Simpan</button>
                        </td>
                      </tr>
                    </tbody>
                  </form>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          @include('partials.alerts')
        </div>

        @if (Session::has('stok-alert'))
          <div class="row">
            <div class="col-12">
              @include('partials.stock-alert')
            </div>
          </div>
        @endif
        
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @endsection
    
@section('transactionjs')
  
<script>

  // Variabel support
  var no, id, passing;
  
  // Variabel untuk di passing
  var total;

  if (typeof no == 'undefined') {
    no = 0;
    total = 0;
  }

  function terimaInput() {
    var kd_barang;
    var hrg_produk;
    var sub_total;
    var stok;
    var nm_barang = document.forms['formProduk']['nama_barang'].value;
    var jml_barang = document.forms['formProduk']['jumlah'].value;
    var ambil_id_input_total = document.getElementById('total_harga');

    @foreach($dt_barang as $dt)

      var find_id = {{$dt->id_barang}}
      var find_nama_barang = "{{$dt->nama_barang}}"
      var find_harga = {{$dt->harga_satuan}}
      var find_stok = {{$dt->stok}}

      if (find_nama_barang == nm_barang) {
        kd_barang = find_id;
        hrg_produk = find_harga;
        sub_total = find_harga*jml_barang;
        stok = find_stok;
      }
    @endforeach

    if (stok < jml_barang) {
      return alert("Jumlah Produk Yang Di Pesan Melebihi Stok Yang Tersedia Saat Ini !!!")
    }
    
    no = no + 1;

    var tabel_keranjang = document.getElementById("keranjang");
    var rowIndex = no - 1;
    var row = tabel_keranjang.insertRow(rowIndex);
    var cellNo = row.insertCell(0);
    var cellKodeProduk = row.insertCell(1);
    var cellNamaProduk = row.insertCell(2);
    var cellHargaSatuan = row.insertCell(3);
    var cellJumlahProduk = row.insertCell(4);
    var cellSubTotal = row.insertCell(5);
    var cellAksi = row.insertCell(6);

    var aksi = "<button class='btn btn-danger btn-sm' role='button' onclick='hapusRow("+rowIndex+");'>x</button>"; 
    
    cellNo.innerHTML = no;
    cellKodeProduk.innerHTML = kd_barang;
    cellNamaProduk.innerHTML = nm_barang;
    cellHargaSatuan.innerHTML = hrg_produk;
    cellJumlahProduk.innerHTML = jml_barang;
    cellSubTotal.innerHTML = sub_total;
    cellAksi.innerHTML = aksi;
    
    /* Membuat Kode Invoice (IN+tgl+id_usr+id_cus) */
    var kd1 = 1;
    var kd2 = document.getElementById("kd_usr").value;
    var kd3 = document.getElementById("customer").value;
    var kd4 = document.getElementById("waktu").value;
    var dataUr = {{ $dt_urutan_inv + 1}};

    if ( dataUr > 9 && dataUr < 100 ) {
      var kd5 = '0' + dataUr;  
    } else if ( dataUr > 99 ) {
      var kd5 = dataUr;
    } else {
      var kd5 = '00' + dataUr;
    }

    var invKode = kd1 + kd2 + kd3 + kd4 + kd5;
    var cekHiddenInv = document.getElementById("inv").value;

    if (!cekHiddenInv) {
      document.getElementById("inv").value = invKode;
    }

    /* Memasukan Total Harga Barang */
    total = total + sub_total;
    document.getElementById('total_harga').value = total;

    /* Membuat data hidden value 1 */
    var cekHiddenJnCus = document.getElementById('jn_cus').value;
    // var getValNamaUser = document.getElementById('nama_user').value;
    var getValJenisCus = document.getElementById('customer').value;

    if (!cekHiddenJnCus) {
      document.getElementById('jn_cus').value = getValJenisCus;
    }
    
    /* Simpan kedalam table data Keranjang */

    var brTag = document.createElement("br"); 
    var checkData1 = document.createElement("input");
    checkData1.setAttribute("type", "checkbox");
    checkData1.setAttribute("name", "id_barang[]");
    checkData1.setAttribute("value", kd_barang);
    checkData1.checked = true;


    var checkData2 = document.createElement("input");
    checkData2.setAttribute("type", "checkbox");
    checkData2.setAttribute("name", "jml_barang[]");
    checkData2.setAttribute("value", jml_barang);
    checkData2.checked = true;

    var wadah = document.getElementById("formAkhir");

    wadah.appendChild(checkData1);
    wadah.appendChild(checkData2);
    wadah.appendChild(brTag);

  }

  function kurang() {
    var tunai = document.getElementById('tunai').value;
    var kembalian = parseInt(tunai) - total;

    if ( !isNaN(kembalian) ) {
      document.getElementById('kembali').value = kembalian;
    }
    
  }

  function hapusRow(id) {
    document.getElementById('keranjang').deleteRow(id);
    document.getElementById('simpanDataCart').deleteRow(id);
  }

</script>

@endsection