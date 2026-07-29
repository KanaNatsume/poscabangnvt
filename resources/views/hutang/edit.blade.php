@extends('template.layout')

@section('konten')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit {{ $title }}</h1>
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
                            <h3 class="card-title">No. Invoice : <strong>{{ $hutang->no_invoice }}</strong></h3>
                        </div>
                        <div class="card-body">
                            <form action="/hutang/update/{{ $hutang->id }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="sub_total">Total Hutang</label>
                                    <input type="hidden" name="no_invoice" value="{{ $hutang->no_invoice }}">
                                    @php
                                    $total_hutang = $hutang->sub_total - $hutang->pembayaran;
                                    @endphp
                                    <input type="text" class="form-control" id="sub_total"
                                        value="{{ number_format($total_hutang, 0, ',', '.') }}" readonly required>
                                    <input type="hidden" id="sub_total1" value="{{ $total_hutang }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="pembayaran">Pembayaran</label>
                                    <input type="text" class="form-control" id="pembayaran" autocomplete="off" autofocus
                                        onkeyup="kalkulasi()" required>
                                    <input type="hidden" name="pembayaran" id="pembayaran1" required>
                                </div>
                                <div class="form-group">
                                    <label for="sisa_hutang">Sisa Hutang</label>
                                    <input type="text" class="form-control" id="sisa_hutang" readonly required>
                                    <input type="hidden" name="sisa_hutang" id="sisa_hutang1"
                                        value="{{ $hutang->sisa_hutang }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="/hutang" class="btn btn-light">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(function () {  
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })  
    })

    $('#pembayaran').on('keyup', function () {
        $(this).mask('000.000.000', {reverse: true});
        let pembayaran1 = $(this).val().split('.');
        $('#pembayaran1').val(pembayaran1.join(""));
    })

    function kalkulasi() {
        let pembayaran = $('#pembayaran').val().split('.'); // 300.000 -> 300 0000
        let pembayaran1 = $('#pembayaran1').val(pembayaran.join("")); // 300.000 -> 300 0000

        let sub_total1 = $('#sub_total1').val();
        let hasil = sub_total1 - pembayaran1.val(); // 210000
        let convert = parseInt(hasil).toLocaleString("id-ID"); // 210.000

        $('#sisa_hutang').val(convert);
        $('#sisa_hutang1').val(hasil);
    }
</script>
@endsection