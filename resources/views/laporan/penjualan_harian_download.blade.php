<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NTBK Store Tasikmalaya - PENJUALAN HARIAN {{ $tanggal }}</title>
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

<body win>
    <section class="section1">
        <h3>LAPORAN PENJUALAN HARIAN {{ $tanggal }}</h3>
    </section>

    <section class="section3">
        <table>
            <tr>
                <th>#</th>
                <th>NO INVOICE</th>
                <th>PELANGGAN</th>
                <th>JENIS PEMBAYARAN</th>
                <th>NAMA BANK</th>
                <th>TOTAL PEMBAYARAN</th>
                <th>BIAYA PENGIRIMAN</th>
                <th>SUB TOTAL</th>
                <th>KETERANGAN</th>
            </tr>
            @php
            $no = 1;
            $total_pendapatan = 0;
            @endphp
            @foreach ($penjualan as $item)
            @php
            $total_pendapatan += $item->sub_total;
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->no_invoice }}</td>
                @if ($item->pelanggan_id == '')
                <td></td>
                @else
                <td>{{ $item->pelanggan->nama }}</td>
                @endif
                <td>{{ ucfirst($item->jenis) }}</td>
                <td>{{ $item->jenis_bank }}</td>
                <td>{{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
                <td>{{ number_format($item->biaya_pengiriman, 0, ',', '.') }}</td>
                <td>{{ number_format($item->sub_total, 0, ',', '.') }}</td>
                <td>{{ $item->keterangan }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="8" align="center"><strong>TOTAL PENDAPATAN</strong> </td> <td>
                        {{ number_format($total_pendapatan, 0, ',', '.') }}</td>
            </tr>
        </table>
    </section>
</body>

</html>