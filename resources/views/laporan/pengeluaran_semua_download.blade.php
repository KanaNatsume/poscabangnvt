<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NTBK Store Tasikmalaya - PENGELUARAN</title>
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
        <h3>REKAPITULASI TRANSAKSI PENGELUARAN</h3>
    </section>

    <section class="section3">
        <table>
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>NO PENGELUARAN</th>
                <th>NAMA</th>
                <th>KATEGORI</th>
                <th>KETERANGAN</th>
                <th>JUMLAH</th>
            </tr>
            @php
            $no = 1;
            $total_pengeluaran = 0;
            @endphp
            @foreach ($pengeluaran as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->tanggal ? date('d-m-Y', strtotime($item->tanggal)) : date('d-m-Y', strtotime($item->created_at)) }}</td>
                <td>{{ $item->no_pengeluaran }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->kategori_pengeluaran ?? '-' }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
            </tr>
            @php
            $total_pengeluaran += $item->jumlah;
            @endphp
            @endforeach
            <tr>
                <td colspan="6" align="center"><strong>TOTAL PENGELUARAN</strong></td>
                <td>{{ number_format($total_pengeluaran, 0, ',', '.') }}</td>
            </tr>
        </table>

        <br>
        <h4 style="color:#595959; font-family: Cambria;">RINGKASAN PER KATEGORI</h4>
        <table>
            <tr><th>KATEGORI</th><th>TOTAL</th></tr>
            @php
            $ks = [];
            foreach ($pengeluaran as $p) { $k = $p->kategori_pengeluaran ?? '-'; $ks[$k] = ($ks[$k] ?? 0) + $p->jumlah; }
            @endphp
            @foreach($ks as $k => $t)
            <tr><td>{{ $k }}</td><td>{{ number_format($t,0,',','.') }}</td></tr>
            @endforeach
        </table>
    </section>
</body>

</html>