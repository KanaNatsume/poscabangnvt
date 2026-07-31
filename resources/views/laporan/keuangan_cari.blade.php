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
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Tanggal : {{ $tanggal_awal1 }} Sampai {{ $tanggal_akhir1 }}</strong>
                                </div>
                                <div class="col-md-6">
                                    <form action="/laporan/keuangan_download" method="post" target="_blank">
                                        @csrf
                                        <input type="hidden" name="tanggal_awal" value="{{ $tanggal_awal2 }}">
                                        <input type="hidden" name="tanggal_akhir" value="{{ $tanggal_akhir2 }}">
                                        <button type="submit" class="btn btn-success float-right"><i class="fas fa-file-pdf"></i> Download PDF</button>
                                    </form>
                                </div>
                            </div>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="harian-tab" data-toggle="tab" data-target="#harian" type="button" role="tab">Tampilan Harian</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="bulanan-tab" data-toggle="tab" data-target="#bulanan" type="button" role="tab">Tampilan Bulanan</button>
                                </li>
                            </ul>
                            
                            <div class="tab-content" id="myTabContent">
                                <!-- TAB HARIAN -->
                                <div class="tab-pane fade show active pt-3" id="harian" role="tabpanel">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Tanggal</th>
                                                <th class="text-success">Pemasukan (Omzet)</th>
                                                <th class="text-danger">Pengeluaran</th>
                                                <th>Keuntungan Bersih</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($daily as $date => $data)
                                            <tr>
                                                <td>{{ date('d-m-Y', strtotime($date)) }}</td>
                                                <td>Rp {{ number_format($data['pemasukan'], 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
                                                <th>Rp {{ number_format($data['pemasukan'] - $data['pengeluaran'], 0, ',', '.') }}</th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="bg-secondary text-white">
                                            <tr>
                                                <th>GRAND TOTAL</th>
                                                <th>Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</th>
                                                <th>Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</th>
                                                <th>Rp {{ number_format($total_pemasukan - $total_pengeluaran, 0, ',', '.') }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <!-- TAB BULANAN -->
                                <div class="tab-pane fade pt-3" id="bulanan" role="tabpanel">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Bulan</th>
                                                <th class="text-success">Pemasukan (Omzet)</th>
                                                <th class="text-danger">Pengeluaran</th>
                                                <th>Keuntungan Bersih</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($monthly as $month => $data)
                                            <tr>
                                                <td>{{ date('F Y', strtotime($month . '-01')) }}</td>
                                                <td>Rp {{ number_format($data['pemasukan'], 0, ',', '.') }}</td>
                                                <td>Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
                                                <th>Rp {{ number_format($data['pemasukan'] - $data['pengeluaran'], 0, ',', '.') }}</th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot class="bg-secondary text-white">
                                            <tr>
                                                <th>GRAND TOTAL</th>
                                                <th>Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</th>
                                                <th>Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</th>
                                                <th>Rp {{ number_format($total_pemasukan - $total_pengeluaran, 0, ',', '.') }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
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