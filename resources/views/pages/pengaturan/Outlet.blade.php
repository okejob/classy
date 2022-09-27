@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Pengaturan</a><i class="fas fa-angle-right mx-2"></i><a>Pengaturan Outlet</a></header>
    <section id="pengaturan-outlet">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pengaturan Data Outlet</h4>
                <hr>
                <form>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h5>Kode Outlet</h5><input class="form-control" type="text" name="kode_outlet">
                        </div>
                        <div class="col-12 col-sm-6">
                            <h5>Nama Outlet</h5><input class="form-control" type="text" name="nama_outlet">
                        </div>
                        <div class="col-12">
                            <h5>Alamat lengkap</h5><input class="form-control" type="text" name="alamat">
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <h5>Telepon 1</h5><input class="form-control" type="text" name="telepon_1">
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <h5>Telepon 2</h5><input class="form-control" type="text" name="telepon_2">
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <h5>Nomor Fax</h5><input class="form-control" type="text" name="nomor_fax">
                        </div>
                        <div class="col-12 col-sm-6 col-lg-3">
                        <h5>Status</h5>
                        <div class="form-control d-flex justify-content-around" style="height: 38px;">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="radio-status-aktif" />
                                <label class="form-check-label" for="radio-status-aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="radio-status-nonaktif" />
                                <label class="form-check-label" for="radio-status-nonaktif">Non-aktif</label>
                            </div>
                        </div>
                    </div>
                    </div><button class="btn btn-primary float-end" type="submit"><i class="fas fa-save"></i>&nbsp;Simpan</button>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection
