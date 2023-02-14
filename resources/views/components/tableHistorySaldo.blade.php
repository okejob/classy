<div class="table-responsive mb-2">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jenis Input</th>
                <th colspan="2">Nominal</th>
                <th colspan="2">Saldo Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($saldos as $saldo)
            <tr>
                <td>{{ $saldo->created_at }}</td>
                <td class="text-center">{{ $saldo->jenis_input }}</td>
                <td>Rp</td>
                <td class="text-end thousand-separator">{{ $saldo->nominal }}</td>
                <td>Rp</td>
                <td class="text-end thousand-separator">{{ $saldo->saldo_akhir }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{ $saldos->links() }}
