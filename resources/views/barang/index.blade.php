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
                                    <a href="/barang/create" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i> Tambah {{ $title }} Baru
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped table-hover table-sm" id="datatable">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Tipe</th>
                                            <th>Kategori</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Profit Harga Jual</th>
                                            <th>Stok</th>
                                            <th>Terjual</th>
                                            <th>Minimal Stok</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($barang as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->kode_barang }}</td>
                                                <td>{{ $item->nama_barang }}</td>
                                                <td>
                                                    @if($item->is_jasa)
                                                        <span class="badge badge-info">Jasa / Servis</span>
                                                    @else
                                                        <span class="badge badge-secondary">Barang Fisik</span>
                                                    @endif
                                                </td>

                                                <td>{{ $item->kategori->nama }}</td>
                                                <td>{{ number_format($item->harga_beli, 0, ',', '.') }}</td>
                                                <td>{{ number_format($item->harga_ecer, 0, ',', '.') }}</td>
                                                <td>{{ number_format($item->profit_harga_ecer, 0, ',', '.') }}</td>
                                                <td>{{ $item->stok }}</td>
                                                <td>{{ $item->jumlah_terjual }}</td>
                                                <td>{{ $item->stok_minimal }}</td>
                                                <td>{{ $item->deskripsi }}</td>
                                                <td>
                                                    <a href="/barang/{{ $item->id }}/edit"
                                                        class="btn btn-warning text-white btn-sm"><i
                                                            class="fas fa-edit"></i>
                                                        Edit</a>
                                                    <a href="/barang/{{ $item->id }}/destroy"
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
