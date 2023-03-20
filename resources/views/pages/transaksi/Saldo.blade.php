@extends('layouts.users')

@section('content')
<style>
    #nama-pelanggan::-webkit-calendar-picker-indicator {
        display: none!important;
    }
</style>

<div class="container">
    <section id="section-transaksi-saldo">
        <header class="my-3" style="color: var(--bs-gray);">
            <a>Transaksi</a>
            <i class="fas fa-angle-right mx-2"></i>
            <a>Saldo</a>
        </header>
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Saldo</h1>
                <hr />
                <div class="row">
                    <div class="col-lg-9" id="info-paket">
                        <div class="row" id="paket-container">
                            @foreach ($paket_deposits as $paket)
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <div class="card" id="{{ $paket->id }}">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h4 class="card-title">{{ $paket->nama }}</h4>
                                        <div>
                                            <h6 class="mb-2 d-flex justify-content-between nominal-paket">Nominal: <span class="thousand-separator">{{ $paket->nominal }}</span></h6>
                                            <h6 class="mb-2 text-muted d-flex justify-content-between harga-paket">Harga: <span class="thousand-separator">{{ $paket->harga }}</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 mb-3">
                                <div class="card" id="1">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h4 class="card-title mb-1">Manual</h4>
                                        <input id="input-manual" type="number" class="form-control mb-2" min="0" value="0" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="d-lg-none">
                    <div class="col-lg-3 border-lg-start border-0" id="info-pelanggan">
                        <form id="form-saldo" method="POST">
                            <div class="mb-2">
                                <h5>Pelanggan</h5>
                                <div>
                                    <input id="nama-pelanggan" list="data-pelanggan" class="form-control" required>
                                    <datalist id="data-pelanggan">
                                        @foreach ($pelanggans as $pelanggan)
                                            <option data-id="{{ $pelanggan->id }}">{{ $pelanggan->id }} - {{ $pelanggan->nama }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>
                            <div class="mb-2">
                                <h5>Saldo Akhir</h5>
                                <input id="input-saldo-akhir" type="text" class="form-control disabled" required />
                            </div>
                            <div class="mb-2">
                                <h5>Dibayarkan</h5>
                                <input id="input-dibayarkan" type="text" class="form-control disabled" required />
                            </div>
                            @if(in_array("Topup Saldo Pelanggan", Session::get('permissions')) || Session::get('role') == 'administrator')
                            <div class="text-end">
                                <button id="submit-saldo" class="btn btn-primary" type="submit">Beli</button>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('js/transaksi/saldo.js') }}"></script>
@endsection
