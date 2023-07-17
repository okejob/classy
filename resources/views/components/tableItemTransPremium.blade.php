<div class="table-responsive my-2 tbody-wrap">
    <table class="table table-striped mb-0" id="table-trans-item">
        <thead>
            <tr>
                <th>Nama Item</th>
                <th class="d-none d-lg-table-cell">Kategori</th>
                <th class="d-none d-md-table-cell">Proses</th>
                <th class="d-none d-md-table-cell">Qty</th>
                <th colspan="2" class="d-none d-md-table-cell">Harga Premium</th>
                <th colspan="2">Total</th>
                <th style="width: 46.25px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trans->item_transaksi as $item)
            <tr id='{{ $item->id }}' class="item">
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
                <td class="d-none d-md-table-cell">Rp</td>
                <td class='d-none d-md-table-cell text-end thousand-separator'>{{ $item->harga_premium }}</td>
                <td>Rp</td>
                <td class='text-end thousand-separator'>{{ $item->total_premium }}</td>
                <td class='text-end p-1' style='width: 46.25px;'>
                    <button id='btn-{{ $item->id }}' class='btn btn-primary btn-sm btn-show-action' type='button'>
                        <i class='fas fa-bars' aria-hidden='true'></i>
                    </button>
                </td>
            </tr>
            @if($item->diskon_jenis_item != 0)
            <tr id='row-diskon-{{ $item->id }}' class="diskon">
                <td class="text-end" colspan="4">Diskon jenis item</td>
                <td class="d-none d-md-table-cell">Rp</td>
                <td class="d-none d-md-table-cell thousand-separator text-end">{{ $item->diskon_jenis_item }}</td>
                <td>Rp</td>
                <td class="thousand-separator text-end">{{ $item->diskon_jenis_item * $item->qty }}</td>
                <td style='width: 46.25px;'></td>
            </tr>
            @endif
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
                <td class="text-end">Diskon Jenis Item</td>
                <td style="width: 5%">Rp</td>
                <td class="text-end thousand-separator" id="diskon-item">{{ $trans->diskon_jenis_item }}</td>
                <td style="width: 46.25px;"></td>
            </tr>
            <tr>
                <td class="text-end">Diskon Promo</td>
                <td style="width: 5%">Rp</td>
                <td class="text-end thousand-separator" id="diskon-promo">{{ $trans->total_diskon_promo }}</td>
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
