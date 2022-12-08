@extends('layouts.users')

@section('content')
<div class="container">
    <header class="my-3" style="color: var(--bs-gray);">
        <a>Transaksi</a>
        <i class="fas fa-angle-right mx-2"></i>
        <a>Pembayaran</a>
    </header>
    <div class="card">
        <div class="card-body">
            <h4>List Transaksi</h4>
            <hr />
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Grand Total</th>
                            <th>Lunas</th>
                            <th>Terbayar</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksis as $transaksi)
                            <tr>
                                <td class="text-center">{{ $pickup->id }}</td>
                                <td class="text-center">{{ $pickup->pelanggan->nama }}</td>
                                <td class="text-center">{{ $pickup->nama_driver }}</td>
                                <td>{{ $pickup->alamat }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/transaksi/pembayaran.js') }}"></script>
@endsection
