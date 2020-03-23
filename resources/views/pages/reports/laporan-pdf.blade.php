<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PDF</title>

  <!-- Bootstrap CSS Min -->
  {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> --}}
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <style>
		table tr td,
		table tr th{
			font-size: 10pt;
		}
	</style>

</head>
<body>
  
  <center>
		<h2>Laporan Penjualan</h2>
  </center>
  
  <br>
  <br>

  <p style="font-size:11pt"><b>Dicetak Pada</b> : {{ date("d-m-Y") }}</p>
  <p style="font-size:11pt"><b>Laporan Penjualan Pada</b> : {{ $dari?? '' }} <i>s/d</i> {{ $ke?? '' }}</p>
  
	<table class="table table-bordered table-sm">
		<thead>
			<tr class="text-center">
				<th style="width:50px">No</th>
				<th>Invoice</th>
				<th>Tanggal</th>
				<th>Customer</th>
				<th>Sub Total</th>
			</tr>
		</thead>
		<tbody>
      @php 
      
        $i=1;
        $total_hrg=0;

        // foreach ($data as $key => $value) {
        //   $total_hrg += $value;
        // }

      @endphp
			@foreach($data as $d)
			<tr>
				<td class="text-center">{{ $i++ }}</td>
        <td>{{ $d->id_invoice }}</td>
				<td>{{ $d->created_at }}</td>
        <td class="text-center">{{ $d->nama_customer }}</td>
        <td>Rp. {{ $d->total }}</td>

        <div hidden>{{ $total_hrg += $d->total }}</div>
        
			</tr>
      @endforeach
      <tr>
        <td class="text-center font-weight-bold" scope="col" colspan="4">Total</td>
        <td>Rp. {{ $total_hrg }} </td>
      </tr>
		</tbody>
	</table>
</body>
</html>