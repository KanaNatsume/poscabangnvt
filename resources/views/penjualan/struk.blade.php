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

        .no-print {
            margin-top: 20px;
            text-align: center;
        }

        .btn-share {
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
            border-radius: 5px;
            margin: 5px;
            display: inline-block;
            font-size: 14px;
        }

        .btn-wa { background-color: #25d366; }
        .btn-email { background-color: #007bff; }
        .btn-download { background-color: #6c757d; }

        @media print {
            .no-print { display: none; }
            .container { border: none; background: none; }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <center>
            <img src="{{ asset('assets/dist/img/ntbk-main.png') }}" alt="Logo" style="width: 180px; margin-bottom: 5px;">
            <h3 style="margin-top: 5px; margin-bottom: 2px;">Notebook Store Tasikmalaya</h3>
            <p style="margin-top: 0; font-size: 14px;">Jl. Cikalang Girang No.46, Kahuripan, Kec. Tawang, Kota Tasikmalaya, Jawa Barat 46115</p>
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
                <td style="padding-right: 150px;">: 
                    @if($penjualan->jenis == 'transfer' && $penjualan->bank_nama)
                        {{ $penjualan->bank_nama }} ({{ $penjualan->bank_rekening }}) a/n {{ $penjualan->bank_atas_nama }}
                    @else
                        {{ ucfirst($penjualan->jenis_bank) }}
                    @endif
                </td>
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
            <p>Password (jika ada) : 1234</p>
            <p>Terima kasih sudah berbelanja 😊</p>
        </div>

        <div class="no-print">
            <hr>
            <p><strong>Kirim Nota :</strong></p>
            @php
                $phone = $penjualan->pelanggan->no_hp ?? '';
                $phone = preg_replace('/[^0-9]/', '', $phone);
                if (substr($phone, 0, 1) === '0') {
                    $phone = '62' . substr($phone, 1);
                }
                
                $message = "Halo " . ($penjualan->pelanggan->nama ?? 'Pelanggan') . ",\n\nIni adalah nota belanja Anda dari *Notebook Store Tasikmalaya*.\n" .
                           "*Total:* Rp " . number_format($penjualan->sub_total, 0, ',', '.') . "\n\n" .
                           "Silakan unduh nota PDF Anda di sini:\n" . url('/penjualan/pdf/' . $penjualan->id);
                $wa_url = "https://wa.me/" . $phone . "?text=" . rawurlencode($message);
                
                $email_subject = "Nota Belanja - " . $penjualan->no_invoice;
                $email_body = "Halo " . ($penjualan->pelanggan->nama ?? 'Pelanggan') . ",\n\nTerima kasih sudah berbelanja di Notebook Store Tasikmalaya.\nBerikut adalah link untuk mengunduh nota belanja Anda:\n" . url('/penjualan/pdf/' . $penjualan->id);
                $email_url = "mailto:" . ($penjualan->pelanggan->email ?? '') . "?subject=" . rawurlencode($email_subject) . "&body=" . rawurlencode($email_body);
            @endphp
            
            <a href="{{ $wa_url }}" target="_blank" class="btn-share btn-wa">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
            <a href="{{ $email_url }}" class="btn-share btn-email">
                <i class="far fa-envelope"></i> Email
            </a>
            <a href="/penjualan/pdf/{{ $penjualan->id }}" class="btn-share btn-download">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>
            <br><br>
            <button onclick="window.print()" class="btn btn-secondary btn-sm">Cetak Ulang</button>
        </div>
    </div>

    <!-- Keep FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>

</html>
