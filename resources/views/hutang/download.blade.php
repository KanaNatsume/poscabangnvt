<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laramart</title>
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
            Invoice : <strong style="color: #595959;">{{ $hutang->no_invoice }}</strong></p>
        <p style="color: #595959; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Nama
            <span style="margin-left: 26px;">:</span> <strong
                style="color: #595959;">{{ $hutang->pelanggan->nama }}</strong></p>
        <p style="color: #595959; font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;">Tanggal
            <span style="margin-left: 17px;">:</span> <strong
                style="color: #595959;">{{ tanggal_indonesia(date('d-m-Y', strtotime($hutang->created_at))) }}</strong>
        </p>
    </section>

    <section class="section3">
        <table>
            <tr>
                <th>NO</th>
                <th>PEMBAYARAN</th>
                <th>TANGGAL</th>
            </tr>
            @php
            $no = 1;
            @endphp
            @foreach ($detail_hutang as $item)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ number_format($item->pembayaran, 0, ',', '.') }}</td>
                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
            </tr>
            @endforeach
        </table>
    </section>
</body>

</html>