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
                            <h3 class="card-title">Data {{ $title }} Piutang</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover table-sm" id="datatable">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>No Invoice</th>
                                        <th>Sub Total</th>
                                        <th>Sisa Hutang</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($hutang as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        @if ($item->pelanggan_id == '')
                                        <td></td>
                                        @else
                                        <td>{{ $item->pelanggan->nama }}</td>
                                        @endif
                                        <td>{{ $item->no_invoice }}</td>
                                        <td>{{ number_format($item->sub_total, 0, ',', '.') }}</td>
                                        @php
                                        $total_hutang = $item->sub_total - $item->pembayaran;
                                        @endphp
                                        <td>{{ number_format($total_hutang, 0, ',', '.') }}</td>
                                        <td>{{ tanggal_indonesia(date('d-m-Y', strtotime($item->created_at))) }}</td>
                                        <td>
                                            @if ($item->status == 0)
                                            <span class="badge badge-pill badge-dark">Belum Lunas</span>
                                            @else
                                            <span class="badge badge-pill badge-success">Sudah Lunas</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="/hutang/detail/{{ $item->id }}" class="btn btn-secondary btn-sm"
                                                target="_blank">
                                                <i class="fas fa-paper-plane"></i> Detail
                                            </a>
                                            <a href="/hutang/{{ $item->id }}/edit"
                                                class="btn btn-warning text-white btn-sm"><i class="fas fa-edit"></i>
                                                Edit</a>
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