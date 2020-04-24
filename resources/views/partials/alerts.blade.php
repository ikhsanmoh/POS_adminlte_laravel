<!-- Transaction Alerts -->
@if (session('input-success'))
  <div id="message" class="col-md-4">
    <div class="card bg-ligt">
      <div class="card-body text-center">
        <div style="font-size: 0,5rem; color:#38c95f">
          <i class="fas fa-check fa-6x" aria-hidden="true"></i>
        </div>
        <div>
          <h4>{{ session('input-success') }}</h4>
        </div>

      </div>
    </div>
  </div>
@endif

@if (session('input-error'))
  <div id="message" class="col-md-4">
    <div class="card bg-ligt">
      <div class="card-body text-center">
        <div style="font-size: 0,5rem; color:#d94d43">
          <i class="fas fa-times fa-6x" aria-hidden="true"></i>
        </div>
        <div>
          <h4>{{session('input-error')}}</h4>
        </div>

      </div>
    </div>
  </div>
@endif

@if (session('input-stockin-success'))
  <div id="message" class="alert alert-success" role="alert">
    <i class="fas fa-check"></i>{{ session('input-stockin-success') }}
  </div>
@endif

@if (session('input-stockin-error'))
<div id="message" class="alert alert-danger" role="alert">
  <i class="fas fa-times"></i>{{ seesion('input-stockin-error') }}
</div>
@endif

<!-- Supliers, Customers, Users Alerts -->
@if (session('tambah-success'))
  <div id="message" class="alert alert-success" role="alert">
    <i class="fas fa-check"></i>{{ session('tambah-success') }} Berhasil Ditambahkan
  </div>
@endif

@if (session('tambah-error'))
<div id="message" class="alert alert-danger" role="alert">
  <i class="fas fa-times"></i>{{ seesion('tambah-error') }} Gagal Ditambahkan
</div>
@endif

@if (session('edit-success'))
  <div id="message" class="alert alert-success" role="alert">
    <i class="fas fa-check"></i>{{ session('edit-success') }} Berhasil Diperbaharui
  </div>
@endif

@if (session('edit-error'))
  <div id="message" class="alert alert-danger" role="alert">
    <i class="fas fa-times"></i>{{ seesion('edit-error') }} Gagal Diperbaharui
  </div>
@endif

@if (session('hapus-success'))
  <div id="message" class="alert alert-warning" role="alert">
    <i class="fas fa-check"></i>{{ session('hapus-success') }} Berhasil Dihapus
  </div>
@endif

@if (session('hapus-error'))
  <div id="message" class="alert alert-danger" role="alert">
    <i class="fas fa-times"></i>{{ seesion('hapus-error') }} Gagal Dihapus
  </div>
@endif