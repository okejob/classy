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
                        <div class="col-12 col-sm-6 col-md-4">
                            <h5>Telepon 1</h5><input class="form-control" type="text" name="telepon_1">
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <h5>Telepon 2</h5><input class="form-control" type="text" name="telepon_2">
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <h5>Nomor Fax</h5><input class="form-control" type="text" name="nomor_fax">
                        </div>
                        <div class="col-12">
                            <h5>Slogan</h5><input class="form-control" type="text" name="slogan">
                        </div>
                        <div class="col-12">
                            <h5>Logo Outlet</h5><input class="form-control" type="file" name="logo_outlet">
                        </div>
                    </div><button class="btn btn-primary float-end" type="submit"><i class="fas fa-save"></i>&nbsp;Simpan</button>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection
