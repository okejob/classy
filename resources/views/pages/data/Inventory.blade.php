@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);">
        <a>Master Data</a>
        <i class="fas fa-angle-right mx-2"></i>
        <a>Data Inventory</a>
    </header>
    <section id="data-inventory">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Item</h4>
                <hr>
                <div class="d-flex justify-content-end">
                    <form method="GET" action="/data/inventory" class="d-flex align-items-center">
                        Search :
                        <input class="form-control mx-1" type="search" name="search" style="max-width: 200px;">
                    </form>
                </div>
                <div class="table-responsive mb-2">
                    <table class="table table-striped" id="table-inventory">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventories as $inventory)
                            <tr>
                                <td>{{ $loop->index }}</td>
                                <td>{{ $inventory->nama }}</td>
                                <td class="text-center">{{ $inventory->jumlah }}</td>
                                <td class="cell-action">
                                    <button id="btn-{{ $inventory->id }}" class="btn btn-primary btn-sm btn-show-action" type="button">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $inventories->links() }}
                <button class="btn btn-primary btn-tambah mt-2" type="button">
                    <i class="fas fa-plus-circle"></i>
                    &nbsp;Tambah
                </button>
                <ul class="list-unstyled form-control" id="list-action">
                    <li id="action-update">Rubah data</li>
                    <li id="action-delete">Hapus data</li>
                </ul>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-inventory">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-lg-down" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Rubah Data</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="modal-form" action="/data/inventory" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Nama Item</h5>
                                    <input class="form-control" type="text" id="input-nama-inventory" name="nama" required>
                                </div>
                                <div class="col-12">
                                    <h5>Jumlah</h5>
                                    <input class="w-100 me-2" type="number" id="input-jumlah" name="jumlah" required>
                                </div>
                                <div class="col-12">
                                    <h5>Status Item</h5>
                                    <div class="form-control d-flex align-items-center justify-content-around">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-aktif" name="status" value=1 />
                                            <label class="form-check-label" for="formCheck-aktif">Aktif</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-tidakAktif" name="status" value=0 />
                                            <label class="form-check-label" for="formCheck-tidakAktif">Tidak aktif</label>
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

<script src="{{ asset('js/data/inventory.js') }}"></script>
@endsection
