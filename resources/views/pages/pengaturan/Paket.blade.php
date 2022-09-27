@extends('layouts.users')

@section('content')
@include('includes.datatables')

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
                                <th>Harga</th>
                                <th>Harga/kg</th>
                                <th>Bobot</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Setrika 5 kg</td>
                                <td>Melayani setrika 5 kg</td>
                                <td>30.000</td>
                                <td>6.000</td>
                                <td>5</td>
                                <td>Freddy</td>
                                <td>Aktif</td>
                                <td class="cell-action"><button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button></td>
                            </tr>
                            <tr>
                                <td>Cuci Setrika 5 kg</td>
                                <td>Melayani cuci &amp; setrika 5 kg</td>
                                <td>50.000</td>
                                <td>5.000</td>
                                <td>10</td>
                                <td>Freddy</td>
                                <td>Aktif</td>
                                <td class="cell-action"><button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div><button class="btn btn-primary" type="button"><i class="fas fa-plus-circle"></i> Tambah</button>
                <ul class="list-unstyled form-control" id="list-action">
                    <li id="action-update">Rubah data</li>
                    <li id="action-change-status">Rubah status</li>
                </ul>
            </div>
        </div>
        <div role="dialog" tabindex="-1" class="modal fade" id="modal-update-paket-cuci">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Paket Cuci</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Nama Paket</h5><input type="text" class="form-control" id="input-nama-paket" name="username" />
                                </div>
                                <div class="col-12 col-lg-6">
                                    <h5>Harga Paket</h5><input type="number" class="form-control" id="input-harga-paket" step="100" />
                                </div>
                                <div class="col-12 col-lg-6">
                                    <h5>Bobot</h5><input type="number" class="form-control" id="input-bobot-paket" />
                                </div>
                                <div class="col-12">
                                    <h5>Deskripsi Paket</h5><textarea class="form-control" id="input-deskripsi"></textarea>
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
                                <th>Harga</th>
                                <th>Nominal</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Deposit 500K</td>
                                <td>Deposit 500K bonus 50K</td>
                                <td>500.000</td>
                                <td>550.000</td>
                                <td>Freddy</td>
                                <td>Aktif</td>
                                <td class="cell-action"><button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button></td>
                            </tr>
                            <tr>
                                <td>Deposit 100K</td>
                                <td>Pengisian deposit 100K</td>
                                <td>95.000</td>
                                <td>100.000</td>
                                <td>Freddy</td>
                                <td>Aktif</td>
                                <td class="cell-action"><button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div><button class="btn btn-primary" type="button"><i class="fas fa-plus-circle"></i> Tambah</button>
            </div>
        </div>
        <div role="dialog" tabindex="-1" class="modal fade" id="modal-update-paket-deposit">
            <div class="modal-dialog modal-lg" role="document">
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
                                    <h5>Nominal</h5><input type="number" class="form-control" id="input-nominal" step="100" />
                                </div>
                                <div class="col-12 col-lg-6">
                                    <h5>Harga Paket</h5><input type="number" class="form-control" id="input-harga-paket" />
                                </div>
                                <div class="col-12">
                                    <h5>Deskripsi Paket</h5><textarea class="form-control" id="input-deskripsi"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer"><button class="btn btn-primary" type="submit">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('js/pengaturan/paket.js') }}"></script>
@endsection
