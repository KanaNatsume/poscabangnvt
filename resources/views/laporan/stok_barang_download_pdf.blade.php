<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NTBK Store Tasikmalaya - STOK BARANG</title>
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
        <h3>STOK BARANG</h3>
    </section>

    <section class="section3">
        <table>
            <tr>
                <th>#</th>
                <th>KODE BARANG</th>
                <th>NAMA BARANG</th>
                <th>KATEGORI</th>
                <th>STOK</th>
                <th>MINIMAL STOK</th>
            </tr>
            @php
            $no = 1;
            $total_stok = 0;
            @endphp
            @foreach ($barang as $item)
            @php
            $total_stok += $item->stok;
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $item->kode_barang }}</td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->kategori->nama }}</td>
                <td>{{ $item->stok }}</td>
                <td>{{ $item->stok_minimal }}</td>
            </tr>
            @endforeach
            <tr>
                <td align="center" colspan="4"><strong>TOTAL STOK</strong></td>
                <td colspan="2">{{ $total_stok }}</td>
            </tr>
        </table>
    </section>
</body>

</html>