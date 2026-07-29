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
                                        <th style="width: 10px">#</th>
                                        <th>Nama</th>
                                        <th>No HP</th>
                                        <th>Email</th>
                                        <th>No Rekening</th>
                                        <th>Atas Nama Rekening</th>
                                        <th>Bank</th>
                                        <th>Kode POS</th>
                                        <th>Alamat</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($supplier as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->no_hp }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->no_rekening }}</td>
                                        <td>{{ $item->rekening_atas_nama }}</td>
                                        <td>{{ $item->bank }}</td>
                                        <td>{{ $item->kode_pos }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>
                                            <button type="button" id="btn_edit" data-id="{{ $item->id }}"
                                                data-nama="{{ $item->nama }}" data-no_hp="{{ $item->no_hp }}"
                                                data-email="{{ $item->email }}"
                                                data-no_rekening="{{ $item->no_rekening }}"
                                                data-rekening_atas_nama="{{ $item->rekening_atas_nama }}"
                                                data-bank="{{ $item->bank }}" data-kode_pos="{{ $item->kode_pos }}"
                                                data-alamat="{{ $item->alamat }}"
                                                data-deskripsi="{{ $item->deskripsi }}"
                                                class="btn btn-warning text-white btn-sm" data-toggle="modal"
                                                data-target="#modal_edit"><i class="fas fa-edit"></i>
                                                Edit</button>
                                            <a href="/supplier/{{ $item->id }}/destroy"
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

<!-- Modal -->
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
                <form action="/supplier" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Supplier</label>
                        <input type="text" name="nama" class="form-control form-control-sm" id="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No HP</label>
                        <input type="text" name="no_hp" class="form-control form-control-sm" id="no_hp" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control form-control-sm" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="no_rekening">No Rekening</label>
                        <input type="text" name="no_rekening" class="form-control form-control-sm" id="no_rekening"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="rekening_atas_nama">Atas Nama Rekening</label>
                        <input type="text" name="rekening_atas_nama" class="form-control form-control-sm"
                            id="rekening_atas_nama" required>
                    </div>
                    <div class="form-group">
                        <label for="bank">Bank</label>
                        <input type="text" name="bank" class="form-control form-control-sm" id="bank" required>
                    </div>
                    <div class="form-group">
                        <label for="kode_pos">Kode POS</label>
                        <input type="text" name="kode_pos" class="form-control form-control-sm" id="kode_pos" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control form-control-sm" id="alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control form-control-sm" id="deskripsi"
                            required>
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
                <form action="" method="post" id="formEdit">
                    @csrf
                    <div class="form-group">
                        <label for="edit_nama">Nama Supplier</label>
                        <input type="text" name="edit_nama" class="form-control form-control-sm" id="edit_nama"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="edit_no_hp">No HP</label>
                        <input type="text" name="edit_no_hp" class="form-control form-control-sm" id="edit_no_hp"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="edit_email">Email</label>
                        <input type="email" name="edit_email" class="form-control form-control-sm" id="edit_email"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="edit_no_rekening">No Rekening</label>
                        <input type="text" name="edit_no_rekening" class="form-control form-control-sm"
                            id="edit_no_rekening" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_rekening_atas_nama">Atas Nama Rekening</label>
                        <input type="text" name="edit_rekening_atas_nama" class="form-control form-control-sm"
                            id="edit_rekening_atas_nama" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_bank">Bank</label>
                        <input type="text" name="edit_bank" class="form-control form-control-sm" id="edit_bank"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="edit_kode_pos">Kode POS</label>
                        <input type="text" name="edit_kode_pos" class="form-control form-control-sm" id="edit_kode_pos"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="edit_alamat">Alamat</label>
                        <input type="text" name="edit_alamat" class="form-control form-control-sm" id="edit_alamat"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="edit_deskripsi">Deskripsi</label>
                        <input type="text" name="edit_deskripsi" class="form-control form-control-sm"
                            id="edit_deskripsi" required>
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
        let id_supplier = $(this).data('id');
        let nama = $(this).data('nama');
        let no_hp = $(this).data('no_hp');
        let email = $(this).data('email');
        let no_rekening = $(this).data('no_rekening');
        let rekening_atas_nama = $(this).data('rekening_atas_nama');
        let bank = $(this).data('bank');
        let kode_pos = $(this).data('kode_pos');
        let alamat = $(this).data('alamat');
        let deskripsi = $(this).data('deskripsi');

        $('#formEdit').attr('action', '/supplier/'+id_supplier+'/update');
        $('#edit_nama').val(nama);
        $('#edit_no_hp').val(no_hp);
        $('#edit_email').val(email);
        $('#edit_no_rekening').val(no_rekening);
        $('#edit_rekening_atas_nama').val(rekening_atas_nama);
        $('#edit_bank').val(bank);
        $('#edit_kode_pos').val(kode_pos);
        $('#edit_alamat').val(alamat);
        $('#edit_deskripsi').val(deskripsi);
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