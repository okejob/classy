@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Master Data</a><i class="fas fa-angle-right mx-2"></i><a>Data Item</a></header>
    <section id="data-item">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Item</h4>
                <hr>
                <div class="d-flex justify-content-end">
                    <form method="GET" action="/data/jenis-item" class="d-flex align-items-center">
                        Search :
                        <input class="form-control mx-1" type="search" name="search" style="max-width: 200px;">
                    </form>
                </div>
                <div class="table-responsive mb-2">
                    <table class="table table-striped" id="table-item">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Nama Item</th>
                                <th>Unit</th>
                                <th>Bobot Bucket</th>
                                <th>Harga Kilo</th>
                                <th>Harga Bucket</th>
                                <th>Harga Premium</th>
                                <th>Status Kilo</th>
                                <th>Status Bucket</th>
                                <th>Status Premium</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data1 as $item)
                            <tr>
                                <td>{{ $item->kategori->nama }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->unit }}</td>
                                <td>{{ $item->bobot_bucket }}</td>
                                <td>{{ $item->harga_kilo }}</td>
                                <td>{{ $item->harga_bucket }}</td>
                                <td>{{ $item->harga_premium }}</td>
                                @if ($item->status_kilo)
                                    <td>Aktif</td>
                                @else
                                    <td>Tidak aktif</td>
                                @endif
                                @if ($item->status_bucket)
                                    <td>Aktif</td>
                                @else
                                    <td>Tidak aktif</td>
                                @endif
                                @if ($item->status_premium)
                                    <td>Aktif</td>
                                @else
                                    <td>Tidak aktif</td>
                                @endif
                                @if ($item->status_item)
                                    <td>Aktif</td>
                                @else
                                    <td>Tidak aktif</td>
                                @endif
                                <td class="cell-action">
                                    <button id="btn-{{ $item->id }}" class="btn btn-primary btn-sm btn-show-action" type="button">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $data1->links() }}
                <button class="btn btn-primary btn-tambah mt-2" type="button">
                    <i class="fas fa-plus-circle"></i>
                    &nbsp;Tambah
                </button>
                <ul class="list-unstyled form-control" id="list-action">
                    <li id="action-update">Rubah data</li>
                </ul>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-update">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Rubah Data</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="modal-form" action="/data/jenis-item" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Kategori</h5>
                                    <select class="form-select" id="input-kategori" name="kategori_id">
                                        <option value='' disabled selected hidden>-</option>
                                        @foreach ($data2 as $kategori)
                                            <option value={{ $kategori->id }}>{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <h5>Nama Item</h5>
                                    <input class="form-control" type="text" id="input-nama-item" name="nama">
                                </div>
                                <div class="col-12">
                                    <h5>Unit</h5>
                                    <select class="form-select" id="input-unit" name="unit">
                                        <option value="pcs">PCS</option>
                                        <option value="kg">KG</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Bobot Bucket</h5>
                                    <input class="form-control" type="number" id="input-bobot-bucket" name="bobot_bucket">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Harga Kilo</h5>
                                    <input class="form-control" type="number" id="input-harga-kilo" name="harga_kilo">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Harga Bucket</h5>
                                    <input class="form-control" type="number" id="input-harga-bucket" name="harga_bucket">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Harga Premium</h5>
                                    <input class="form-control" type="number" id="input-harga-premium" name="harga_premium">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Status Kilo</h5>
                                    <div class="form-control d-flex align-items-center justify-content-around">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-kilo-aktif" name="status_kilo" value=1 />
                                            <label class="form-check-label" for="formCheck-kilo-aktif">Aktif</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-kilo-tidakAktif" name="status_kilo" value=0 />
                                            <label class="form-check-label" for="formCheck-kilo-tidakAktif">Tidak aktif</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Status Bucket</h5>
                                    <div class="form-control d-flex align-items-center justify-content-around">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-bukcet-aktif" name="status_bucket" value=1 />
                                            <label class="form-check-label" for="formCheck-bukcet-aktif">Aktif</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-bukcet-tidakAktif" name="status_bucket" value=0 />
                                            <label class="form-check-label" for="formCheck-bukcet-tidakAktif">Tidak aktif</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Status Premium</h5>
                                    <div class="form-control d-flex align-items-center justify-content-around">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-premium-aktif" name="status_premium" value=1 />
                                            <label class="form-check-label" for="formCheck-premium-aktif">Aktif</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-premium-tidakAktif" name="status_premium" value=0 />
                                            <label class="form-check-label" for="formCheck-premium-tidakAktif">Tidak aktif</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Status Item</h5>
                                    <div class="form-control d-flex align-items-center justify-content-around">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-item-aktif" name="status_item" value=1 />
                                            <label class="form-check-label" for="formCheck-item-aktif">Aktif</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-item-tidakAktif" name="status_item" value=0 />
                                            <label class="form-check-label" for="formCheck-item-tidakAktif">Tidak aktif</label>
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

<script src="{{ asset('js/data/item.js') }}"></script>
@endsection
