<!DOCTYPE html>
<html>

<head>
    <title>Transaction Receipt</title>
    <style>
        /* Add any styles you want to use for the PDF here */
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt
        }

        table {
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .hr-text {
            color: #333;
            text-align: center;
            width: 100%;
        }
    </style>
</head>

<body>
    <h5> {{ $data->header['nama_usaha'] }}</h5>
    <h5> {{ $data->transaksi->outlet->alamat }}</h5>
    <h5> {{ $data->header['delivery_text'] }}</h5>
    <p class="hr-text">
        ============================================================================================================================
    </p>
    <h5> NO. ORDER&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $data->transaksi->kode }} /
        {{ $data->transaksi->jenis_transaksi }} </h5>
    <h5> PELANGGAN&nbsp;&nbsp;&nbsp;: {{ $data->transaksi->pelanggan->nama }} / {{ $data->transaksi->pelanggan->no_id }}
    </h5>
    <h5> ALAMAT/TELP&nbsp;: {{ $data->transaksi->pelanggan->alamat }} / {{ $data->transaksi->pelanggan->telephone }}
    </h5>
    <h5> SISA SALDO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $data->transaksi->pelanggan->saldo_akhir }}</h5>
    <h5> EXPRESS&nbsp;&nbsp;&nbsp;:
        {{ $data->transaksi->express ? 'YA' : 'TIDAK' }}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        SETRIKA
        SAJA&nbsp;&nbsp;&nbsp;:
        {{ $data->transaksi->setrika_only ? 'YA' : 'TIDAK' }} </h5>
    <p class="hr-text">
        ============================================================================================================================
    </p>

    <table style="font-size: 10pt">
        <thead>
            <tr>
                <th>NAMA ITEM</th>
                <th>QTY</th>
                <th>UNIT</th>
                <th>BOBOT</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->transaksi->item_transaksi as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ $item->satuan_unit }}</td>
                    <td>{{ $item->bobot_bucket }}</td>
                    <td>{{ $item->total_bobot }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p class="hr-text">
        ============================================================================================================================
    </p>

</body>

</html>
