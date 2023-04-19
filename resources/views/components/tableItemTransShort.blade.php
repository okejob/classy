<div class="table-responsive my-2 tbody-wrap">
    <table class="table table-striped mb-0" id="table-trans-item">
        <thead>
            <tr>
                <th>Nama Item</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th style="width: 46.25px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->item_transaksi as $item_transaksi)
            <tr class="trans-{{ $transaksi->id }}">
                <td>{{ $item_transaksi->nama }}</td>
                <td class="text-center">{{ $item_transaksi->nama_kategori }}</td>
                <td>
                    @foreach ($rewash as $item_rewash)
                        @if ($item_rewash->item_transaksi_id == $item_transaksi->id)
                            <div class="d-flex justify-content-between align-items-center">
                                Rewash <i class="fa-solid fa-circle-exclamation text-danger"></i>
                            </div>
                        @endif
                    @endforeach
                </td>
                <td class="cell-action" style="width: 46.25px;">
                    @if ($transaksi->pencuci != null && !$transaksi->setrika_only)
                    <button id="btn-{{ $item_transaksi->id }}" class="btn btn-primary btn-sm btn-show-action-2" type="button">
                        <i class="fas fa-bars"></i>
                    </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
