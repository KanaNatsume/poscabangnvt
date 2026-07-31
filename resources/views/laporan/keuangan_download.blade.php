<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NTBK Store Tasikmalaya - KEUANGAN {{ $tanggal_awal1 }} SAMPAI {{ $tanggal_akhir1 }}</title>
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
            /* background-color: #5a5c69;
            color: #fff; */
            text-align: left;
        }

        /* tr:nth-child(even) {
            background: #E5EAEE;
        } */
    </style>
</head>

<body win>
    <section class="section1">
        <h3>LAPORAN KEUNTUNGAN MINGGU/BULAN {{ $tanggal_awal1 }} SAMPAI {{ $tanggal_akhir1 }}</h3>
    </section>

    <section class="section3">
        <h4 style="font-family: sans-serif;">REKAPITULASI HARIAN</h4>
        <table>
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>Tanggal</th>
                    <th>Pemasukan (Omzet)</th>
                    <th>Pengeluaran</th>
                    <th>Keuntungan Bersih</th>
                </tr>
            </thead>
            <tbody>
                @foreach($daily as $date => $data)
                <tr>
                    <td style="text-align: center;">{{ date('d-m-Y', strtotime($date)) }}</td>
                    <td style="text-align: right;">Rp {{ number_format($data['pemasukan'], 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($data['pemasukan'] - $data['pengeluaran'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background-color: #e6e6e6; font-weight: bold;">
                    <td style="text-align: center;">GRAND TOTAL</td>
                    <td style="text-align: right;">Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($total_pemasukan - $total_pengeluaran, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <br><br>

        <h4 style="font-family: sans-serif;">REKAPITULASI BULANAN</h4>
        <table>
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>Bulan</th>
                    <th>Pemasukan (Omzet)</th>
                    <th>Pengeluaran</th>
                    <th>Keuntungan Bersih</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monthly as $month => $data)
                <tr>
                    <td style="text-align: center;">{{ date('F Y', strtotime($month . '-01')) }}</td>
                    <td style="text-align: right;">Rp {{ number_format($data['pemasukan'], 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($data['pemasukan'] - $data['pengeluaran'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background-color: #e6e6e6; font-weight: bold;">
                    <td style="text-align: center;">GRAND TOTAL</td>
                    <td style="text-align: right;">Rp {{ number_format($total_pemasukan, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($total_pengeluaran, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($total_pemasukan - $total_pengeluaran, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </section>
</body>

</html>