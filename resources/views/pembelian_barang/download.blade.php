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
            Pembelian : <strong style="color: #595959;">{{ $pembelian->no_pembelian }}</strong></p>
        <p style="color: #595959; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Supplier
            <span style="margin-left: 30px;">:</span> <strong
                style="color: #595959;">{{ $pembelian->supplier->nama }}</strong></p>
        <p style="color: #595959; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Tanggal
            <span style="margin-left: 34px;">:</span> <strong
                style="color: #595959;">{{ date('d-m-Y', strtotime($pembelian->tanggal ?? $pembelian->created_at)) }}</strong>
        </p>
    </section>

    <section class="section3">
        <table>
            <tr>
                <th>NO</th>
                <th>KODE BARANG</th>
                <th>NAMA BARANG</th>
                <th>QTY</th>
                <th>TOTAL HARGA</th>
            </tr>
            @php
            $no = 1;
            $total_keseluruhan_harga = 0;
            @endphp
            @foreach ($detail_pembelian as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
            </tr>
            @php
            $total_keseluruhan_harga += $item->total_harga
            @endphp
            @endforeach
            <tr>
                <td colspan="4" align="center"><strong>TOTAL PEMBAYARAN</strong></td>
                <td><strong>{{ number_format($total_keseluruhan_harga, 0, ',', '.') }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="4" align="center"><strong>PEMBAYARAN</strong></td>
                <td><strong>{{ number_format($pembelian->pembayaran, 0, ',', '.') }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="4" align="center"><strong>KEMBALIAN</strong></td>
                <td><strong>{{ number_format($pembelian->kembalian, 0, ',', '.') }}</strong>
                </td>
            </tr>
        </table>
    </section>
</body>

</html>