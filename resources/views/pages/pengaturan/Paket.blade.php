@extends('layouts.users')

@section('content')
@include('includes.datatables')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Pengaturan</a><i class="fas fa-angle-right mx-2"></i><a>Pengaturan Paket</a></header>
    <section id="pengaturan-paket">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pengaturan Data Paket</h4>
                <hr>
                <div class="table-responsive">
                    <table class="table" id="table-paket">
                        <thead>
                            <tr>
                                <th>Nama Paket</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Tgl Entry</th>
                                <th>Tgl Update</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Setrika 5 kg</td>
                                <td>20.000</td>
                                <td>Melayani setrika 5 kg</td>
                                <td>16 feb 2020 23:27:42</td>
                                <td>Cell 4</td>
                                <td>Freddy</td>
                                <td>Aktif</td>
                                <td class="cell-action"><button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button></td>
                            </tr>
                            <tr>
                                <td>Cuci Setrika 5 kg</td>
                                <td>40.000</td>
                                <td>Melayani cuci &amp; setrika 5 kg</td>
                                <td>16 feb 2020 23:27:42<br></td>
                                <td>Cell 4</td>
                                <td>Freddy</td>
                                <td>Aktif</td>
                                <td class="cell-action"><button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div><button class="btn btn-primary" type="button"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</button>
                <ul class="list-unstyled form-control" id="list-action">
                    <li id="action-update">Rubah data</li>
                    <li id="action-change-status">Rubah status</li>
                </ul>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-update">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Paket</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Nama Paket</h5><input class="form-control" type="text" id="input-nama-paket" name="username">
                                </div>
                                <div class="col-12">
                                    <h5>Harga Paket</h5><input class="form-control" type="number" id="input-harga-paket">
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

@endsection
