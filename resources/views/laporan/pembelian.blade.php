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
                                <h3 class="card-title">Laporan {{ $title }}</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Semua Data</th>
                                        <td><a href="/laporan/pembelian/semua" class="btn btn-secondary btn-sm"
                                                target="_blank"><i class="fas fa-eye"></i>
                                                View</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Pertanggal</th>
                                        <td>
                                            <form action="/laporan/pembelian/pertanggal" method="get" target="_blank">
                                                <div class="form-group">
                                                    <label for="tanggal_awal">Dari Tanggal</label>
                                                    <input type="date" name="tanggal_awal"
                                                        class="form-control form-control-sm" id="tanggal_awal" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tanggal_akhir">Sampai Tanggal</label>
                                                    <input type="date" name="tanggal_akhir"
                                                        class="form-control form-control-sm" id="tanggal_akhir" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="supplier">Supplier</label>
                                                    <select name="supplier" id="" class="form-control" required>
                                                        <option selected disabled>Pilih Supplier</option>
                                                        @foreach ($supplier as $suppliers)
                                                            <option value="{{ $suppliers->id }}">{{ $suppliers->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-secondary btn-sm"><i
                                                        class="fas fa-eye"></i> View</button>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
