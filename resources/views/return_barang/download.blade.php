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
        <p style="color: #595959; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">No.
            Retur <span style="margin-left: 20px">:</span> <strong
                style="color: #595959;">{{ $retur_barang->no_retur }}</strong></p>
        <p style="color: #595959; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Pelanggan
            <span style="margin-left: 14px;">:</span> <strong
                style="color: #595959;">{{ $retur_barang->pelanggan->nama }}</strong></p>
        <p style="color: #595959; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Tanggal
            <span style="margin-left: 28px;">:</span> <strong
                style="color: #595959;">{{ tanggal_indonesia(date('d-m-Y', strtotime($retur_barang->created_at))) }}</strong>
        </p>
    </section>

    <section class="section3">
        <table>
            <tr>
                <th>NO</th>
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
            $total_keseluruhan_harga = 0;
            $total_harga = 0;
            @endphp
            @foreach ($detail_retur_barang as $item)
            @php
            $total_harga = $item->harga * $item->qty;
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->no_invoice }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ ucfirst($item->jenis) }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ number_format($total_harga, 0, ',', '.') }}</td>
            </tr>
            @php
            $total_keseluruhan_harga += $total_harga
            @endphp
            @endforeach
            <tr>
                <td colspan="8" align="center"><strong>TOTAL PEMBAYARAN</strong></td>
                <td><strong>{{ number_format($total_keseluruhan_harga, 0, ',', '.') }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="8" align="center"><strong>PEMBAYARAN</strong></td>
                <td><strong>{{ number_format($retur_barang->pembayaran, 0, ',', '.') }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="8" align="center"><strong>KEMBALIAN</strong></td>
                <td><strong>{{ number_format($retur_barang->kembalian, 0, ',', '.') }}</strong>
                </td>
            </tr>
        </table>
    </section>
</body>

</html>