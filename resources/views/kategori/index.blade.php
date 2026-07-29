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
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#modalTambah">
                                    <i class="fas fa-plus"></i> Tambah {{ $title }} Baru
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover table-sm" id="datatable">
                                <thead class="bg-primary">
                                    <tr>
                                        <th style="width: 10%">#</th>
                                        <th>Nama</th>
                                        <th>Total Beli</th>
                                        <th style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($kategori as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ number_format($item->total_beli) }}</td>
                                        <td>
                                            <button type="button" id="btnEdit" data-id="{{ $item->id }}"
                                                data-nama="{{ $item->nama }}" class="btn btn-warning text-white btn-sm"
                                                data-toggle="modal" data-target="#modalEdit"><i class="fas fa-edit"></i>
                                                Edit</button>
                                            <a href="/kategori/{{ $item->id }}/destroy"
                                                onclick="return confirm('Yakin mau dihapus?!')"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i>
                                                Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"><strong>Total</strong></td>
                                        <td colspan="2"><strong>{{ number_format($grandTotal) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/kategori" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Kategori</label>
                        <input type="text" name="nama" class="form-control form-control-sm" id="nama" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formEdit">
                    @csrf
                    <div class="form-group">
                        <label for="editNama">Nama Kategori</label>
                        <input type="text" name="editNama" class="form-control form-control-sm" id="editNama" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#btnEdit', function() {
        let id_kategori = $(this).data('id');
        let nama_kategori = $(this).data('nama');

        $('#formEdit').attr('action', '/kategori/'+id_kategori+'/update');
        $('#editNama').val(nama_kategori);
    });
</script>

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
