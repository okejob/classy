@extends('layouts.users')

@section('content')
@include('includes.datatables')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Master Data</a><i class="fas fa-angle-right mx-2"></i><a>Data Pengeluaran</a></header>
    <section id="data-pengeluaran">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Pengeluaran</h4>
                <hr>
                <div class="table-responsive">
                    <table class="table" id="table-pengeluaran">
                        <thead>
                            <tr>
                                <th>Nama Pengeluaran</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Pembayaran PLN</td>
                                <td>Segala macam jenis pembayaran ke PLN (Token, Pasca bayar &amp; dll)</td>
                                <td>Aktif</td>
                                <td class="cell-action"><button class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button></td>
                            </tr>
                            <tr>
                                <td>Pembelian LPG</td>
                                <td>Segala macam jenis pembelian LPG</td>
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
                                    <h5>Nama Pengeluaran</h5><input class="form-control" type="text" id="input-nama-pengeluaran" name="username">
                                </div>
                                <div class="col-12">
                                    <h5>Deskripsi</h5><textarea class="form-control" id="input-deskripsi" style="resize: none;"></textarea>
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

<script src="{{ asset('js/data/pengeluaran.js') }}"></script>
@endsection
