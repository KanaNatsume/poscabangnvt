<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NTBK Store Tasikmalaya - DETAI PENJUALAN NO INVOICE {{ $penjualan->no_invoice }}</title>
    <style>
        body {
            font-size: 12px;
        }

        h3 {
            text-align: right;
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
        <p style="color: #595959; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
            TANGGAL <span style="margin-left: 42px;">:</span>
            <strong style="color: #595959;">{{ date('d-m-Y', strtotime($penjualan->created_at)) }}</strong>
        </p>
        <p style="color: #595959; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
            NO INVOICE <span style="margin-left: 25px;">:</span> <strong
                style="color: #595959;">{{ $penjualan->no_invoice }}</strong>
        </p>
        <p style="color: #595959; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
            PELANGGAN <span style="margin-left: 26px;">:</span>
            @if ($penjualan->pelanggan_id == '')
            <strong style="color: #595959;">Umum</strong>

            @else
            <strong style="color: #595959;">{{ $penjualan->pelanggan->nama }}</strong>
            @endif
        </p>
        <p style="color: #595959; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
            JENIS PENJUALAN : <strong style="color: #595959;">{{ ucfirst($penjualan->jenis) }}</strong>
        </p>
        @if ($penjualan->jenis_bank == '')

        @else
        <p style="color: #595959; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">
            NAMA BANK <span style="margin-left: 20px;">:</span> <strong
                style="color: #595959;">{{ $penjualan->jenis_bank }}</strong>
        </p>
        @endif
    </section>

    <section class="section3">
        <table>
            <tr>
                <th>NO</th>
                <th>KODE BARANG</th>
                <th>NAMA BARANG</th>
                <th>JENIS PENJUALAN</th>
                <th>HARGA</th>
                <th>ITEM</th>
                <th>POTONGAN</th>
                <th>TOTAL HARGA</th>
            </tr>
            @php
            $no = 1;
            @endphp
            @foreach ($detail_penjualan as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ ucfirst($item->jenis) }}</td>
                <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ number_format($item->potongan, 0, ',', '.') }}</td>
                <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="7"><strong>TOTAL PENJUALAN</strong></td>
                <td>{{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="7"><strong>BIAYA PENGIRIMAN</strong></td>
                <td>{{ number_format($penjualan->biaya_pengiriman, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="7"><strong>SUB TOTAL</strong></td>
                <td>{{ number_format($penjualan->sub_total, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="7"><strong>TUNAI</strong></td>
                <td>{{ number_format($penjualan->pembayaran, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="7"><strong>KEMBALIAN</strong></td>
                <td>{{ number_format($penjualan->kembalian, 0, ',', '.') }}</td>
            </tr>
        </table>
    </section>
</body>

</html>