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
                        <form action="/transfer/update/{{ $transfer->id }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="pelanggan_id">Pelanggan</label>
                                    <select name="pelanggan_id" id="pelanggan_id" class="form-control form-control-sm">
                                        @foreach ($pelanggan as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $transfer->pelanggan_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control form-control-sm" id="nama"
                                        value="{{ $transfer->nama }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="total">Total</label>
                                    <input type="text" name="total" class="form-control form-control-sm" id="total"
                                        value="{{ $transfer->total }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="bukti">Bukti</label>
                                    <input type="file" name="bukti" class="form-control form-control-sm" id="bukti">
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control form-control-sm"
                                        id="keterangan" value="{{ $transfer->keterangan }}" required>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                <a href="/transfer" class="btn btn-light btn-sm">kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection