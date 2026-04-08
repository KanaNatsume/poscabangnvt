<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NTBK Store Tasikmalaya - HUTANG PERTANGGAL {{ $tanggal_awal1 }} SAMPAI {{ $tanggal_akhir1 }}</title>
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
        <h3>REKAPITULASI TRANSAKSI HUTANG {{ $tanggal_awal1 }} SAMPAI {{ $tanggal_akhir1 }}</h3>
    </section>

    <section class="section3">
        <table>
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>NO INVOICE</th>
                <th>PELANGGAN</th>
                <th>STATUS</th>
                <th>SUB TOTAL</th>
            </tr>
            @php
            $no = 1;
            $total_hutang = 0;
            @endphp
            @foreach ($hutang as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                <td>{{ $item->no_invoice }}</td>
                <td>{{ $item->nama_pelanggan }}</td>
                @if ($item->status == 0)
                <td>Belum Lunas</td>
                @else
                <td>Sudah Lunas</td>
                @endif
                <td>{{ number_format($item->sub_total, 0, ',', '.') }}</td>
            </tr>
            @php
            $total_hutang += $item->sub_total;
            @endphp
            @endforeach
            <tr>
                <td colspan="5" align="center"><strong>TOTAL HUTANG</strong></td>
                <td>{{ number_format($total_hutang, 0, ',', '.') }}</td>
            </tr>
        </table>
    </section>
</body>

</html>