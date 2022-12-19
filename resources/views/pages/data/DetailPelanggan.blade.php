@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Master Data</a><i class="fas fa-angle-right mx-2"></i><a>Data Pelanggan</a></header>
    <section id="data-pelanggan" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Pelanggan</h4>
                <hr>
                <form id="modal-form" action="/data/pelanggan/{{ $pelanggan->id }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-2 disabled">
                            <h5>Nama Lengkap*</h5>
                            <input class="form-control" type="text" id="input-nama-pelanggan" name="nama" value="{{ $pelanggan->nama }}" required>
                        </div>
                        <div class="col-12 mb-2 disabled">
                            <h5>Alamat*</h5>
                            <input class="form-control" type="text" id="input-alamat" name="alamat" value="{{ $pelanggan->alamat }}" required>
                        </div>
                        <div class="col-12 col-lg-6 mb-2 disabled">
                            <h5>Tanggal Lahir</h5>
                            <input class="form-control" id="input-tanggal-lahir" type="date" name="tanggal_lahir" value="{{ $pelanggan->tanggal_lahir }}" >
                        </div>
                        <div class="col-12 col-lg-6 mb-2 disabled">
                            <h5>Tipe Member</h5>
                            <div class="form-control d-flex align-items-center justify-content-around">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="formCheck-member" name="member" value=1 @if ($pelanggan->member) checked @endif required />
                                    <label class="form-check-label" for="formCheck-member">Member</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="formCheck-non-member" name="member" value=0 @if (!$pelanggan->member) checked @endif />
                                    <label class="form-check-label" for="formCheck-non-member">Bukan member</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mb-2 disabled">
                            <h5>Jenis Identitas</h5>
                            <select class="form-select" id="input-jenis-identitas" name="jenis_id" value="{{ $pelanggan->jenis_id }}" >
                                <option value='' disabled hidden>-</option>
                                <option value="ktp">KTP</option>
                                <option value="sim">SIM</option>
                            </select>
                        </div>
                        <div class="col-12 col-sm-6 mb-2 disabled">
                            <h5>Nomor Identitas</h5>
                            <input class="form-control" type="text" id="input-nomor-identitas" name="no_id" value="{{ $pelanggan->no_id }}"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <div class="col-12 col-lg-4 col-sm-6 mb-2 disabled">
                            <h5>Telephone*</h5>
                            <input class="form-control" type="text" id="input-telepon" name="telephone" value="{{ $pelanggan->telephone }}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                        <div class="col-12 col-lg-4 col-sm-6 mb-2 disabled">
                            <h5>E-mail</h5>
                            <input class="form-control" type="text" id="input-email" name="email" value="{{ $pelanggan->email }}" >
                        </div>
                        <div class="col-12 col-lg-4 mb-2 disabled">
                            <h5>Status</h5>
                            <div class="form-control d-flex align-items-center justify-content-around">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="formCheck-aktif" name="status" value=1 @if ($pelanggan->status) checked @endif required />
                                    <label class="form-check-label" for="formCheck-aktif">Aktif</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="formCheck-tidakAktif" name="status" value=0 @if (!$pelanggan->status) checked @endif />
                                    <label class="form-check-label" for="formCheck-tidakAktif">Tidak aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-end">
                        <button class="btn btn-primary" id="btn-ubah" type="button">Ubah Data</button>
                        <button class="btn btn-primary" type="submit" style="display: none;">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section id="data-transaksi" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Transaksi</h4>
                <hr>
                <div class="table-responsive mb-2">
                    <table class="table table-striped" id="table-transaksi">
                        <thead>
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>Outlet</th>
                                <th colspan="2" style="width: 15%;">Total</th>
                                <th>Status</th>
                                <th colspan="2" style="width: 15%;">Terbayar</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksis as $transaksi)
                            <tr>
                                <td>{{ $transaksi->kode }}</td>
                                <td>{{ $transaksi->outlet->nama }}</td>
                                <td>Rp</td>
                                <td class="text-end thousand-separator">{{ $transaksi->grand_total }}</td>
                                @if ($transaksi->lunas)
                                    <td class="text-center">Lunas</td>
                                @else
                                    <td class="text-center">Belum lunas</td>
                                @endif
                                <td>Rp</td>
                                <td class="text-end thousand-separator">{{ $transaksi->total_terbayar }}</td>
                                <td class="cell-action">
                                    <button id="btn-{{ $transaksi->id }}" class="btn btn-primary btn-sm btn-show-action" type="button">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $transaksis->links() }}
            </div>
        </div>
    </section>

    <section id="data-saldo">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Saldo</h4>
                <hr>
                <div class="table-responsive mb-2">
                    <table class="table table-striped" id="table-pelanggan">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Jenis Input</th>
                                <th colspan="2" style="width: 15%;">Nominal</th>
                                <th colspan="2" style="width: 15%;">Saldo Akhir</th>
                                <th></th>
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
                                <td class="cell-action">
                                    <button id="btn-{{ $saldo->id }}" class="btn btn-primary btn-sm btn-show-action" type="button">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $transaksis->links() }}
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('js/data/detailPelanggan.js') }}"></script>
@endsection
