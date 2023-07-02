{{-- @dd($inventories) --}}
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Item</th>
                <th>Note</th>
                <th>Tipe Kemas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->item_transaksi as $item)
                @foreach ($item->item_notes as $item_note)
                    <tr>
                        <td class="text-start">{{ $item->nama }}</td>
                        <td class="text-start">{{ $item_note->catatan }}</td>
                        <td class="py-1">
                            <select class="form-select form-select-sm" aria-label="Default select example">
                                <option hidden value="">-</option>
                                @foreach ($inventories as $inventory)
                                    <option value="{{ $inventory->id }}">{{ $inventory->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div>


