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
        <a href="/laporan/penjualan/semua/download" target="_blank"><button type="button">Download</button></a>
        <h3>REKAPITULASI TRANSAKSI PENJUALAN BARANG</h3>
    </section>

    <section class="section3">
        <table>
            <tr>
                <th>NO</th>
                <th>NO INVOICE</th>
                <th>NAMA PELANGGAN</th>
                <th>PRODUK</th>
                <th>TOTAL PEMBAYARAN</th>
                <th>POTONGAN</th>
                <th>SUB TOTAL</th>
                <th>PEMBAYARAN</th>
                <th>KEMBALIAN</th>
                <th>JENIS PEMBAYARAN</th>
                <th>JENIS BANK</th>
                <th>BIAYA PENGIRIMAN</th>
            </tr>
            @php
            $no = 1;
            @endphp
            @foreach ($penjualan as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->no_invoice }}</td>
                <td>{{ $item->pelanggan_id }}</td>
                <td>
                    <table class="table">
                        @foreach ($item->detailPenjualan as $i)
                        <tr>
                            <td>1</td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                <td>{{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                <td>{{ number_format($item->diskon, 0, ',', '.') }}</td>
                <td>{{ number_format($item->sub_total, 0, ',', '.') }}</td>
                <td>{{ number_format($item->pembayaran, 0, ',', '.') }}</td>
                <td>{{ number_format($item->kembalian, 0, ',', '.') }}</td>
                <td>{{  strtoupper($item->jenis) }}</td>
                <td>{{  strtoupper($item->jenis_bank) }}</td>
                <td>{{ number_format($item->biaya_pengiriman, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>
    </section>
</body>

</html>