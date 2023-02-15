<div class="table-responsive my-2 tbody-wrap">
    <table class="table table-striped mb-0" id="table-trans-item">
        <thead>
            <tr>
                <th>Nama Item</th>
                <th class="d-none d-lg-table-cell">Kategori</th>
                <th class="d-none d-md-table-cell">Proses</th>
                <th class="d-none d-md-table-cell">Qty</th>
                <th class="d-none d-md-table-cell">Bobot</th>
                <th>Total</th>
                <th style="width: 46.25px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trans->item_transaksi as $item)
            <tr id='{{ $item->id }}'>
                <td style='white-space: nowrap;'>{{ $item->nama }}</td>
                <td class='d-none d-lg-table-cell text-center'>{{ $item->nama_kategori }}</td>
                @if ($trans->penyetrika != null)
                    <td class='d-none d-md-table-cell text-center'>Setrika</td>
                @elseif ($trans->pencuci != null)
                    <td class='d-none d-md-table-cell text-center'>Cuci</td>
                @else
                    <td class='d-none d-md-table-cell'></td>
                @endif
                @if(in_array("Mengubah Data Item Transaksi", Session::get('permissions')) || Session::get('role') == 'administrator')
                <td class='d-none d-md-table-cell text-center p-0 col-qty'>
                    <div class='d-flex align-items-center justify-content-center' style='height: 39.5px;'>{{ $item->qty }}</div>
                </td>
                @else
                <td class='d-none d-md-table-cell text-center p-0 col-qty disabled'>
                    <div class='d-flex align-items-center justify-content-center' style='height: 39.5px;'>{{ $item->qty }}</div>
                </td>
                @endif
                <td class='d-none d-md-table-cell text-center'>{{ $item->bobot_bucket }}</td>
                <td class='text-center'>{{ $item->total_bobot }}</td>
                <td class='text-end' style='width: 46.25px;'>
                    <button id='btn-{{ $item->id }}' class='btn btn-primary btn-sm btn-show-action' type='button'>
                        <i class='fas fa-bars' aria-hidden='true'></i>
                    </button>
                </td>
            </tr>
            @endforeach
            @if(in_array("Menambahkan Item Ke Transaksi", Session::get('permissions')) || Session::get('role') == 'administrator')
            <tr>
                <td class="text-center" colspan="7" style="padding-top: 4px;padding-bottom: 4px;">
                    <button class="btn btn-primary btn-sm" id="add-item" type="button">
                        <i class="fas fa-plus"></i>
                    </button>
                </td>
            </tr>
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td class="text-end">Sub Total</td>
                <td style="width: 5%">Rp</td>
                <td class="text-end thousand-separator" id="sub-total">{{ $trans->subtotal }}</td>
                <td style="width: 46.25px;"></td>
            </tr>
            <tr>
                <td class="text-end">Diskon</td>
                <td style="width: 5%">Rp</td>
                <td class="text-end thousand-separator" id="diskon">{{ $trans->diskon }}</td>
                <td style="width: 46.25px;"></td>
            </tr>
            <tr>
                <td class="text-end">Diskon Member</td>
                <td style="width: 5%">Rp</td>
                <td class="text-end thousand-separator" id="diskon-member">{{ $trans->diskon_member }}</td>
                <td style="width: 46.25px;"></td>
            </tr>
            <tr>
                <td class="text-end">Grand Total</td>
                <td style="width: 5%">Rp</td>
                <td class="text-end thousand-separator" id="grand-total">{{ $trans->grand_total }}</td>
                <td style="width: 46.25px;"></td>
            </tr>
        </tfoot>
    </table>
</div>
