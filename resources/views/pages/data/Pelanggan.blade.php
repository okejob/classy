@extends('layouts.users')

@section('content')
@include('includes.datatables')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Master Data</a><i class="fas fa-angle-right mx-2"></i><a>Data Pelanggan</a></header>
    <section id="data-pelanggan">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Pelanggan</h4>
                <hr>
                <div class="table-responsive">
                    <table class="table" id="table-pelanggan">
                        <thead>
                            <tr>
                                <th>Outlet</th>
                                <th>Member</th>
                                <th>Nama<br>Lengkap</th>
                                <th>Alamat</th>
                                <th>Telp 1</th>
                                <th>Telp 2</th>
                                <th>E-mail</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>CLD</td>
                                <td>Member A</td>
                                <td>Herman Sentosa</td>
                                <td>Jl. Teratai 1 Surabaya</td>
                                <td>08123456789</td>
                                <td>-</td>
                                <td>herman@gmail.com</td>
                                <td>Aktif</td>
                                <td class="cell-action"><button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button class="btn btn-primary btn-tambah" type="button">
                    <i class="fas fa-plus-circle"></i>
                    &nbsp;Tambah
                </button>
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
                        <h4 class="modal-title">Data Pelanggan</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>ID Member</h5><input class="form-control" type="text" id="input-memberID">
                                </div>
                                <div class="col-12">
                                    <h5>Nama Lengkap</h5><input class="form-control" type="text" id="input-nama-pelanggan" name="username">
                                </div>
                                <div class="col-12">
                                    <h5>Alamat</h5><input class="form-control" type="text" id="input-alamat">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Telepon 1</h5><input class="form-control" type="text" id="input-telepon1">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Telepon 2</h5><input class="form-control" type="text" id="input-telepon2">
                                </div>
                                <div class="col-12">
                                    <h5>E-mail</h5><input class="form-control" type="text" id="input-email">
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <h5>Parfum Favorit</h5><select class="form-select" id="input-parfum">
                                        <option value="parfum_a">Parfum A</option>
                                        <option value="parfum_b">Parfum B</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <h5>Jenis Identitas</h5><select class="form-select" id="input-jenis-identitas">
                                        <option value="identitas_a">Identitas A</option>
                                        <option value="identitas_b">Identitas B</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <h5>Nomor Identitas</h5><input class="form-control" type="text" id="input-nomor-identitas">
                                </div>
                                <div class="col-12">
                                    <h5>Tanggal Lahir</h5><input class="form-control" id="input-tanggal-lahir" type="date">
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

<script src="{{ asset('js/data/pelanggan.js') }}"></script>
@endsection
