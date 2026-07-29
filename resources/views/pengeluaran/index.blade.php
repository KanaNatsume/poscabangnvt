@extends('template.layout')

@section('konten')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
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
                            <h3 class="card-title">Data {{ $title }}</h3>
                            <div class="card-tools">
                                <a href="/pengeluaran/tambah/{{ no_pengeluaran() }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i> Tambah {{ $title }} Baru
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped table-hover table-sm" id="datatable">
                                <thead class="bg-primary">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>No Transaksi</th>
                                        <th>Jenis</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($pengeluaran as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->no_pengeluaran }}</td>
                                        <td>
                                            @if($item->jenis == 'Pemasukan')
                                                <span class="badge badge-success">Pemasukan</span>
                                            @else
                                                <span class="badge badge-danger">Pengeluaran</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->nama }}</td>
                                        <td><span class="badge badge-info">{{ $item->kategori_pengeluaran ?? '-' }}</span></td>
                                        <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->tanggal ? date('d-m-Y', strtotime($item->tanggal)) : date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <a href="/pengeluaran/edit/{{ $item->id }}"
                                                class="btn btn-warning text-white btn-sm"><i class="fas fa-edit"></i>
                                                Edit</a>
                                            <a href="/pengeluaran/hapus/{{ $item->id }}"
                                                onclick="return confirm('Yakin mau dihapus?!')"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>
                                                Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Summary per Kategori --}}
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title"><i class="fas fa-chart-pie mr-2"></i>Ringkasan Saldo Keuangan per Kategori</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @php $grand_total = 0; @endphp
                                @foreach($kategori_list as $kat)
                                @php $grand_total += $total_per_kategori[$kat]; @endphp
                                <div class="col-md-3 col-sm-6 mb-3">
                                    <div class="info-box shadow-sm">
                                        <span class="info-box-icon bg-info"><i class="fas fa-wallet"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">{{ $kat }}</span>
                                            <span class="info-box-number">Rp {{ number_format($total_per_kategori[$kat], 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-md-12">
                                    <hr>
                                    <h5 class="text-right"><strong>Total Keseluruhan: Rp {{ number_format($grand_total, 0, ',', '.') }}</strong></h5>
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