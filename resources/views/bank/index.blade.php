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
                            <h3 class="card-title">{{ $title }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#modalTambah">
                                    <i class="fas fa-plus"></i> Tambah Bank Baru
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover table-sm" id="datatable">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Bank</th>
                                        <th>No Rekening</th>
                                        <th>Atas Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($bank as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->nama_bank }}</td>
                                        <td>{{ $item->no_rekening }}</td>
                                        <td>{{ $item->atas_nama }}</td>
                                        <td style="width: 20%;">
                                            <button type="button" id="btn_edit" data-id="{{ $item->id }}"
                                                data-nama_bank="{{ $item->nama_bank }}" 
                                                data-no_rekening="{{ $item->no_rekening }}"
                                                data-atas_nama="{{ $item->atas_nama }}"
                                                class="btn btn-warning text-white btn-sm" data-toggle="modal"
                                                data-target="#modal_edit"><i class="fas fa-edit"></i>
                                                Edit</button>
                                            <a href="/bank/{{ $item->id }}/destroy"
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

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/bank" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama_bank">Nama Bank</label>
                        <input type="text" name="nama_bank" class="form-control form-control-sm" id="nama_bank" placeholder="Contoh: BCA, MANDIRI" required>
                    </div>
                    <div class="form-group">
                        <label for="no_rekening">No Rekening</label>
                        <input type="text" name="no_rekening" class="form-control form-control-sm" id="no_rekening" required>
                    </div>
                    <div class="form-group">
                        <label for="atas_nama">Atas Nama</label>
                        <input type="text" name="atas_nama" class="form-control form-control-sm" id="atas_nama" required>
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

<!-- Modal Edit -->
<div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit {{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form_edit">
                    @csrf
                    <div class="form-group">
                        <label for="edit_nama_bank">Nama Bank</label>
                        <input type="text" name="edit_nama_bank" class="form-control form-control-sm" id="edit_nama_bank"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="edit_no_rekening">No Rekening</label>
                        <input type="text" name="edit_no_rekening" class="form-control form-control-sm" id="edit_no_rekening" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_atas_nama">Atas Nama</label>
                        <input type="text" name="edit_atas_nama" class="form-control form-control-sm" id="edit_atas_nama" required>
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
    $(document).on('click', '#btn_edit', function() {
        let id_bank = $(this).data('id');
        let nama_bank = $(this).data('nama_bank');
        let no_rekening = $(this).data('no_rekening');
        let atas_nama = $(this).data('atas_nama');

        $('#form_edit').attr('action', '/bank/'+id_bank+'/update');
        $('#edit_nama_bank').val(nama_bank);
        $('#edit_no_rekening').val(no_rekening);
        $('#edit_atas_nama').val(atas_nama);
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
