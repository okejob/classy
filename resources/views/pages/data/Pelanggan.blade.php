@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Master Data</a><i class="fas fa-angle-right mx-2"></i><a>Data Pelanggan</a></header>
    <section id="data-pelanggan">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Pelanggan</h4>
                <hr>
                <div class="d-flex justify-content-end">
                    <div class="d-flex align-items-center">
                        Search :
                        <input class="form-control mx-1" id="input-search" type="search" name="search" style="max-width: 200px;">
                    </div>
                </div>
                <div id="table-pelanggan"></div>
                <button class="btn btn-primary btn-tambah mt-2" type="button">
                    <i class="fas fa-plus-circle"></i>
                    &nbsp;Tambah
                </button>
                <ul class="list-unstyled form-control" id="list-action">
                    <li id="action-detail">Detail pelanggan</li>
                    <li id="action-delete">Hapus data</li>
                </ul>
            </div>
        </div>

        <div class="modal fade" role="dialog" tabindex="-1" id="modal-update">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Pelanggan</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="modal-form" action="/data/pelanggan" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Nama Lengkap</h5>
                                    <input class="form-control" type="text" id="input-nama-pelanggan" name="nama" required>
                                </div>
                                <div class="col-12">
                                    <h5>Alamat</h5>
                                    <input class="form-control" type="text" id="input-alamat" name="alamat" required>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <h5>Tanggal Lahir</h5>
                                    <input class="form-control" id="input-tanggal-lahir" type="date" name="tanggal_lahir" required>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <h5>Tipe Member</h5>
                                    <div class="form-control d-flex align-items-center justify-content-around">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-member" name="member" value=1 required />
                                            <label class="form-check-label" for="formCheck-member">Member</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-non-member" name="member" value=0 />
                                            <label class="form-check-label" for="formCheck-non-member">Bukan member</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Jenis Identitas</h5>
                                    <select class="form-select" id="input-jenis-identitas" name="jenis_id" required>
                                        <option value='' disabled selected hidden>-</option>
                                        <option value="ktp">KTP</option>
                                        <option value="sim">SIM</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Nomor Identitas</h5>
                                    <input class="form-control" type="text" id="input-nomor-identitas" name="no_id" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                                <div class="col-12 col-lg-4 col-sm-6">
                                    <h5>Telephone</h5>
                                    <input class="form-control" type="text" id="input-telepon" name="telephone" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </div>
                                <div class="col-12 col-lg-4 col-sm-6">
                                    <h5>E-mail</h5>
                                    <input class="form-control" type="text" id="input-email" name="email" required>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <h5>Status</h5>
                                    <div class="form-control d-flex align-items-center justify-content-around">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="formCheck-aktif" name="status" value=1 required />
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
                        <div class="modal-footer"><button class="btn btn-primary" type="submit">Simpan</button></div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</div>

<script src="{{ asset('js/data/pelanggan.js') }}"></script>
@endsection
