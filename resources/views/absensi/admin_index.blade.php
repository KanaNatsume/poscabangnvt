@extends('template.layout')

@section('konten')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $title }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title m-0">Rekap Harian</h3>
                            <div class="card-tools d-flex align-items-center ml-auto">
                                <form action="/absensi" method="GET" class="form-inline m-0 mr-3">
                                    <label class="mr-2">Tanggal:</label>
                                    <input type="date" name="tanggal" class="form-control form-control-sm mr-2" value="{{ $tanggal }}">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i> Tampilkan</button>
                                </form>
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalTambah">
                                    <i class="fas fa-plus"></i> Tambah Manual
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0 table-responsive">
                            <table class="table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Karyawan</th>
                                        <th>Role</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Status</th>
                                        <th>Lokasi Masuk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($absensi as $key => $absen)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td class="text-left">{{ $absen->user->name ?? '-' }}</td>
                                        <td><span class="badge badge-info">{{ ucfirst($absen->user->role ?? '-') }}</span></td>
                                        <td>{{ $absen->jam_masuk ?? '-' }}</td>
                                        <td>{{ $absen->jam_pulang ?? '-' }}</td>
                                        <td>
                                            @if($absen->status == 'hadir')
                                                <span class="badge badge-success">Hadir</span>
                                            @elseif($absen->status == 'libur')
                                                <span class="badge badge-danger">Libur</span>
                                            @else
                                                <span class="badge badge-secondary">{{ ucfirst($absen->status) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($absen->lat_long_masuk)
                                                <a href="https://www.google.com/maps?q={{ $absen->lat_long_masuk }}" target="_blank" class="btn btn-xs btn-outline-info">
                                                    <i class="fas fa-map-marker-alt"></i> Cek Peta
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm text-white btnEdit" 
                                                data-id="{{ $absen->id }}" 
                                                data-user_id="{{ $absen->user_id }}" 
                                                data-tanggal="{{ $absen->tanggal }}" 
                                                data-jam_masuk="{{ $absen->jam_masuk }}" 
                                                data-jam_pulang="{{ $absen->jam_pulang }}" 
                                                data-status="{{ $absen->status }}" 
                                                data-keterangan="{{ $absen->keterangan }}"
                                                data-toggle="modal" data-target="#modalEdit">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <a href="/absensi/destroy/{{ $absen->id }}" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">Tidak ada data absensi di tanggal ini.</td>
                                    </tr>
                                    @endforelse
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
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tambah Manual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/absensi/store" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Karyawan</label>
                        <select name="user_id" class="form-control" required>
                            <option value="">Pilih Karyawan</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }} ({{ ucfirst($u->role) }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ $tanggal }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Jam Masuk</label>
                            <input type="time" step="1" name="jam_masuk" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Jam Pulang</label>
                            <input type="time" step="1" name="jam_pulang" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status Kehadiran</label>
                        <select name="status" class="form-control" required>
                            <option value="hadir">Hadir</option>
                            <option value="libur">Libur/Alpa</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Keterangan Tambahan</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="Contoh: Sakit demam berdarah">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="formEdit">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Karyawan</label>
                        <select name="user_id" id="edit_user_id" class="form-control" required>
                            <option value="">Pilih Karyawan</option>
                            @foreach($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }} ({{ ucfirst($u->role) }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" id="edit_tanggal" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Jam Masuk</label>
                            <input type="time" step="1" name="jam_masuk" id="edit_jam_masuk" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Jam Pulang</label>
                            <input type="time" step="1" name="jam_pulang" id="edit_jam_pulang" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status Kehadiran</label>
                        <select name="status" id="edit_status" class="form-control" required>
                            <option value="hadir">Hadir</option>
                            <option value="libur">Libur/Alpa</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Keterangan Tambahan</label>
                        <input type="text" name="keterangan" id="edit_keterangan" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll('.btnEdit');
        editButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEdit').action = '/absensi/update/' + id;
                document.getElementById('edit_user_id').value = this.getAttribute('data-user_id');
                document.getElementById('edit_tanggal').value = this.getAttribute('data-tanggal');
                document.getElementById('edit_jam_masuk').value = this.getAttribute('data-jam_masuk');
                document.getElementById('edit_jam_pulang').value = this.getAttribute('data-jam_pulang');
                document.getElementById('edit_status').value = this.getAttribute('data-status');
                document.getElementById('edit_keterangan').value = this.getAttribute('data-keterangan');
            });
        });
    });
</script>

@if (session('success'))
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                icon: 'success',
                title: "{{ session('success') }}"
            });
        });
    </script>
@endif

@endsection
