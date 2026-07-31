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
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-primary card-outline text-center">
                        <div class="card-body">
                            <h4>Halo, {{ auth()->user()->name }}</h4>
                            <p class="text-muted">{{ date('l, d F Y') }} <br> <span id="clock" class="font-weight-bold" style="font-size: 1.2rem;"></span></p>
                            
                            @if(isset($error_lokasi))
                                <div class="alert alert-warning">
                                    {{ $error_lokasi }}
                                </div>
                            @else
                                <div class="my-4">
                                    @if(!$absen_hari_ini)
                                        <!-- Belum absen masuk -->
                                        <div class="alert alert-info">Anda belum melakukan absen masuk hari ini.</div>
                                        <form action="/absensi/karyawan/absen" method="POST" id="form-absen">
                                            @csrf
                                            <input type="hidden" name="latitude" id="lat">
                                            <input type="hidden" name="longitude" id="long">
                                            <button type="button" class="btn btn-success btn-lg" onclick="getLocationAndSubmit()" id="btn-absen">
                                                <i class="fas fa-sign-in-alt"></i> ABSEN MASUK
                                            </button>
                                        </form>
                                    @elseif(empty($absen_hari_ini->jam_pulang))
                                        <!-- Sudah absen masuk, belum absen pulang -->
                                        <div class="alert alert-success">Anda sudah absen masuk pada jam <strong>{{ $absen_hari_ini->jam_masuk }}</strong>.</div>
                                        <form action="/absensi/karyawan/absen" method="POST" id="form-absen">
                                            @csrf
                                            <input type="hidden" name="latitude" id="lat">
                                            <input type="hidden" name="longitude" id="long">
                                            <button type="button" class="btn btn-danger btn-lg" onclick="getLocationAndSubmit()" id="btn-absen">
                                                <i class="fas fa-sign-out-alt"></i> ABSEN PULANG
                                            </button>
                                        </form>
                                    @else
                                        <!-- Sudah selesai absen -->
                                        <div class="alert alert-success">
                                            <strong>Selesai!</strong> Anda sudah menyelesaikan absensi hari ini.<br>
                                            Jam Masuk: {{ $absen_hari_ini->jam_masuk }} <br>
                                            Jam Pulang: {{ $absen_hari_ini->jam_pulang }}
                                        </div>
                                    @endif
                                </div>
                                <p id="geo-status" class="text-muted" style="display: none;"><i class="fas fa-spinner fa-spin"></i> Mendapatkan lokasi Anda...</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
// Jam digital
setInterval(() => {
    let date = new Date();
    document.getElementById('clock').innerHTML = date.toLocaleTimeString('en-GB');
}, 1000);

function getLocationAndSubmit() {
    let btn = document.getElementById('btn-absen');
    let status = document.getElementById('geo-status');
    
    btn.disabled = true;
    status.style.display = 'block';

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById("lat").value = position.coords.latitude;
            document.getElementById("long").value = position.coords.longitude;
            document.getElementById("form-absen").submit();
        }, function(error) {
            btn.disabled = false;
            status.style.display = 'none';
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert("Anda harus mengizinkan akses lokasi browser untuk bisa absen.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Informasi lokasi tidak tersedia.");
                    break;
                case error.TIMEOUT:
                    alert("Waktu permintaan lokasi habis (timeout).");
                    break;
                default:
                    alert("Terjadi kesalahan sistem saat mengambil lokasi.");
                    break;
            }
        }, {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        });
    } else {
        btn.disabled = false;
        status.style.display = 'none';
        alert("Browser Anda tidak mendukung deteksi lokasi (Geolocation).");
    }
}
</script>
@endsection
