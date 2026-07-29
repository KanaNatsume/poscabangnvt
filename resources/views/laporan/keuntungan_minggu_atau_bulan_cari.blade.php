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
                            <form action="/laporan/keuntungan_minggu_atau_bulan_cari" method="get">
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
                                        <a href="/laporan/keuntungan_minggu_atau_bulan"
                                            class="btn btn-primary">Refresh</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Tanggal : {{ $tanggal_awal1 }} Sampai {{ $tanggal_akhir1 }}</strong>
                                </div>
                                <div class="col-md-6">
                                    <form action="/laporan/keuntungan_minggu_atau_bulan_download" method="post" target="
                                    _blank">
                                        @csrf
                                        <input type="hidden" name="tanggal_awal" value="{{ $tanggal_awal2 }}">
                                        <input type="hidden" name="tanggal_akhir" value="{{ $tanggal_akhir2 }}">
                                        <button type="submit" class="btn btn-success float-right">Download PDF</button>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped table-hover table-sm mt-2">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis Penjualan</th>
                                        <th>Harga</th>
                                        <th>QTY</th>
                                        <th>Profit</th>
                                        <th>Potongan</th>
                                        <th>Keuntungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    $total_keuntungan = 0;
                                    @endphp
                                    @foreach ($detail_penjualan as $item)
                                    @php
                                    $keuntungan = $item->qty * $item->profit - $item->potongan;
                                    $total_keuntungan += $keuntungan;
                                    @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->kode_barang }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ strtoupper($item->jenis) }}</td>
                                        <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ number_format($item->profit, 0, ',', '.') }}</td>
                                        <td>{{ number_format($item->potongan, 0, ',', '.') }}</td>
                                        <td>{{ number_format($keuntungan, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="9" align="center"><strong>Total Keuntungan</strong></td>
                                        <td>{{ number_format($total_keuntungan, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p><strong>Rumus Keuntungan :</strong> QTY X Profit - Potongan</p>
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