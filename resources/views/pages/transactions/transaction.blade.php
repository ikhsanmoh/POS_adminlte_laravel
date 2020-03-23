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
            $tgl2 = date('dmyhis');
          @endphp

          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <table class="table table-sm table-borderless">
                  <tbody>
                    <tr>
                      <th scope="row"><label for="tanggal">Tanggal</label></th>
                      <td><input type="text" name="tanggal" class="form-control" id="tanggal" value="{{ $tgl }}" disabled></td>
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

        {{-- <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="input-trans" class="btn btn-primary" role="button" title="Tambah Data"><i class="fas fa-plus"></i> Tambah</a>
                <a href="trash" class="btn btn-secondary" role="button" title="Tempat Sampah"><i class="fas fa-recycle"></i></a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table-trans1" class="table table-sm table-bordered table-striped">
                  <thead>
                    <tr role="row" class="text-center">
                      <th style="width: 30px">No</th>
                      <th>Nama Barang</th>
                      <th>Harga Satuan</th>
                      <th style="width: 60px">Jumlah</th>
                      <th>Sub Total</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if($transDt->isEmpty())
                    <tr>
                      <td colspan="7" class="text-center"><h3>Data Kosong</h3></td>
                    </tr>
                  @else
                    @foreach($transDt as $dt)
                      <tr role="row" class="odd">
                        <td class="text-center">{{ $no++ }}</td>
                        <td>{{ $dt->nama_barang }}</td>
                        <td>Rp. {{ $dt->harga_satuan }}</td>
                        <td class="text-center">{{ $dt->jml_barang }}</td>
                        <td>Rp. {{ $dt->total_harga }}</td>
                        <td class="text-center">
                        <a href="trans-edit{{ $dt->id_transaksi }}" class="btn btn-success" role="button" title="Rubah Transaksi"><i class="far fa-edit"></i></a>
                        <a href="trans-hapus{{ $dt->id_transaksi }}" class="btn btn-danger" role="button" title="Hapus Data"><i class="far fa-trash-alt"></i></a>
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
            <!-- /.card -->
          </div>
          <!-- /.col-12 -->
        </div> --}}
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
{{-- 
                  @if($transDt->isEmpty())
                    <tr>
                      <td colspan="7" class="text-center"><h3>Data Kosong</h3></td>
                    </tr>
                  @else
                    @foreach($transDt as $dt)
                      <tr role="row" class="odd">
                        <td class="text-center">{{ $no++ }}</td>
                        <td></td>
                        <td>{{ $dt->nama_barang }}</td>
                        <td>Rp. {{ $dt->harga_satuan }}</td>
                        <td class="text-center">{{ $dt->jml_barang }}</td>
                        <td>Rp. {{ $dt->total_harga }}</td>
                        <td class="text-center">
                        <a href="trans-edit{{ $dt->id_transaksi }}" class="btn btn-success" role="button" title="Rubah Transaksi"><i class="far fa-edit"></i></a>
                        <a href="trans-hapus{{ $dt->id_transaksi }}" class="btn btn-danger" role="button" title="Hapus Data"><i class="far fa-trash-alt"></i></a>
                        </td>
                      </tr>
                    @endforeach
                  @endif
                   --}}
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
                  <form action="{{ route('transaction.input.data') }}" method="post" id="formAkhir" name="formAkhir">
                    {{ csrf_field() }}
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
                        <input type="number" name="nama_user" value="{{ Auth::user()->id }}" id="nm_usr">
                        <input type="text" name="jenis_customer" value="" id="jn_cus">
                        <br>

                        {{-- <input type="checkbox" name="coba[]" id="box1">
                        <input type="checkbox" name="coba[]" id="box2"> --}}

                        {{-- <span id="simpanDataCart"></span> --}}
                        {{-- <tbody id="simpanDataCart">
                          <tr>
                            <td><input type="checkbox" name="coba[]" value="coba 1" checked></td>
                            <td><input type="checkbox" name="coba[]" value="coba 2" checked></td>
                          </tr>
                        </tbody> --}}
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

                {{-- <div class="tesData border p-2">
                  <p>{{$dt1??''}}</p>
                  <p>{{$dt2??''}}</p>
                  <p>{{$dt3??''}}</p>
                  <p>{{$dt4??''}}</p>
                  <p>{{$dt5??''}}</p>
                  <p>{{$dt6??''}}</p>

                  @if (!empty($dtArr1))
                    @foreach ($dtArr1 as $k => $v)
                      <p>{{$v}} || {{$dtArr2[$k]}}</p>  
                    @endforeach
                    {{$dtArr3}}
                  @endif

                </div> --}}

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @endsection
    
@section('transactionjs')
  
<script>
  // $(function () {
  //   $("#table-trans1").DataTable();
  // });

  // Variabel support
  var no, id, passing;
  
  // Variabel untuk di passing
  var total;

  // var funAktif = setInterval(aktif, 1000);
  // function aktif() {
  //   var getIdKeranjang = document.getElementById('kerajang');
  //   var jumlahDataKeranjang = getIdKeranjang.rows.length;
  // }

  if (typeof no == 'undefined') {
    no = 0;
    total = 0;
  }

  function terimaInput() {
    var kd_barang;
    var hrg_produk;
    var sub_total;
    var nm_barang = document.forms['formProduk']['nama_barang'].value;
    var jml_barang = document.forms['formProduk']['jumlah'].value;
    var ambil_id_input_total = document.getElementById('total_harga');

    @foreach($dt_barang as $dt)

      var find_id = {{$dt->id_barang}}
      var find_nama_barang = "{{$dt->nama_barang}}"
      var find_harga = {{$dt->harga_satuan}}

      if (find_nama_barang == nm_barang) {
        kd_barang = find_id;
        hrg_produk = find_harga;
        sub_total = find_harga*jml_barang;
      }
    @endforeach
    
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

    var kd1 = "INV";
    var kd2 = {{$tgl2}};
    var kd3 = document.getElementById("nm_usr").value;
    var kd4 = document.getElementById("customer").value;
    var invKode = kd1 + kd2 + kd3 + kd4;
    var cekHiddenInv = document.getElementById("inv").value;

    if (!cekHiddenInv) {
      document.getElementById("inv").value = invKode;
    }

    /* Memasukan Total Harga Barang */
    total = total + sub_total;
    document.getElementById('total_harga').value = total;

    /* Membuat data hidden value 1 */
    // var cekHiddenNmUser = document.getElementById('nm_usr').value;
    var cekHiddenJnCus = document.getElementById('jn_cus').value;
    var getValNamaUser = document.getElementById('nama_user').value;
    var getValJenisCus = document.getElementById('customer').value;

    // if (!cekHiddenNmUser) {
    //   document.getElementById('nm_usr').value = getValNamaUser;
    // }
    if (!cekHiddenJnCus) {
      document.getElementById('jn_cus').value = getValJenisCus;
    }
    
    /* Simpan kedalam table data Keranjang */
    // var selectTableHiddenData = document.getElementById('simpanDataCart');
    // var masukanData = selectTableHiddenData.insertRow(rowIndex);
    // masukanData.insertCell(0).innerHTML = "<input type='checkbox' name='id_barang[]' value='"+kd_barang+"' checked>";
    // masukanData.insertCell(1).innerHTML = "<input type='checkbox' name='jml_barang[]' value='"+jml_barang+"' checked>";

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

  } // Test
    // var box1 = document.getElementById("box1");
    // var box2 = document.getElementById("box2");
    // box1.setAttribute("value", "Box 1");
    // box2.setAttribute("value", "Box 2");

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