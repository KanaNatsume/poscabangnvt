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
                            <h3 class="card-title">No Pengeluaran : <strong>{{ request()->segment(3) }}</strong></h3>
                        </div>
                        <form action="/pengeluaran" method="POST">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" name="no_pengeluaran" id="no_pengeluaran"
                                    value="{{ request()->segment(3) }}" required>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control form-control-sm" id="tanggal"
                                        value="{{ date('Y-m-d') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Pengeluaran</label>
                                    <input type="text" name="nama" class="form-control form-control-sm" id="nama"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Biaya</label>
                                    <input type="text" class="form-control form-control-sm" id="jumlah"
                                        autocomplete="off" required>
                                    <input type="hidden" name="jumlah" id="jumlah1" required>
                                </div>
                                <div class="form-group">
                                    <label for="kategori_pengeluaran">Kategori</label>
                                    <select name="kategori_pengeluaran" id="kategori_pengeluaran" class="form-control form-control-sm" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Toko">Toko</option>
                                        <option value="Kesra">Kesra</option>
                                        <option value="Penjualan">Penjualan</option>
                                        <option value="Pembelian">Pembelian</option>
                                        <option value="Service">Service</option>
                                        <option value="A Kevin">A Kevin</option>
                                        <option value="Kantor">Kantor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control form-control-sm"
                                        id="keterangan" required>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
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