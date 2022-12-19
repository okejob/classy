@extends('layouts.users')

@section('content')
<div class="container">
    <header class="my-3" style="color: var(--bs-gray);">
        <a>Transaksi</a>
        <i class="fas fa-angle-right mx-2"></i>
        <a>Pickup &amp; Delivery</a>
    </header>
    <ul role="tablist" class="nav nav-tabs" style="border-bottom: none;">
        <li role="presentation" class="nav-item"><a role="tab" data-bs-toggle="tab" class="nav-link active" href="#tab-1">Data</a></li>
        <li role="presentation" class="nav-item"><a role="tab" data-bs-toggle="tab" class="nav-link" href="#tab-2">Task Hub</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab-1">
            <div class="card">
                <div class="card-body">
                    <section id="section-pickup" class="mb-4">
                        <h4>Pickup</h4>
                        <hr />
                        <div id="table-pickup"></div>
                        <div class="text-end mt-3">
                            <button id="create-pickup" class="btn btn-primary">Pickup Baru</button>
                        </div>
                    </section>
                    <hr style="margin: 1rem -1rem;" />
                    <section id="section-delivery" class="mb-4">
                        <h4>Delivery</h4>
                        <hr />
                        <div id="table-delivery"></div>
                        <div class="text-end mt-3">
                            <button id="create-delivery" class="btn btn-primary">Delivery Baru</button>
                        </div>
                    </section>
                    <hr style="margin: 1rem -1rem;" />
                    <section id="section-ambil-outlet" class="mb-4">
                        <h4>Ambil di outlet</h4>
                        <hr />
                        <div id="table-di-outlet"></div>
                    </section>
                </div>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="tab-2">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-xl-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Nama Driver</h4>
                                    <hr />
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Action</th>
                                                    <th>Time</th>
                                                    <th>Alamat</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">Pick up</td>
                                                    <td>09.00</td>
                                                    <td>Jl Kusuma Bangsa</td>
                                                    <td class="text-center">not done</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div role="dialog" tabindex="-1" class="modal fade" id="modal-create-pickup">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Pickup</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/transaksi/pickup-delivery" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <h5>Pilih Pelanggan</h5>
                                <select class="form-control" name="pelanggan_id" required >
                                    <option value="" selected hidden>-</option>
                                    @foreach ($dataPelanggan as $pelanggan)
                                        <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-2">
                                <h5>Pilih Driver</h5>
                                <select class="form-control" name="driver_id" required >
                                    <option value="" selected hidden>-</option>
                                    @foreach ($dataDriver as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-2">
                                <h5>Alamat</h5>
                                <input type="text" class="form-control" name="alamat" required />
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="pickup">
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div role="dialog" tabindex="-1" class="modal fade" id="modal-create-delivery">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Delivery</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/transaksi/pickup-delivery" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 mb-2" id="col-transaksi">
                                <h5>Pilih Transaksi</h5>
                                <select class="form-control" name="transaksi_id" required >
                                    <option value="" selected hidden>-</option>
                                    @foreach ($dataTransaksi as $trans)
                                        @if($trans->kode != '')
                                            <option value="{{ $trans->id }}">{{ $trans->kode }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-2">
                                <h5>Pilih Driver</h5>
                                <select class="form-control" name="driver_id" required >
                                    <option value="" selected hidden>-</option>
                                    @foreach ($dataDriver as $driver)
                                        <option value="{{ $driver->id }}">{{ $driver->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-2">
                                <h5>Alamat</h5>
                                <input type="text" class="form-control" name="alamat" required />
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="action" value="delivery">
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/transaksi/pickupDelivery.js') }}"></script>
@endsection
