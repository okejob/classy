@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Pengaturan</a><i class="fas fa-angle-right mx-2"></i><a>Pengaturan Karyawan</a></header>
    <section id="pengaturan-karyawan" class="mb-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pengaturan Data Karyawan</h4>
                <hr>
                <div class="table-responsive">
                    <table class="table" id="table-pengaturan-karyawan">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Telepon</th>
                                <th>E-mail</th>
                                <th>Outlet</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $karyawan)
                                <tr>
                                    <td>{{ $karyawan->username }}</td>
                                    <td>{{ $karyawan->name }}</td>
                                    <td class="text-center">{{ $karyawan->phone }}</td>
                                    <td>{{ $karyawan->email }}</td>
                                    <td class="text-center">{{ $karyawan->outlet->nama }}</td>
                                    <td class="text-center">{{ $karyawan->role }}</td>
                                    @if ($karyawan->status)
                                        <td class="text-center">Aktif</td>
                                    @else
                                        <td class="text-center">Tidak aktif</td>
                                    @endif
                                    <td class="cell-action">
                                        <button id="btn-{{ $karyawan->id }}"  class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button id="btn-add required" class="btn btn-primary" type="button"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</button>
                <ul class="list-unstyled form-control" id="list-action">
                    <li id="action-update">Rubah data</li>
                    <li id="action-change-password">Rubah password</li>
                </ul>
            </div>
        </div>

        <div class="modal fade" role="dialog" tabindex="-1" id="modal-data-user">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Rubah Data</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form-karyawan" method="POST" action>
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <h5>Username</h5>
                                    <input class="form-control" type="text" id="input-username" name="username">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Nama Lengkap</h5>
                                    <input class="form-control" type="text" id="input-nama" name="name">
                                </div>
                                <div class="col-12">
                                    <h5>Telepon</h5>
                                    <input class="form-control" type="text" id="input-telepon" name="phone">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>E-mail</h5>
                                    <input class="form-control" type="text" id="input-email" name="email">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Outlet</h5>
                                    <select class="form-select" id="input-outlet" name="outlet_id">
                                        <option value="" selected hidden>-</option>
                                        @foreach ($outlets as $outlet)
                                            <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h5>Role</h5>
                                    <select class="form-select" id="input-role" name="role">
                                        <option value="" selected hidden>-</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6" id="col-status">
                                    <h5>Status</h5>
                                    <div class="form-control d-flex justify-content-around" style="height: 38px;">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio-status-aktif" name="status" value=1 />
                                            <label class="form-check-label" for="radio-status-aktif">Aktif</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio-status-tidakAktif" name="status" value=0 />
                                            <label class="form-check-label" for="radio-status-tidakAktif">Tidak aktif</label>
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

        <div class="modal fade" role="dialog" tabindex="-1" id="modal-change-password">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Reset Password</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Password Lama</h5>
                                    <div class="form-container d-flex align-items-center">
                                        <input class="form-control" type="password" id="input-password-lama" required>
                                        <i class="fas fa-eye-slash"></i>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h5>Password Baru</h5>
                                    <div class="form-container d-flex align-items-center">
                                        <input class="form-control" type="password" id="input-password-baru" required>
                                        <i class="fas fa-eye-slash"></i>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h5>Konfirmasi Password Baru</h5>
                                    <div class="form-container d-flex align-items-center">
                                        <input class="form-control" type="password" id="input-konfirmasi" required>
                                        <i class="fas fa-eye-slash"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-danger d-none" role="alert">
                                <span id="error-msg"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="button" id="btn-change-password">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section id="pengaturan-hak-akses">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pengaturan Hak Akses</h4>
                <hr>
                <div class="d-flex align-items-center mb-3">
                    <p class="me-2">Role :</p><select class="form-select" style="width: initial;">
                        <option value="supervisor" selected="">Supervisor</option>
                        <option value="operator">Operator</option>
                        <option value="produksi">Produksi</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="check-pengaturan"><label class="form-check-label text-uppercase fw-bold" for="formCheck-1">Pengaturan</label></div>
                                <div class="ps-4">
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-pengaturan-outlet"><label class="form-check-label" for="formCheck-1">Outlet</label></div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-pengaturan-karyawan"><label class="form-check-label" for="formCheck-1">Karyawan &amp; Hak Akses</label></div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-pengaturan-paket"><label class="form-check-label" for="formCheck-1">Paket</label></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="check-data"><label class="form-check-label text-uppercase fw-bold" for="formCheck-1">master data</label></div>
                                <div class="ps-4">
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-pengaturan-outlet"><label class="form-check-label" for="formCheck-1">Item</label></div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-pengaturan-karyawan"><label class="form-check-label" for="formCheck-1">Kategori</label></div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-pengaturan-paket"><label class="form-check-label" for="formCheck-1">Parfum</label></div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-data-pelanggan"><label class="form-check-label" for="formCheck-1">Pelanggan</label></div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-pengaturan-paket-2"><label class="form-check-label" for="formCheck-1">Pengeluaran</label></div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-data-rewash"><label class="form-check-label" for="formCheck-1">Rewash</label></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card h-100">
                            <div class="card-body row">
                                <div class="col">
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-transaksi"><label class="form-check-label text-uppercase fw-bold" for="formCheck-1">transaksi</label></div>
                                    <div class="ps-4">
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="check-transaksi-cuci-premium"><label class="form-check-label" for="formCheck-1">Cuci Premium</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="check-transaksi-cuci-bucket"><label class="form-check-label" for="formCheck-1">Cuci Bucket</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="check-transaksi-cuci-kiloan"><label class="form-check-label" for="formCheck-1">Cuci Kiloan</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="check-transaksi-cuci-rewash"><label class="form-check-label" for="formCheck-1">Rewash</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="check-transaksi-pembayaran"><label class="form-check-label" for="formCheck-1">Pembayaran</label></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-2">
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="check-distribusi"><label class="form-check-label text-uppercase fw-bold" for="formCheck-1">distribusi</label></div>
                                        <div class="ps-4">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="check-distribusi-pickup"><label class="form-check-label" for="formCheck-1">Pick Up</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="check-distribusi-progress-cuci"><label class="form-check-label" for="formCheck-1">Progress Cuci</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="check-distribusi-delivery"><label class="form-check-label" for="formCheck-1">Delivery</label></div>
                                        </div>
                                    </div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-inventaris"><label class="form-check-label text-uppercase fw-bold" for="formCheck-1">inventaris</label></div>
                                </div>
                                <div class="col">
                                    <div class="mb-2">
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="check-deposit"><label class="form-check-label text-uppercase fw-bold" for="formCheck-1">Deposit</label></div>
                                        <div class="ps-4">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="check-deposit-pengisian"><label class="form-check-label" for="formCheck-1">Pengisian Deposit</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="check-deposit-pencarian"><label class="form-check-label" for="formCheck-1">Pencarian Deposit</label></div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" id="check-pembatalan"><label class="form-check-label text-uppercase fw-bold" for="formCheck-1">Pembatalan</label></div>
                                        <div class="ps-4">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="check-pembatalan-cuci"><label class="form-check-label" for="formCheck-1">Pembatalan Cuci</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" id="check-pembatalan-bayar"><label class="form-check-label" for="formCheck-1">Pembatalan Bayar</label></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="check-pengaturan-1"><label class="form-check-label text-uppercase fw-bold" for="formCheck-1">promosi</label></div>
                                <div class="ps-4">
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-promosi-cashback"><label class="form-check-label" for="formCheck-1">Cashback</label></div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-promosi-diskon-mingguan"><label class="form-check-label" for="formCheck-1">Diskon Mingguan</label></div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-promosi-diskon-member"><label class="form-check-label" for="formCheck-1">Diskon Member</label></div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-promosi-diskon-group"><label class="form-check-label" for="formCheck-1">Diskon Group Item</label></div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-promosi-diskon-item"><label class="form-check-label" for="formCheck-1">Diskon Item</label></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="form-check"><input class="form-check-input" type="checkbox" id="check-laporan"><label class="form-check-label text-uppercase fw-bold" for="formCheck-1">laporan</label></div>
                                <div class="ps-4">
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-laporan-cuci"><label class="form-check-label" for="formCheck-1">Cuci</label></div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-laporan-deposit"><label class="form-check-label" for="formCheck-1">Deposit</label></div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-laporan-pengeluaran"><label class="form-check-label" for="formCheck-1">Pengeluaran</label></div>
                                    <div class="form-check"><input class="form-check-input" type="checkbox" id="check-laporan-karyawan"><label class="form-check-label" for="formCheck-1">Karyawan</label></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end"><button class="btn btn-primary" type="button"><i class="fas fa-save"></i>&nbsp;Simpan</button></div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('js/pengaturan/karyawan.js') }}"></script>
@endsection
