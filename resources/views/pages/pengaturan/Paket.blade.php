@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Pengaturan</a><i class="fas fa-angle-right mx-2"></i><a>Pengaturan Paket</a></header>
    <section id="pengaturan-paket-cuci" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pengaturan Paket Cuci</h4>
                <hr />
                <div class="table-responsive">
                    <table class="table" id="table-paket-cuci">
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Deskripsi</th>
                                <th>Bobot</th>
                                <th colspan="2">Harga / bobot</th>
                                <th colspan="2">Harga</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data1 as $paket_cuci)
                            <tr>
                                <td>{{ $paket_cuci->nama_paket }}</td>
                                <td>{{ $paket_cuci->deskripsi }}</td>
                                <td class="text-center">{{ $paket_cuci->jumlah_bobot }}</td>
                                <td>Rp</td>
                                <td class="thousand-separator text-end">{{ $paket_cuci->harga_per_bobot }}</td>
                                <td>Rp</td>
                                <td class="thousand-separator text-end">{{ $paket_cuci->harga_paket }}</td>
                                @if ($paket_cuci->status)
                                    <td class="text-center">Aktif</td>
                                @else
                                    <td class="text-center">Tidak aktif</td>
                                @endif
                                <td class="cell-action">
                                    <button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary btn-add" type="button"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</button>
            </div>
            <ul class="list-unstyled form-control" id="list-action">
                <li id="action-update">Rubah data</li>
            </ul>
        </div>
        <div role="dialog" tabindex="-1" class="modal fade" id="modal-update-paket-cuci">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Paket Cuci</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Nama Paket</h5>
                                    <input type="text" class="form-control" id="input-nama-paket" name="username" />
                                </div>
                                <div class="col-12 col-lg-6">
                                    <h5>Bobot</h5>
                                    <input type="number" class="form-control" id="input-bobot-paket" step="1"/>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <h5>Harga Paket</h5>
                                    <input type="number" class="form-control" id="input-harga-paket" step="100" />
                                </div>
                                <div class="col-12">
                                    <h5>Deskripsi Paket</h5>
                                    <textarea class="form-control" id="input-deskripsi"></textarea>
                                </div>
                                <div class="col-12" id="col-status">
                                    <h5>Status</h5>
                                    <div class="form-control d-flex justify-content-around" style="height: 38px;">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio-status-aktif-1" name="status"/>
                                            <label class="form-check-label" for="radio-status-aktif-1">Aktif</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio-status-nonaktif-1" name="status"/>
                                            <label class="form-check-label" for="radio-status-nonaktif-1">Tidak aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"><button class="btn btn-primary" type="submit">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section id="pengaturan-paket-deposit">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pengaturan Paket Deposit</h4>
                <hr />
                <div class="table-responsive">
                    <table class="table" id="table-paket-deposit">
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Deskripsi</th>
                                <th colspan="2">Nominal</th>
                                <th colspan="2">Harga</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data2 as $paket_deposit)
                            <tr>
                                <td>{{ $paket_deposit->nama }}</td>
                                <td>{{ $paket_deposit->deskripsi }}</td>
                                <td>Rp</td>
                                <td class="text-end thousand-separator">{{ $paket_deposit->nominal }}</td>
                                <td>Rp</td>
                                <td class="text-end thousand-separator">{{ $paket_deposit->harga }}</td>
                                @if ($paket_deposit->status)
                                    <td class="text-center">Aktif</td>
                                @else
                                    <td class="text-center">Tidak aktif</td>
                                @endif
                                <td class="cell-action">
                                    <button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary btn-add" type="button"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</button>
            </div>
        </div>
        <div role="dialog" tabindex="-1" class="modal fade" id="modal-update-paket-deposit">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Paket Deposit</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Nama Paket</h5><input type="text" class="form-control" id="input-nama-paket" name="username" />
                                </div>
                                <div class="col-12 col-lg-6">
                                    <h5>Nominal</h5>
                                    <input type="number" class="form-control" id="input-nominal" step="100" />
                                </div>
                                <div class="col-12 col-lg-6">
                                    <h5>Harga Paket</h5>
                                    <input type="number" class="form-control" id="input-harga-paket" />
                                </div>
                                <div class="col-12">
                                    <h5>Deskripsi Paket</h5>
                                    <textarea class="form-control" id="input-deskripsi"></textarea>
                                </div>
                                <div class="col-12" id="col-status">
                                    <h5>Status</h5>
                                    <div class="form-control d-flex justify-content-around" style="height: 38px;">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio-status-aktif-2" name="status" />
                                            <label class="form-check-label" for="radio-status-aktif-2">Aktif</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio-status-nonaktif-2" name="status" />
                                            <label class="form-check-label" for="radio-status-nonaktif-2">Tidak aktif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('js/pengaturan/paket.js') }}"></script>
@endsection
