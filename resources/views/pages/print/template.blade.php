<!DOCTYPE html>
<html>

<head>
    <title>Transaction Receipt</title>
    @include('includes.head')
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
            overflow: hidden;
            white-space: nowrap;
            text-overflow: "";
        }

        td {
            border: none!important;
        }
    </style>
</head>

<body>
    <div id="data-header">
        <h5> {{ $data->header['nama_usaha'] }}</h5>
        <h5> {{ $data->transaksi->outlet->alamat }}</h5>
        <h5> {{ $data->header['delivery_text'] }}</h5>
        <p class="hr-text">
            ============================================================================================================================
        </p>
    </div>
    <div id="data-kasir">
        <div class="row">
            <div class="col-2">KASIR</div>
            <div class="col-3">: {{ Auth::user()->username }}</div>
            <div class="col-2">PENCETAKAN</div>
            <div class="col-5">: {{ date('d-m-20y h:i:s') }}</div>
        </div>
        <p class="hr-text">
            ============================================================================================================================
        </p>
    </div>
    <div id=data-transaksi>
        <div class="row">
            <div class="col-2 d-flex flex-column">
                <p>NO. ORDER</p>
                <p>PELANGGAN</p>
                <p>ALAMAT/TELP</p>
                <p>SISA SALDO</p>
            </div>
            <div class="col-10">
                <p>: {{ $data->transaksi->kode }} / {{ $data->transaksi->jenis_transaksi }}</p>
                <p>: {{ $data->transaksi->pelanggan->nama }} / {{ $data->transaksi->pelanggan->no_id }}</p>
                <p>: {{ $data->transaksi->pelanggan->alamat }} / {{ $data->transaksi->pelanggan->telephone }}</p>
                <p>: {{ $data->transaksi->pelanggan->saldo_akhir }}</p>
            </div>
            <div class="col-2 text-end">
                <p>EXPRESS</p>
            </div>
            <div class="col-2">
                <p>: {{ $data->transaksi->express ? 'YA' : 'TIDAK' }}</p>
            </div>
            <div class="col-2 text-end">
                <p>SETRIKA SAJA</p>
            </div>
            <div class="col-2">
                <p>: {{ $data->transaksi->setrika_only ? 'YA' : 'TIDAK' }}</p>
            </div>
        </div>
        <p class="hr-text">
            ============================================================================================================================
        </p>
    </div>
    <div id="detail-transaksi">
        @if (str_contains($data->transaksi->kode, 'BU-'))
        <div class="table-responsive">
            <table class="table table-sm" style="font-size: 10pt">
                <thead>
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
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Subtotal</td>
                        <td class="text-end thousand-separator">{{ $data->transaksi->subtotal }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Diskon</td>
                        <td class="text-end thousand-separator">{{ $data->transaksi->diskon + $data->transaksi->diskon_member }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Grand Total</td>
                        <td class="text-end thousand-separator">{{ $data->transaksi->grand_total }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @elseif (str_contains($data->transaksi->kode, 'PR-'))
        <div class="table-responsive">
            <table class="table table-sm" style="font-size: 10pt">
                <thead>
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
                            <td class="text-end thousand-separator">{{ $item->harga_premium / $item->qty }}</td>
                            <td class="text-end thousand-separator">{{ $item->harga_premium }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Subtotal</td>
                        <td class="text-end thousand-separator">{{ $data->transaksi->subtotal }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Diskon</td>
                        <td class="text-end thousand-separator">{{ $data->transaksi->diskon + $data->transaksi->diskon_member }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end fw-bold">Grand Total</td>
                        <td class="text-end thousand-separator">{{ $data->transaksi->grand_total }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @endif
        <p class="hr-text">
            ============================================================================================================================
        </p>
    </div>

</body>

</html>
