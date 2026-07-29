<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notebook Store Tasikmalaya - {{ $penjualan->no_invoice }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            font-size: 12px;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 10px;
        }

        h2, h4 {
            margin: 5px 0;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 5px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <center>
            <img src="{{ public_path('assets/dist/img/ntbk-main.png') }}" alt="Logo" style="width: 150px; margin-bottom: 5px;">
            <h3 style="margin-top: 5px; margin-bottom: 2px;">Notebook Store Tasikmalaya</h3>
            <p style="margin-top: 0; font-size: 12px; text-align: center;">Jl. Cikalang Girang No.46, Kahuripan, Kec. Tawang, Kota Tasikmalaya, Jawa Barat 46115</p>
        </center>
        
        <hr>

        <table>
            <tr>
                <th>Tanggal</th>
                <td>: {{ date('d/m/Y H:i:s', strtotime($penjualan->created_at)) }}</td>
            </tr>
            <tr>
                <th>Kasir</th>
                <td>: {{ $penjualan->user->name }}</td>
            </tr>
            <tr>
                <th>No. Invoice</th>
                <td>: {{ $penjualan->no_invoice }}</td>
            </tr>
            <tr>
                <th>Pelanggan</th>
                <td>: {{ $penjualan->pelanggan_id ? $penjualan->pelanggan->nama : 'Umum' }}</td>
            </tr>
            <tr>
                <th>Jenis</th>
                <td>: {{ ucfirst($penjualan->jenis) }}</td>
            </tr>
            @if($penjualan->jenis == 'transfer' && $penjualan->bank_nama)
            <tr>
                <th>Bank</th>
                <td>: {{ $penjualan->bank_nama }} ({{ $penjualan->bank_rekening }}) a/n {{ $penjualan->bank_atas_nama }}</td>
            </tr>
            @endif
            @if($penjualan->keterangan)
            <tr>
                <th>Keterangan</th>
                <td>: {{ $penjualan->keterangan }}</td>
            </tr>
            @endif
        </table>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Item</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($detail_penjualan as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" style="text-align: right;">TOTAL</th>
                    <td><strong>{{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</strong></td>
                </tr>
                @if($penjualan->biaya_pengiriman > 0)
                <tr>
                    <th colspan="4" style="text-align: right;">BIAYA PENGIRIMAN</th>
                    <td><strong>{{ number_format($penjualan->biaya_pengiriman, 0, ',', '.') }}</strong></td>
                </tr>
                @endif
                <tr>
                    <th colspan="4" style="text-align: right;">SUB TOTAL</th>
                    <td><strong>{{ number_format($penjualan->sub_total, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <th colspan="4" style="text-align: right;">PEMBAYARAN</th>
                    <td><strong>{{ number_format($penjualan->pembayaran, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <th colspan="4" style="text-align: right;">KEMBALIAN</th>
                    <td><strong>{{ number_format($penjualan->kembalian, 0, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="footer">
            <p>Password (jika ada) : 1234</p>
            <p>Terima kasih sudah berbelanja!</p>
        </div>
    </div>
</body>

</html>
