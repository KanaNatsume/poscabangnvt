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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title m-0">Data Buku Kas</h3>
                            <div class="card-tools d-flex align-items-center ml-auto">
                                <form action="/pengeluaran" method="GET" class="form-inline mr-3 mb-0">
                                    <select name="bulan" class="form-control form-control-sm mr-2">
                                        @for($m=1; $m<=12; $m++)
                                            <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}" {{ $bulan == str_pad($m, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                            </option>
                                        @endfor
                                    </select>
                                    <select name="tahun" class="form-control form-control-sm mr-2">
                                        @for($y=date('Y')-3; $y<=date('Y'); $y++)
                                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Filter</button>
                                </form>
                                <a href="/pengeluaran/tambah/{{ no_pengeluaran() }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Tambah Baru
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm text-center mb-0" style="white-space: nowrap;">
                                <thead>
                                    <tr class="text-center">
                                        <th colspan="10" style="font-size: 1.1rem;" class="border-bottom">{{ date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun)) }}</th>
                                    </tr>
                                    <tr class="text-center text-muted">
                                        <th rowspan="2" class="align-middle" style="width:3%;">Tgl</th>
                                        <th colspan="3">Pemasukan</th>
                                        <th colspan="3">Pengeluaran</th>
                                        <th rowspan="2" class="align-middle">Jumlah Pemasukan</th>
                                        <th rowspan="2" class="align-middle">Jumlah Pengeluaran</th>
                                        <th rowspan="2" class="align-middle">Total</th>
                                    </tr>
                                    <tr class="text-center text-muted">
                                        <th>Nama Transaksi</th>
                                        <th>Harga</th>
                                        <th>Kategori</th>
                                        <th>Nama Transaksi</th>
                                        <th>Harga</th>
                                        <th>Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $grand_net = 0; @endphp
                                    @forelse($grouped as $tgl => $data)
                                        @php
                                            $countIn = count($data['pemasukan']);
                                            $countOut = count($data['pengeluaran']);
                                            $maxRows = max($countIn, $countOut);
                                            if($maxRows == 0) $maxRows = 1;
                                            
                                            $sumIn = collect($data['pemasukan'])->sum('jumlah');
                                            $sumOut = collect($data['pengeluaran'])->sum('jumlah');
                                            $total = $sumIn - $sumOut;
                                            $grand_net += $total;
                                        @endphp
                                        
                                        @for($i = 0; $i < $maxRows; $i++)
                                            <tr>
                                                @if($i == 0)
                                                    <td rowspan="{{ $maxRows }}" class="align-middle font-weight-bold text-center" style="font-size: 1.1rem;">{{ date('d', strtotime($tgl)) }}</td>
                                                @endif
                                                
                                                <!-- Pemasukan -->
                                                @if(isset($data['pemasukan'][$i]))
                                                    <td class="text-left" style="min-width:150px;">
                                                        <strong>{{ $data['pemasukan'][$i]->nama }}</strong>
                                                        @if(!empty($data['pemasukan'][$i]->keterangan) && $data['pemasukan'][$i]->keterangan != '-')
                                                            <br><small class="text-muted">{{ $data['pemasukan'][$i]->keterangan }}</small>
                                                        @endif
                                                    </td>
                                                    <td class="text-right">Rp {{ number_format($data['pemasukan'][$i]->jumlah, 0, ',', '.') }}</td>
                                                    <td>
                                                        {{ $data['pemasukan'][$i]->kategori_pengeluaran ?? '-' }}
                                                        <a href="/pengeluaran/hapus/{{ $data['pemasukan'][$i]->id }}" class="text-danger float-right ml-2" onclick="return confirm('Hapus baris ini?')" title="Hapus"><i class="fas fa-times"></i></a>
                                                        <a href="/pengeluaran/edit/{{ $data['pemasukan'][$i]->id }}" class="text-primary float-right" title="Edit"><i class="fas fa-edit"></i></a>
                                                    </td>
                                                @else
                                                    <td></td><td></td><td></td>
                                                @endif
                                                
                                                <!-- Pengeluaran -->
                                                @if(isset($data['pengeluaran'][$i]))
                                                    <td class="text-left" style="min-width:150px;">
                                                        <strong>{{ $data['pengeluaran'][$i]->nama }}</strong>
                                                        @if(!empty($data['pengeluaran'][$i]->keterangan) && $data['pengeluaran'][$i]->keterangan != '-')
                                                            <br><small class="text-muted">{{ $data['pengeluaran'][$i]->keterangan }}</small>
                                                        @endif
                                                    </td>
                                                    <td class="text-right">Rp {{ number_format($data['pengeluaran'][$i]->jumlah, 0, ',', '.') }}</td>
                                                    <td>
                                                        {{ $data['pengeluaran'][$i]->kategori_pengeluaran ?? '-' }}
                                                        <a href="/pengeluaran/hapus/{{ $data['pengeluaran'][$i]->id }}" class="text-danger float-right ml-2" onclick="return confirm('Hapus baris ini?')" title="Hapus"><i class="fas fa-times"></i></a>
                                                        <a href="/pengeluaran/edit/{{ $data['pengeluaran'][$i]->id }}" class="text-primary float-right" title="Edit"><i class="fas fa-edit"></i></a>
                                                    </td>
                                                @else
                                                    <td></td><td></td><td></td>
                                                @endif
                                                
                                                @if($i == 0)
                                                    <td rowspan="{{ $maxRows }}" class="align-middle text-right text-success font-weight-bold">
                                                        {{ $sumIn > 0 ? 'Rp ' . number_format($sumIn, 0, ',', '.') : '' }}
                                                    </td>
                                                    <td rowspan="{{ $maxRows }}" class="align-middle text-right text-danger font-weight-bold">
                                                        {{ $sumOut > 0 ? 'Rp ' . number_format($sumOut, 0, ',', '.') : '' }}
                                                    </td>
                                                    <td rowspan="{{ $maxRows }}" class="align-middle text-right font-weight-bold" style="font-size: 1.1rem;">
                                                        Rp {{ number_format($total, 0, ',', '.') }}
                                                    </td>
                                                @endif
                                            </tr>
                                        @endfor
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center py-4">Belum ada data keuangan di bulan ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr class="font-weight-bold text-center">
                                        <th colspan="7" class="text-right">GRAND TOTAL {{ strtoupper(date('F Y', mktime(0, 0, 0, $bulan, 1, $tahun))) }}</th>
                                        <th class="text-right text-success">Rp {{ number_format($total_pemasukan_bulan, 0, ',', '.') }}</th>
                                        <th class="text-right text-danger">Rp {{ number_format($total_pengeluaran_bulan, 0, ',', '.') }}</th>
                                        <th class="text-right" style="font-size: 1.2rem;">Rp {{ number_format($grand_net, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Summary per Kategori --}}
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title text-muted font-weight-bold"><i class="fas fa-chart-pie mr-2 text-primary"></i>Ringkasan Saldo Keuangan per Kategori</h3>
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