@extends('template.layout')
@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
                            <h3 class="card-title">Laporan {{ $title }}</h3>
                        </div>
                        <div class="card-body">
                            <form action="/laporan/produk_terjual_cari" method="get" target="_blank">
                                <div class="form-group">
                                    <label for="kode_barang">Kode Barang</label>
                                    <input type="text" name="kode_barang" id="kode_barang" placeholder="Kode Barang" class="form-control" autocomplete="off" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_awal">Dari Tanggal</label>
                                    <input type="date" name="tanggal_awal"
                                        class="form-control form-control-sm" id="tanggal_awal" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_akhir">Sampai Tanggal</label>
                                    <input type="date" name="tanggal_akhir"
                                        class="form-control form-control-sm" id="tanggal_akhir" required>
                                </div>
                                <button type="submit" class="btn btn-secondary btn-sm"><i
                                        class="fas fa-eye"></i> View</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    var _token = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){        
        $( "#kode_barang" ).autocomplete({
        source: function( request, response ) {
            // Fetch data
            $.ajax({
            url:"/ambil_data_barang",
            type: 'post',
            dataType: "json",
            data: {
            _token: _token,
            search: request.term
            },
            success: function( data ) {
            console.log(data);
            response( data );
            }
            });
        },
            select: function (event, ui) {
                $('#kode_barang').val(ui.item.label); // display the selected text
                $('#stok').val(ui.item.stok); // save selected id to input
                $('#harga_ecer').val(ui.item.harga_ecer + ",ecer"); // save selected id to input
                $('#harga_ecer').text("Ecer - Rp " + parseInt(ui.item.harga_ecer).toLocaleString("id-ID"))
                $('#harga_grosir').val(ui.item.harga_grosir + ",grosir"); // save selected id to input
                $('#harga_grosir').text("Grosir - Rp "  + parseInt(ui.item.harga_grosir).toLocaleString("id-ID"))
                $('#harga_agen').val(ui.item.harga_agen + ",agen"); // save selected id to input
                $('#harga_agen').text("Agen - Rp " + parseInt(ui.item.harga_agen).toLocaleString("id-ID"))
                return false;
            }
        });
    });
</script>
@endsection