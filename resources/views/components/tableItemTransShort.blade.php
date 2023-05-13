<div class="table-responsive my-2 tbody-wrap">
    <table class="table table-striped mb-0" id="table-trans-item">
        <thead>
            <tr>
                <th style="width: 70%;">Nama Item</th>
                <th style="width: 20%;">Kategori</th>
                <th style="width: 10%;">Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trans->item_transaksi as $item_transaksi)
            <tr class="trans-{{ $trans->id }}">
                <td style="width: 70%;">{{ $item_transaksi->nama }}</td>
                <td style="width: 20%;" class="text-center">{{ $item_transaksi->nama_kategori }}</td>
                <td style="width: 10%;" class="text-center">{{ $item_transaksi->qty }}</td>
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

