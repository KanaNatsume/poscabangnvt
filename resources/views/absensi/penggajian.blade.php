@extends('template.layout')

@section('konten')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $title }}</h1>
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
                            <h3 class="card-title m-0">
                                Periode: <strong>{{ date('d M Y', strtotime($start_date)) }} - {{ date('d M Y', strtotime($end_date)) }}</strong>
                                <span class="badge badge-info ml-2">Total: {{ $total_hari_periode }} Hari</span>
                            </h3>
                            <div class="card-tools d-flex align-items-center ml-auto">
                                <form action="/penggajian" method="GET" class="form-inline m-0">
                                    <label class="mr-2">Bulan Tagihan:</label>
                                    <select name="bulan" class="form-control form-control-sm mr-2">
                                        @for($m=1; $m<=12; $m++)
                                            <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}" {{ $bulan == str_pad($m, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                            </option>
                                        @endfor
                                    </select>
                                    <select name="tahun" class="form-control form-control-sm mr-2">
                                        @for($y=date('Y')-2; $y<=date('Y'); $y++)
                                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Hitung Gaji</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0 table-responsive">
                            <table class="table table-bordered table-striped table-hover text-center align-middle">
                                <thead>
                                    <tr class="bg-light">
                                        <th rowspan="2" class="align-middle">No</th>
                                        <th rowspan="2" class="align-middle">Nama Karyawan</th>
                                        <th rowspan="2" class="align-middle">Role</th>
                                        <th colspan="2">Rekap Kehadiran</th>
                                        <th colspan="3">Perhitungan Gaji</th>
                                    </tr>
                                    <tr class="bg-light">
                                        <th>Hadir</th>
                                        <th>Libur/Alpa</th>
                                        <th>Gaji Pokok (30 Hr)</th>
                                        <th>Potongan Libur (>3 Hr)</th>
                                        <th class="bg-success text-white">Gaji Bersih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data_penggajian as $key => $row)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td class="text-left font-weight-bold">{{ $row['user']->name }}</td>
                                        <td>{{ ucfirst($row['user']->role) }}</td>
                                        <td class="text-success font-weight-bold">{{ $row['hadir'] }} Hari</td>
                                        <td>
                                            @if($row['libur'] > 3)
                                                <span class="text-danger font-weight-bold">{{ $row['libur'] }} Hari</span>
                                                <br><small class="text-danger">(Lebih {{ $row['kelebihan_libur'] }} hari)</small>
                                            @else
                                                <span class="text-dark">{{ $row['libur'] }} Hari</span>
                                            @endif
                                        </td>
                                        <td class="text-right">Rp {{ number_format($row['gaji_pokok'], 0, ',', '.') }}</td>
                                        <td class="text-right text-danger">
                                            {{ $row['potongan'] > 0 ? '- Rp ' . number_format($row['potongan'], 0, ',', '.') : '-' }}
                                        </td>
                                        <td class="text-right font-weight-bold" style="font-size: 1.1rem; background-color: rgba(40, 167, 69, 0.1);">
                                            Rp {{ number_format($row['gaji_bersih'], 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">Belum ada data karyawan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="p-3 text-muted small">
                                <i class="fas fa-info-circle text-info"></i> <strong>Catatan:</strong> Potongan dihitung jika jumlah libur melewati 3 hari dalam periode (Tgl 23 bulan sebelumnya s/d Tgl 22 bulan ini). Potongan per hari dihitung dari (Gaji Pokok / 30).
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
