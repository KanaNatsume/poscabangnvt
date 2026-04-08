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
            <div class="row">
                <div class="col-md-12">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-bullhorn"></i> Peringatan</h5>

                        <p>Pembelian barang yang sudah tersimpan tidak bisa diedit dan dihapus. Harap perhatikan data
                            yang akan ditambahkan sudah benar.</p>
                    </div>
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
                                <a href="/pembelian/create/{{ no_pembelian() }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i> Tambah {{ $title }} Baru
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped table-hover table-sm" id="datatable">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>No Pembelian</th>
                                        <th>Supplier</th>
                                        <th>Total Pembayaran</th>
                                        <th>Pembayaran</th>
                                        <th>Kembalian</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($detail_pembelian as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->no_pembelian }}</td>
                                        <td>{{ $item->supplier->nama }}</td>
                                        <td>{{ number_format($item->total_pembayaran, 0, ',', '.')  }}</td>
                                        <td>{{ number_format($item->pembayaran, 0, ',', '.') }}</td>
                                        <td>{{ number_format($item->kembalian, 0, ',', '.') }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <a href="/pembelian/detail/{{ $item->no_pembelian }}"
                                                class="btn btn-secondary text-white btn-sm" target="_blank"><i
                                                    class="fas fa-paper-plane"></i>
                                                Detail</a>
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