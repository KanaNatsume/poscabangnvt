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
                            <h3 class="card-title">No. Retur <strong>{{ request()->segment(3) }}</strong></h3>
                        </div>
                        <form action="/retur/detail_retur_barang" method="POST">
                            @csrf
                            <input type="hidden" name="no_retur" value="{{ request()->segment(3) }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="no_invoice">No Invoice</label>
                                            <select name="no_invoice" id="no_invoice"
                                                class="form-control form-control-sm select2bs4" required>
                                                <option value="">Pilih</option>
                                                @foreach ($penjualan as $item)
                                                <option value="{{ $item->no_invoice }}">{{ $item->no_invoice }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kode_barang">Pilih Barang</label>
                                            <select name="kode_barang" id="kode_barang"
                                                class="form-control form-control-sm select2bs4" required>
                                                <option value="">Pilih</option>
                                                @foreach ($barang as $item)
                                                <option value="{{ $item->kode_barang }}"
                                                    data-harga_ecer="{{ $item->harga_ecer }}"
                                                    data-harga_grosir="{{ $item->harga_grosir }}"
                                                    data-harga_agen="{{ $item->harga_agen }}">{{ $item->kode_barang }} -
                                                    {{ $item->nama_barang }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="harga">Pilih Jenis Harga</label>
                                        <select name="harga" id="harga" class="form-control select2bs4" required>
                                            <option value="">Pilih</option>
                                            <option value="" id="harga_ecer">
                                                Ecer <span id="harga_ecer1"> </span>
                                            </option>
                                            <option value="" id="harga_grosir">
                                                Grosir <span id="harga_grosir1"> </span>
                                            </option>
                                            <option value="" id="harga_agen">
                                                Agen <span id="harga_agen1"> </span>
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="qty">qty</label>
                                            <input type="text" name="qty" class="form-control" id="qty">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <input type="text" name="keterangan" class="form-control" id="keterangan">
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary"
                                                style="margin-top: 30px">Tambahkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Retur Barang</h3>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped table-hover table-sm" id="datatable">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>No Invoice</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Jenis</th>
                                        <th>Keterangan</th>
                                        <th>Harga</th>
                                        <th>QTY</th>
                                        <th>Total Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    $total_keseluruhan_harga = 0;
                                    @endphp
                                    @foreach ($detail_retur_barang as $item)
                                    @php
                                    $total_harga = $item->harga * $item->qty;
                                    $total_keseluruhan_harga += $total_harga;
                                    @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->no_retur }}</td>
                                        <td>{{ $item->kode_barang }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>{{ $item->jenis }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ number_format($total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            <a href="/retur/{{ $item->id }}/hapus_detail_retur_barang"
                                                onclick="return confirm('Yakin mau dihapus?!')"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td align="center" colspan="8"><strong>Total Pembayaran</strong></td>
                                        <td><strong>{{ number_format($total_keseluruhan_harga, 0, ',', '.') }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Transaksi Pembayaran</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <form action="/retur" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="pelanggan_id">Pelanggan</label>
                                        <select name="pelanggan_id" id="pelanggan_id" class="form-control select2bs4"
                                            required>
                                            <option value="">Pilih</option>
                                            @foreach ($pelanggan as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="no_retur" value="{{ request()->segment(3) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="total_pembayaran">Total Pembayaran</label>
                                        <input type="text" class="form-control" id="total_pembayaran"
                                            value="{{ number_format($total_keseluruhan_harga, 0, ',', '.') }}" readonly
                                            required>
                                        <input type="hidden" name="total_pembayaran" id="total_pembayaran1"
                                            value="{{ $total_keseluruhan_harga }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="pembayaran">Pembayaran</label>
                                        <input type="text" class="form-control" id="pembayaran" onkeyup="kalkulasi()"
                                            autocomplete="off" required>
                                        <input type="hidden" name="pembayaran" id="pembayaran1" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="kembalian">Kembalian</label>
                                        <input type="text" class="form-control" id="kembalian" readonly required>
                                        <input type="hidden" name="kembalian" id="kembalian1" readonly required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Simpan Transaksi</button>
                                </form>
                            </div>
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

<script>
    $(document).on('change', '#kode_barang', function() {
        $('#stok').val($(this).find(':selected').data('stok_barang'))

        $('#harga_ecer').val($(this).find(':selected').data('harga_ecer') + ",ecer")
        $('#harga_ecer').text("Ecer - Rp" + $(this).find(':selected').data('harga_ecer'))
        
        $('#harga_grosir').val($(this).find(':selected').data('harga_grosir') + ",grosir")
        $('#harga_grosir').text("Grosir - Rp" + $(this).find(':selected').data('harga_grosir'))

        $('#harga_agen').val($(this).find(':selected').data('harga_agen') + ",agen")
        $('#harga_agen').text("Agen - Rp" + $(this).find(':selected').data('harga_agen'))
    })

    $('#pembayaran').on('keyup', function () {
        $(this).mask('000.000.000', {reverse: true});
    })

    function kalkulasi() {
        let pembayaran = $('#pembayaran').val().split('.'); // 300.000 -> 300 0000
        let pembayaran1 = $('#pembayaran1').val(pembayaran.join("")); // 300.000 -> 300 0000
        
        
        let total_pembayaran1 = $('#total_pembayaran1').val();
        let hasil = pembayaran1.val() - total_pembayaran1; // 210000
        let convert = parseInt(hasil).toLocaleString("id-ID"); // 210.000

        $('#kembalian').val(convert);
        $('#kembalian1').val(hasil);
    }
</script>
@endsection