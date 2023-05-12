<div class="table-responsive my-2 tbody-wrap">
    <table class="table table-striped mb-0" id="table-trans-item">
        <thead>
            <tr>
                <th>Nama Item</th>
                <th>Kategori</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trans->item_transaksi as $item_transaksi)
            <tr class="trans-{{ $trans->id }}">
                <td>{{ $item_transaksi->nama }}</td>
                <td class="text-center">{{ $item_transaksi->nama_kategori }}</td>
                <td class="text-center">{{ $item_transaksi->qty }}</td>
            </tr>
            @endforeach
            @if (isset($inventories))
                @foreach ($inventories as $inventory)
                <tr>
                    <td>{{ $inventory['name'] }}</td>
                    <td class="text-center">Packing</td>
                    <td class="text-center">{{ $inventory['qty'] }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

