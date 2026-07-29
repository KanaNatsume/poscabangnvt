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
                            <h3 class="card-title">Tambah Data {{ $title }}</h3>
                        </div>
                        <form action="/barang/update/{{ $barang->id }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kode_barang">Kode Barang</label>
                                            <input type="text" name="kode_barang" class="form-control" id="kode_barang"
                                                value="{{ $barang->kode_barang }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang</label>
                                            <input type="text" name="nama_barang" class="form-control" id="nama_barang"
                                                value="{{ $barang->nama_barang }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kategori_id">Kategori</label>
                                            <select name="kategori_id" id="kategori_id" class="form-control">
                                                @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $barang->kategori_id == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="harga_beli">Harga Beli</label>
                                            <input type="text" name="harga_beli" class="form-control" id="harga_beli"
                                                value="{{ $barang->harga_beli }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="harga_ecer">Harga Ecer</label>
                                            <input type="text" name="harga_ecer" class="form-control" id="harga_ecer"
                                                value="{{ $barang->harga_ecer }}" onkeyup="kalkulasi()" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="harga_grosir">Harga Grosir</label>
                                            <input type="text" name="harga_grosir" id="harga_grosir"
                                                onkeyup="kalkulasi()" class="form-control" id="harga_grosir"
                                                value="{{ $barang->harga_grosir }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="harga_agen">Harga Agen</label>
                                            <input type="text" name="harga_agen" class="form-control" id="harga_agen"
                                                onkeyup="kalkulasi()" value="{{ $barang->harga_agen }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="profit_harga_ecer">Profit Harga Ecer</label>
                                            <input type="text" name="profit_harga_ecer" class="form-control"
                                                id="profit_harga_ecer" value="{{ $barang->profit_harga_ecer }}" readonly
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="profit_harga_grosir">Profit Harga Grosir</label>
                                            <input type="text" name="profit_harga_grosir" class="form-control"
                                                id="profit_harga_grosir" readonly
                                                value="{{ $barang->profit_harga_grosir }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="profit_harga_agen">Profit Harga Agen</label>
                                            <input type="text" name="profit_harga_agen" class="form-control"
                                                id="profit_harga_agen" value="{{ $barang->profit_harga_agen }}" readonly
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <input type="text" name="deskripsi" class="form-control" id="deskripsi"
                                                value="{{ $barang->deskripsi }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="/barang" class="btn btn-light">kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function kalkulasi() {
        let harga_beli = document.getElementById('harga_beli').value;
        let harga_ecer = document.getElementById('harga_ecer').value;
        let harga_grosir = document.getElementById('harga_grosir').value;
        let harga_agen = document.getElementById('harga_agen').value;
        let profit_harga_ecer = document.getElementById('profit_harga_ecer');
        let profit_harga_grosir = document.getElementById('profit_harga_grosir');
        let profit_harga_agen = document.getElementById('profit_harga_agen');

        // profit.value = parseInt(harga_jual) - parseInt(harga_beli);
        profit_harga_ecer.value = parseInt(harga_ecer) - parseInt(harga_beli);
        profit_harga_grosir.value = parseInt(harga_grosir) - parseInt(harga_beli);
        profit_harga_agen.value = parseInt(harga_agen) - parseInt(harga_beli);
    }
</script>
@endsection