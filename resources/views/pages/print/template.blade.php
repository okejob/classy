<!DOCTYPE html>
<html>

<head>
    <title>Transaction Receipt</title>
    {{-- @include('includes.head') --}}
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
        h4 {
            margin: 4px 0px;
        }

        .hr-text {
            color: #333;
            text-align: center;
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: "";
            margin: 8px 0px;
        }

        td {
            border: none!important;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }
    </style>
</head>

<body style="width: 100%; height: 100%;">
    <div id="data-header">
        <h4> {{ $data->header['nama_usaha'] }}</h4>
        <h4> {{ $data->transaksi->outlet->alamat }}</h4>
        <h4> {{ $data->header['delivery_text'] }}</h4>
        <p class="hr-text">
            ============================================================================================================================
        </p>
    </div>
    <div id="data-kasir" style="position: relative; margin-bottom: 15px;">
        <div style="position: absolute; left: 0px; top: 0px;">KASIR</div>
        <div style="position: absolute; left: 100px; top: 0px;">: Micel</div>
        <div style="position: absolute; left: 300px; top: 0px;">PENCETAKAN</div>
        <div style="position: absolute; left: 400px; top: 0px;">: {{ date('d-m-20y h:i:s') }}</div>
    </div>
    <div id=data-transaksi>
        <p class="hr-text" style="margin-bottom: 0px;">
            ============================================================================================================================
        </p>
        <div style="position: relative; height: 150px;">
            <p style="position: absolute; left: 0px; top: 0px;">NO. ORDER</p>
            <p style="position: absolute; left: 100px; top: 0px;">: {{ $data->transaksi->kode }} / {{ $data->transaksi->jenis_transaksi }}</p>
            <p style="position: absolute; left: 0px; top: 30px;">PELANGGAN</p>
            <p style="position: absolute; left: 100px; top: 30px;">: {{ $data->transaksi->pelanggan->nama }} / {{ $data->transaksi->pelanggan->no_id }}</p>
            <p style="position: absolute; left: 0px; top: 60px;">ALAMAT/TELP</p>
            <p style="position: absolute; left: 100px; top: 60px;">: {{ $data->transaksi->pelanggan->alamat }} / {{ $data->transaksi->pelanggan->telephone }}</p>
            <p style="position: absolute; left: 0px; top: 90px;">SISA SALDO</p>
            <p style="position: absolute; left: 100px; top: 90px;">: {{ $data->transaksi->pelanggan->saldo_akhir }}</p>
            <p style="position: absolute; left: 0px; top: 120px;">EXPRESS</p>
            <p style="position: absolute; left: 100px; top: 120px;">: {{ $data->transaksi->express ? 'YA' : 'TIDAK' }}</p>
            <p style="position: absolute; left: 300px; top: 120px;">SETRIKA SAJA</p>
            <p style="position: absolute; left: 400px; top: 120px;">: {{ $data->transaksi->setrika_only ? 'YA' : 'TIDAK' }}</p>
        </div>
        <p class="hr-text" style="margin-bottom: 0px;">
            ============================================================================================================================
        </p>
    </div>
    <div id="detail-transaksi">
        @if (str_contains($data->transaksi->kode, 'BU-'))
        <table style="font-size: 10pt">
            <thead style="border-bottom: 1px solid black;">
                <tr>
                    <th class="text-center">NAMA ITEM</th>
                    <th class="text-center">QTY</th>
                    <th class="text-center">UNIT</th>
                    <th class="text-center">BOBOT</th>
                    <th class="text-center">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->transaksi->item_transaksi as $item)
                    <tr>
                        <td class="text-start">{{ $item->nama }}</td>
                        <td class="text-center">{{ $item->qty }}</td>
                        <td class="text-center">{{ $item->satuan_unit }}</td>
                        <td class="text-center">{{ $item->bobot_bucket }}</td>
                        <td class="text-center">{{ $item->total_bobot }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="hr-text" style="padding: 0px;">
                        ============================================================================================================================
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end fw-bold">Subtotal</td>
                    <td class="text-end thousand-separator">{{ $data->transaksi->subtotal }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end fw-bold">Diskon</td>
                    <td class="text-end thousand-separator">{{ $data->transaksi->diskon + $data->transaksi->special_diskon + $data->transaksi->diskon_member }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end fw-bold">Grand Total</td>
                    <td class="text-end thousand-separator">{{ $data->transaksi->grand_total }}</td>
                </tr>
            </tfoot>
        </table>
        @elseif (str_contains($data->transaksi->kode, 'PR-'))
        <table style="font-size: 10pt">
            <thead style="border-bottom: 1px solid black;">
                <tr>
                    <th class="text-center">NAMA ITEM</th>
                    <th class="text-center">QTY</th>
                    <th class="text-center">UNIT</th>
                    <th class="text-center">HARGA</th>
                    <th class="text-center">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->transaksi->item_transaksi as $item)
                    <tr>
                        <td class="text-start">{{ $item->nama }}</td>
                        <td class="text-center">{{ $item->qty }}</td>
                        <td class="text-center">{{ $item->satuan_unit }}</td>
                        <td class="text-end thousand-separator">{{ $item->harga_premium }}</td>
                        <td class="text-end thousand-separator">{{ $item->total_premium }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="hr-text" style="padding: 0;">
                        ============================================================================================================================
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end fw-bold">Subtotal</td>
                    <td class="text-end thousand-separator">{{ $data->transaksi->subtotal }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end fw-bold">Diskon</td>
                    <td class="text-end thousand-separator">{{ $data->transaksi->diskon +  $data->transaksi->special_diskon +$data->transaksi->diskon_member }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end fw-bold">Grand Total</td>
                    <td class="text-end thousand-separator">{{ $data->transaksi->grand_total }}</td>
                </tr>
            </tfoot>
        </table>
        @endif
        <p class="hr-text" style="margin-top: 0px;">
            ============================================================================================================================
        </p>
    </div>

</body>

</html>
