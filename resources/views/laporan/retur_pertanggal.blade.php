<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NTBK Store Tasikmalaya</title>
    <style>
        body {
            font-size: 12px;
        }

        h3 {
            text-align: center;
            margin-top: 0px;
            margin-bottom: 5px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            color: #595959;
        }

        .section2 {
            width: 100%;
            height: 50px;
            font-family: calibri;
            background-color: #7E97AD;
            color: #fff;
        }

        .h2-section2 {
            margin-left: 20px;
            line-height: 50px;
        }

        .section3 {
            margin-top: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table td,
        table th {
            border: 1px solid #ddd;
            padding: 8px;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        table th {
            background-color: #5a5c69;
            color: #fff;
            text-align: left;
        }

        tr:nth-child(even) {
            background: #E5EAEE;
        }
    </style>
</head>

<body>
    <section class="section1">
        <form action="/laporan/retur/pertanggal/download" method="get" target="_blank">
            <input type="hidden" name="tanggal_awal" value="{{ $tanggal_awal }}">
            <input type="hidden" name="tanggal_akhir" value="{{ $tanggal_akhir }}">
            <button type="submit">Download</button>
        </form>
        <h3>REKAPITULASI RETUR BARANG BARANG {{ $tanggal_awal1 }} SAMPAI {{ $tanggal_akhir1 }}</h3>
    </section>

    <section class="section3">
        <table>
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>NO INVOICE</th>
                <th>KODE BARANG</th>
                <th>NAMA BARANG</th>
                <th>JENIS</th>
                <th>KETERANGAN</th>
                <th>HARGA</th>
                <th>QTY</th>
                <th>TOTAL HARGA</th>
            </tr>
            @php
            $no = 1;
            $total_retur_barang = 0;
            @endphp
            @foreach ($detail_retur_barang as $item)
            @php
            $total_harga = $item->harga * $item->qty;
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                <td>{{ $item->no_invoice }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{  ucfirst($item->jenis) }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ number_format($total_harga, 0, ',', '.') }}</td>
            </tr>
            @php
            $total_retur_barang += $total_harga;
            @endphp
            @endforeach
            <tr>
                <td colspan="9" align="center"><strong>TOTAL</strong></td>
                <td>{{ number_format($total_retur_barang, 0, ',', '.') }}</td>
            </tr>
        </table>
    </section>
</body>

</html>