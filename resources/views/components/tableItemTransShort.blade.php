<div class="table-responsive my-2 tbody-wrap">
    <table class="table table-striped mb-0" id="table-trans-item">
        <thead>
            <tr>
                <th style="width: 65%;">Nama Item</th>
                <th style="width: 20%;">Kategori</th>
                <th>Qty</th>
                <th style="width: 46.25px;" class="column-action"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trans->item_transaksi as $item_transaksi)
            <tr class="trans-{{ $trans->id }}">
                <td style="width: 65%;">{{ $item_transaksi->nama }}</td>
                <td style="width: 20%;" class="text-center">{{ $item_transaksi->nama_kategori }}</td>
                <td class="text-center">{{ $item_transaksi->qty }}</td>
                <td class="cell-action" style="width: 46.25px;">
                    <button id="btn-{{ $item_transaksi->id }}" class="btn btn-primary btn-sm btn-show-action-2" type="button">
                        <i class="fas fa-bars"></i>
                    </button>
                </td>
            </tr>
            @endforeach
            @if (isset($inventories))
                @foreach ($inventories as $inventory)
                <tr>
                    <td style="width: 70%;">{{ $inventory['name'] }}</td>
                    <td style="width: 20%;" class="text-center">Packing</td>
                    <td style="width: 10%;" class="text-center">{{ $inventory['qty'] }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

