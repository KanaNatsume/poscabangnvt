@extends('template.layout')

@section('konten')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan {{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Laporan {{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="/laporan/keuangan_cari" method="get">
                                <div class="row">
                                    <div class="col-md-1">
                                        <label>Pilih Tanggal</label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="date" name="tanggal_awal" class="form-control form-control-sm"
                                                id="tanggal_awal" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="date" name="tanggal_akhir" class="form-control form-control-sm"
                                                id="tanggal_akhir" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Cari</button>
                                        <a href="/laporan/keuangan" class="btn btn-primary">Refresh</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Silakan pilih rentang tanggal untuk menampilkan data keuangan.
                            </div>
                            <table class="table table-bordered table-hover mt-3">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Tanggal / Bulan</th>
                                        <th class="text-success">Pemasukan (Omzet)</th>
                                        <th class="text-danger">Pengeluaran</th>
                                        <th>Keuntungan Bersih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Data tidak tersedia. Lakukan pencarian terlebih dahulu.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@if (session('success'))
<script type="text/javascript">
    $(function() {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      Toast.fire({
          icon: 'success',
          title: "{{ session('success') }}"
        })
    });  
</script>
@endif
@endsection