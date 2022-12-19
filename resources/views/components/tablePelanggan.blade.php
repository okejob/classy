<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Outlet</th>
                <th>Membership</th>
                <th>Nama Lengkap</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Jenis ID</th>
                <th>Nomor ID</th>
                <th>Telphone</th>
                <th>E-mail</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelanggans as $pelanggan)
            <tr>
                <td>Outlet Pelanggan</td>
                @if ($pelanggan->member)
                    <td class="text-center">Member</td>
                @else
                    <td class="text-center">Bukan member</td>
                @endif
                <td>{{ $pelanggan->nama }}</td>
                <td class="text-center">{{ $pelanggan->tanggal_lahir }}</td>
                <td>{{ $pelanggan->alamat }}</td>
                <td class="text-center">{{ $pelanggan->jenis_id }}</td>
                <td class="text-center">{{ $pelanggan->no_id }}</td>
                <td>{{ $pelanggan->telephone }}</td>
                <td>{{ $pelanggan->email }}</td>
                @if ($pelanggan->status)
                    <td class="text-center">Aktif</td>
                @else
                    <td class="text-center">Tidak aktif</td>
                @endif
                <td class="cell-action">
                    <button id="btn-{{ $pelanggan->id }}" class="btn btn-primary btn-sm btn-show-action" type="button">
                        <i class="fas fa-bars"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $pelanggans->links() }}
