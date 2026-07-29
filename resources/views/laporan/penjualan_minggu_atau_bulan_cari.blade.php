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
                            <form action="/laporan/penjualan_minggu_atau_bulan_cari" method="get">
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
                                        <a href="/laporan/penjualan_minggu_atau_bulan"
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
                                    <form action="/laporan/penjualan_minggu_atau_bulan_download" method="post" target="
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
                                        <th>No Invoice</th>
                                        <th>Pelanggan</th>
                                        <th>Jenis Pembayaran</th>
                                        <th>Nama Bank</th>
                                        <th>Bukti Transfer</th>
                                        <th>Total Pembayaran</th>
                                        <th>Biaya Pengiriman</th>
                                        <th>Sub Total</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    $total_pendapatan = 0;
                                    @endphp
                                    @foreach ($penjualan as $item)
                                    @php
                                    $total_pendapatan += $item->sub_total;
                                    @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><a href="/laporan/detail_penjualan/{{ $item->no_invoice }}"
                                                target="_blank">{{ $item->no_invoice }}</a></td>
                                        @if ($item->pelanggan_id == '')
                                        <td></td>
                                        @else
                                        <td>{{ $item->pelanggan->nama }}</td>
                                        @endif
                                        <td>{{ ucfirst($item->jenis) }}</td>
                                        <td>{{ $item->jenis_bank }}</td>
                                        @if ($item->bukti_transfer == '')
                                        <td></td>
                                        @else
                                        <td>
                                            <a href="{{ asset('bukti_transfer/' . $item->bukti_transfer) }}"
                                                target="_blank">
                                                <img src="{{ asset('bukti_transfer/' . $item->bukti_transfer) }}"
                                                    width="50">
                                            </a>
                                        </td>
                                        @endif
                                        <td>{{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                                        <td>{{ number_format($item->biaya_pengiriman, 0, ',', '.') }}</td>
                                        <td>{{ number_format($item->sub_total, 0, ',', '.') }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="9" align="center"><strong>Total Pendapatan</strong></td>
                                        <td>{{ number_format($total_pendapatan, 0, ',', '.') }}</td>
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