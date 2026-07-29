<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NTBK Store Tasikmalaya - KEUNTUNGAN MINGGU/BULAN {{ $tanggal_awal1 }} SAMPAI {{ $tanggal_akhir1 }}</title>
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
        <h3>LAPORAN KEUNTUNGAN MINGGU/BULAN {{ $tanggal_awal1 }} SAMPAI {{ $tanggal_akhir1 }}</h3>
    </section>

    <section class="section3">
        <table>
            <tr>
                <th>#</th>
                <th>TANGGAL</th>
                <th>KODE BARANG</th>
                <th>NAMA BARANG</th>
                <th>JENIS PENJUALAN</th>
                <th>HARGA</th>
                <th>QTY</th>
                <th>PROFIT</th>
                <th>POTONGAN</th>
                <th>KEUNTUNGAN</th>
            </tr>
            @php
            $no = 1;
            $total_keuntungan = 0;
            @endphp
            @foreach ($detail_penjualan as $item)
            @php
            $keuntungan = $item->qty * $item->profit - $item->potongan;
            $total_keuntungan += $keuntungan;
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ date('d-m-Y H:i:s', strtotime($item->created_at)) }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ strtoupper($item->jenis) }}</td>
                <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->qty }}</td>
                <td>{{ number_format($item->profit, 0, ',', '.') }}</td>
                <td>{{ number_format($item->potongan, 0, ',', '.') }}</td>
                <td>{{ number_format($keuntungan, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="9" align="center"><strong>TOTAL KEUNTUNGAN</strong></td>
                <td>{{ number_format($total_keuntungan, 0, ',', '.') }}</td>
            </tr>
        </table>
        <p><strong>Rumus Keuntungan :</strong> QTY X PROFIT - POTONGAN</p>
    </section>
</body>

</html>