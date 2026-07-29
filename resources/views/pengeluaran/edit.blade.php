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
                        <form action="/pengeluaran/update/{{ $pengeluaran->id }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="no_pengeluaran">No Transaksi</label>
                                    <input type="text" name="no_pengeluaran" class="form-control form-control-sm"
                                        id="no_pengeluaran" value="{{ $pengeluaran->no_pengeluaran }}" readonly
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control form-control-sm" id="tanggal"
                                        value="{{ $pengeluaran->tanggal ?? date('Y-m-d', strtotime($pengeluaran->created_at)) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Jenis Transaksi</label>
                                    <select name="jenis" id="jenis" class="form-control form-control-sm" required>
                                        <option value="">-- Pilih Jenis --</option>
                                        <option value="Pemasukan" {{ $pengeluaran->jenis == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                        <option value="Pengeluaran" {{ $pengeluaran->jenis == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Transaksi</label>
                                    <input type="text" name="nama" class="form-control form-control-sm" id="nama"
                                        value="{{ $pengeluaran->nama }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Biaya</label>
                                    <input type="text" class="form-control form-control-sm" id="jumlah"
                                        value="{{ $pengeluaran->jumlah }}" required>
                                    <input type="hidden" name="jumlah" id="jumlah1" value="{{ $pengeluaran->jumlah }}">
                                </div>
                                <div class="form-group">
                                    <label for="kategori_pengeluaran">Kategori</label>
                                    <select name="kategori_pengeluaran" id="kategori_pengeluaran" class="form-control form-control-sm" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach(['Toko','Kesra','Penjualan','Pembelian','Service','A Kevin','Kantor','Sisa'] as $kat)
                                        <option value="{{ $kat }}" {{ $pengeluaran->kategori_pengeluaran == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control form-control-sm"
                                        id="keterangan" value="{{ $pengeluaran->keterangan }}" required>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                <a href="/pengeluaran" class="btn btn-light btn-sm">kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $('#jumlah').on('keyup', function () {
        $(this).mask('000.000.000', {reverse: true});
        let jumlah1 = $(this).val().split('.');
        $('#jumlah1').val(jumlah1.join(""));
    })
</script>
@endsection