<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th style="width: 10%;">Kode</th>
                <th style="width: 30%;">Pelanggan</th>
                <th style="width: 20%;">Driver</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pickups as $pickup)
                <tr>
                    <td class="text-center">{{ $pickup->kode }}</td>
                    <td class="text-center">{{ $pickup->pelanggan->nama }}</td>
                    <td class="text-center">{{ $pickup->nama_driver }}</td>
                    <td>{{ $pickup->alamat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $pickups->links() }}
