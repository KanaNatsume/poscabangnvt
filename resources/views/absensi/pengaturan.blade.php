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
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Koordinat Lokasi Toko</h3>
                        </div>
                        <form action="/pengaturan-absensi" method="POST">
                            @csrf
                            <div class="card-body">
                                <p class="text-muted text-sm">Gunakan fitur <strong>Get Current Location</strong> saat Anda berada di toko untuk mendapatkan titik kordinat secara akurat.</p>
                                
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" name="latitude" class="form-control" id="latitude" value="{{ $pengaturan->latitude }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" name="longitude" class="form-control" id="longitude" value="{{ $pengaturan->longitude }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="radius">Radius Diizinkan (Meter)</label>
                                    <input type="number" name="radius" class="form-control" id="radius" value="{{ $pengaturan->radius }}" required>
                                    <small class="form-text text-muted">Jarak maksimal karyawan bisa melakukan absen dari titik kordinat (rekomendasi: 50-100 meter).</small>
                                </div>
                                
                                <button type="button" class="btn btn-info btn-sm mt-2" onclick="getLocation()">
                                    <i class="fas fa-map-marker-alt"></i> Dapatkan Lokasi Saat Ini
                                </button>
                                <p id="geo-status" class="text-success mt-2 font-weight-bold" style="display: none;">Lokasi berhasil didapatkan!</p>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError, {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        });
    } else {
        alert("Geolocation tidak didukung oleh browser Anda.");
    }
}

function showPosition(position) {
    document.getElementById("latitude").value = position.coords.latitude;
    document.getElementById("longitude").value = position.coords.longitude;
    document.getElementById("geo-status").style.display = 'block';
    setTimeout(() => {
        document.getElementById("geo-status").style.display = 'none';
    }, 3000);
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("Anda menolak akses ke lokasi. Mohon izinkan akses lokasi di browser Anda.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Informasi lokasi tidak tersedia.");
            break;
        case error.TIMEOUT:
            alert("Permintaan lokasi melebihi batas waktu (timeout).");
            break;
        case error.UNKNOWN_ERROR:
            alert("Terjadi kesalahan yang tidak diketahui.");
            break;
    }
}
</script>
@endsection
