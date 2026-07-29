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
                                <h3 class="card-title">Tambah {{ $title }} Baru</h3>
                            </div>
                            <form action="/barang/update/{{ $barang->id }}" method="POST">
                                @method('put')
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="kode_barang">Kode Barang</label>
                                                <input type="text" name="kode_barang"
                                                    class="form-control form-control-sm" id="kode_barang"
                                                    value="{{ old('kode_barang') == '' ? $barang->kode_barang : old('kode_barang') }}"
                                                    required>
                                                @error('kode_barang')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nama_barang">Nama Barang</label>
                                                <input type="text" name="nama_barang"
                                                    class="form-control form-control-sm" id="nama_barang"
                                                    value="{{ old('nama_barang') == '' ? $barang->nama_barang : old('nama_barang') }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="is_jasa">Tipe Item</label>
                                                <select name="is_jasa" id="is_jasa" class="form-control form-control-sm">
                                                    <option value="0" {{ $barang->is_jasa == 0 ? 'selected' : '' }}>Barang Fisik</option>
                                                    <option value="1" {{ $barang->is_jasa == 1 ? 'selected' : '' }}>Jasa / Servis</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="kategori_id">Kategori</label>
                                                <select name="kategori_id" id="kategori_id"
                                                    class="form-control form-control-sm">
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
                                                <input type="text" class="form-control form-control-sm" id="harga_beli"
                                                    autocomplete="off"
                                                    value="{{ old('harga_beli') == '' ? $barang->harga_beli : old('harga_beli') }}"
                                                    required>
                                                <input type="hidden" name="harga_beli" id="harga_beli1"
                                                    value="{{ old('harga_beli') == '' ? $barang->harga_beli : old('harga_beli') }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="harga_ecer">Harga Jual</label>
                                                <input type="text" class="form-control form-control-sm" id="harga_ecer"
                                                    autocomplete="off"
                                                    value="{{ old('harga_ecer') == '' ? $barang->harga_ecer : old('harga_ecer') }}"
                                                    required>
                                                <input type="hidden" name="harga_ecer" id="harga_ecer1"
                                                    value="{{ old('harga_ecer') == '' ? $barang->harga_ecer : old('harga_ecer') }}"
                                                    required>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="profit_harga_ecer">Profit Harga Jual</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="profit_harga_ecer"
                                                    value="{{ old('profit_harga_ecer') == '' ? $barang->profit_harga_ecer : old('profit_harga_ecer') }}"
                                                    readonly required>
                                                <input type="hidden" name="profit_harga_ecer" id="profit_harga_ecer1"
                                                    value="{{ old('profit_harga_ecer') == '' ? $barang->profit_harga_ecer : old('profit_harga_ecer') }}"
                                                    readonly required>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="deskripsi">Deskripsi</label>
                                                <input type="text" name="deskripsi"
                                                    class="form-control form-control-sm"
                                                    value="{{ old('deskripsi') == '' ? $barang->deskripsi : old('deskripsi') }}"
                                                    id="deskripsi">
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="wadah_stok1">
                                            <div class="form-group">
                                                <label for="stok">Stok</label>
                                                <input type="text" name="stok" class="form-control form-control-sm"
                                                    value="{{ old('stok') == '' ? $barang->stok : old('stok') }}"
                                                    id="stok">
                                            </div>
                                        </div>
                                        <div class="col-md-4" id="wadah_stok2">
                                            <div class="form-group">
                                                <label for="stok_minimal">Minimal Stok</label>
                                                <input type="text" name="stok_minimal"
                                                    class="form-control form-control-sm"
                                                    value="{{ old('stok_minimal') == '' ? $barang->stok_minimal : old('stok_minimal') }}"
                                                    id="stok_minimal">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                    <a href="/barang" class="btn btn-light btn-sm">kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        $('#harga_beli').on('keyup', function() {
            $(this).mask('000.000.000', {
                reverse: true
            });
            let harga_beli1 = $(this).val().split('.');
            $('#harga_beli1').val(harga_beli1.join(""));
        })

        $('#harga_ecer').on('keyup', function() {
            $(this).mask('000.000.000', {
                reverse: true
            });
            let harga_ecer1 = $(this).val().split('.');
            $('#harga_ecer1').val(harga_ecer1.join(""));

            let harga_beli1 = document.getElementById('harga_beli1').value;
            let harga_ecer2 = document.getElementById('harga_ecer1').value;
            let profit_harga_ecer = document.getElementById('profit_harga_ecer');
            let profit_harga_ecer1 = document.getElementById('profit_harga_ecer1');

            hasil = parseInt(harga_ecer2) - parseInt(harga_beli1);
            profit_harga_ecer.value = parseInt(hasil).toLocaleString('id-ID');
            profit_harga_ecer1.value = hasil;
        })

        $('#is_jasa').on('change', function() {
            if ($(this).val() == '1') {
                $('#wadah_stok1, #wadah_stok2').hide();
                $('#stok').removeAttr('required').val('0');
                $('#stok_minimal').removeAttr('required').val('0');
            } else {
                $('#wadah_stok1, #wadah_stok2').show();
            }
        });
        if ($('#is_jasa').val() == '1') {
            $('#is_jasa').trigger('change');
        }
    </script>
@endsection
