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
                                <a href="/transfer/create" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i> Tambah {{ $title }} Baru
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped table-hover table-sm" id="datatable">
                                <thead class="bg-primary">
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Pelanggan</th>
                                        <th>Nama Barang</th>
                                        <th>Total</th>
                                        <th>Keterangan</th>
                                        <th>Tanggal</th>
                                        <th>Bukti</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($transfer as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->pelanggan->nama }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ number_format($item->total, 0, ',', '.') }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <a href="{{ asset('bukti_transfer/' . $item->bukti) }}" target="_blank">
                                                <img src="{{ asset('bukti_transfer/' . $item->bukti) }}" width="80">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/transfer/{{ $item->id }}/edit"
                                                class="btn btn-warning text-white btn-sm"><i class="fas fa-edit"></i>
                                                Edit</a>
                                            <a href="/transfer/{{ $item->id }}/destroy"
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