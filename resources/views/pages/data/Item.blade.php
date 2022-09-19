@extends('layouts.users')

@section('content')
@include('includes.datatables')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Master Data</a><i class="fas fa-angle-right mx-2"></i><a>Data Item</a></header>
    <section id="data-item">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Item</h4>
                <hr>
                <div class="table-responsive">
                    <table class="table" id="table-item">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Nama Item</th>
                                <th>Unit</th>
                                <th>Bobot Bucket</th>
                                <th>Harga Premium</th>
                                <th>Status Bucket</th>
                                <th>Status Kilo</th>
                                <th>Beban Produksi</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Bed Sheet</td>
                                <td>Sprei Besar</td>
                                <td>PCS</td>
                                <td>5.0</td>
                                <td>20.000</td>
                                <td>Aktif</td>
                                <td>Aktif</td>
                                <td>5.0</td>
                                <td>Aktif</td>
                                <td class="cell-action"><button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button></td>
                            </tr>
                            <tr>
                                <td>Celana</td>
                                <td>Celana Jeans</td>
                                <td>PCS</td>
                                <td>2.0</td>
                                <td>85.000</td>
                                <td>Tidak Akfif</td>
                                <td>Tidak Aktif</td>
                                <td>5.0</td>
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
                        <h4 class="modal-title">Rubah Data</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Kategori</h5><select class="form-select" id="update-kategori">
                                        <option value="bed_sheet">Bed Sheet</option>
                                        <option value="celana">Celana</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <h5>Nama Item</h5><input class="form-control" type="text" id="update-nama-item">
                                </div>
                                <div class="col-12">
                                    <h5>Unit</h5><select class="form-select" id="update-unit">
                                        <option value="pcs">PCS</option>
                                        <option value="kg">KG</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <h5>Bobot Bucket</h5><input class="form-control" type="number" id="update-bobot-bucket">
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <h5>Harga Premium</h5><input class="form-control" type="number" id="update-harga-premium">
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <h5>Beban Produksi</h5><input class="form-control" type="number" id="update-bobot-bucket-1">
                                </div>
                                <div class="col-12">
                                    <h5>Deskripsi</h5><textarea class="form-control" id="update-deskripsi" style="resize: none;"></textarea>
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

<script src="{{ asset('js/data/item.js') }}"></script>
@endsection
