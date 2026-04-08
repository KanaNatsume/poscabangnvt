<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHILS OFFICIAL - {{ $penjualan->no_invoice }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 10px auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        h5 {
            margin: 10px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 5px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 5px; /* Adjusted margin here */
            text-align: center;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <center>
            <h2>CHILS OFFICIAL</h2>
            <h4>Jl. Ibu Apipah No.6D Kel.Kahuripan Kec. Tawang Kota Tasikmalaya</h5>
        </center>
        <table>
            <tr>
                <th>Tanggal</th>
                <td style="padding-right: 150px;">: {{ date('d/m/Y H:i:s', strtotime($penjualan->created_at)) }}</td>
            </tr>
            <tr>
                <th>Kasir</th>
                <td style="padding-right: 150px;">: {{ $penjualan->user->name }}</td>
            </tr>
            <tr>
                <th>No. Invoice</th>
                <td style="padding-right: 150px;">: {{ $penjualan->no_invoice }}</td>
            </tr>
            <tr>
                <th>Pelanggan</th>
                <td style="padding-right: 150px;">: {{ $penjualan->pelanggan_id ? $penjualan->pelanggan->nama : 'Umum' }}</td>
            </tr>
            <tr>
                <th>Jenis</th>
                <td style="padding-right: 150px;">: {{ ucfirst($penjualan->jenis) }}</td>
            </tr>
            <tr>
                <th>Bank</th>
                <td style="padding-right: 150px;">: {{ ucfirst($penjualan->jenis_bank) }}</td>
            </tr>
            @if($penjualan->keterangan)
            <tr>
                <th>Keterangan</th>
                <td style="padding-right: 150px;">: {{ $penjualan->keterangan }}</td>
            </tr>
            @endif
        </table>

        <table>
        <tr>
    <th>No</th>
    <th>Nama Barang</th>
    <th>Harga</th>
    <th>Item</th>
    <th>Potongan</th>
    <th>Total Harga</th>
</tr>
@php $no = 1; @endphp
@foreach ($detail_penjualan as $item)
<tr>
    <td>{{ $no++ }}</td>
    <td>{{ $item->nama_barang }}</td>
    <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
    <td>{{ $item->qty }}</td>
    <td>{{ number_format($item->potongan, 0, ',', '.') }}</td>
    <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
</tr>
@endforeach

            <tr>
                <th colspan="5">JUMLAH</th>
                <td><strong>{{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <th colspan="5">BIAYA PENGIRIMAN</th>
                <td><strong>{{ number_format($penjualan->biaya_pengiriman, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <th colspan="5">SUB TOTAL</th>
                <td><strong>{{ number_format($penjualan->sub_total, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <th colspan="5">TUNAI</th>
                <td><strong>{{ number_format($penjualan->pembayaran, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <th colspan="5">KEMBALIAN</th>
                <td><strong>{{ number_format($penjualan->kembalian, 0, ',', '.') }}</strong></td>
            </tr>
        </table>

        <div class="footer">
            <p>Barang yang rusak dapat dikembalikan dengan syarat tertentu</p>
            <p>Selamat berbelanja kembali</p>
            <p>Terima kasih</p>
        </div>
    </div>
</body>

</html>
