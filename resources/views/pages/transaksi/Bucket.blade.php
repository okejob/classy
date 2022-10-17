@extends('layouts.users')

@section('content')
<div class="container">
    <header class="my-3 d-flex justify-content-between" style="color: var(--bs-gray);">
        <div class="d-flex align-items-center">
            <a>Transaksi</a>
            <i class="fas fa-angle-right mx-2"></i>
            <a>Cuci Bucket</a>
        </div>
        <button class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bss-tooltip="" id="show-option" type="button" title="Show options">
            <i class="fas fa-cog"></i>
        </button>
    </header>
    <section id="section-transaksi-cuci">
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-opsi-trans">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Opsi Transaksi</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex mb-3">
                            <input class="form-control" type="search" id="input-id-trans" placeholder="ID Transaksi">
                            <button class="btn btn-primary mx-3" data-bs-toggle="tooltip" data-bss-tooltip="" id="search-id-trans" type="button" title="Cari transaksi">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-primary" data-bs-toggle="tooltip" data-bss-tooltip="" id="add-new-trans" type="button" title="Buat transaksi baru">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="table-list-trans">
                                <thead class="text-center">
                                    <tr>
                                        <th>ID Transaksi</th>
                                        <th>Outlet</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Nama Pelanggan</th>
                                        <th colspan="2">Harga Total</th>
                                        <th>Lunas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['last_transaksi'] as $trans)
                                    <tr data-bs-toggle="tooltip" data-bss-tooltip="" title="Double klik untuk memilih">
                                        <td>{{ $trans->id }}</td>
                                        <td>{{ $trans->outlet->nama }}</td>
                                        <td class="text-center">{{ $trans->created_at }}</td>
                                        <td>{{ $trans->pelanggan->nama }}</td>
                                        <td>Rp</td>
                                        <td class="text-end thousand-separator">{{ $trans->grand_total }}</td>
                                        <td class="text-center">
                                        @if($trans->lunas)
                                            Lunas
                                        @else
                                            Belum Lunas
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <header>
                            <div class="d-flex justify-content-between align-items-center">
                                <h3>ID Transaksi : <span id="id-trans" style="display: none;">{{ $data['transaksi_id'] }}</span></h3>
                                <button class="btn btn-sm large" id="expand-table" type="button">
                                    <i class="fas fa-expand-alt"></i>
                                </button>
                            </div>
                        </header>
                        <div class="table-responsive my-2">
                            <table class="table table-striped mb-0" id="table-trans-item">
                                <thead>
                                    <tr>
                                        <th>Nama Item</th>
                                        <th>Kategori</th>
                                        <th>Pencuci</th>
                                        <th>Penyetrika</th>
                                        <th>Proses</th>
                                        <th>Catatan</th>
                                        <th>Bobot</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Item 1</td>
                                        <td>Kategori 1</td>
                                        <td>Si mbah</td>
                                        <td>Si mbah</td>
                                        <td>Sedang setrika</td>
                                        <td class="text-center" style="padding-top: 4px;padding-bottom: 4px;">
                                            <button class="btn btn-primary btn-sm" type="button">Catatan</button>
                                        </td>
                                        <td>5</td>
                                    </tr>
                                    <tr>
                                        <td>Item 2</td>
                                        <td>Kategori 1</td>
                                        <td>Si mbah</td>
                                        <td>Si mbah</td>
                                        <td>Sedang cuci</td>
                                        <td class="text-center" style="padding-top: 4px;padding-bottom: 4px;">
                                            <button class="btn btn-primary btn-sm" type="button">Catatan</button>
                                        </td>
                                        <td>10</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="7" style="padding-top: 4px;padding-bottom: 4px;">
                                            <button class="btn btn-primary btn-sm" type="button">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-end" colspan="6">Sub Total</td>
                                        <td>60000</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end" colspan="6">Diskon</td>
                                        <td>5000</td>
                                    </tr>
                                    <tr>
                                        <td class="text-end" colspan="6">Grand Total</td>
                                        <td>55000</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-4 p-2">
                                <h5>Parfum</h5>
                                <select class="form-select-sm form-control" style="max-width: 200px;">
                                    <option value="" selected hidden>-</option>
                                    @foreach ($data['parfum'] as $parfum)
                                        <option value="{{ $parfum->id }}">{{ $parfum->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4 p-2">
                                <div class="d-flex justify-content-center align-items-center h-100">
                                    <div class="form-check me-1">
                                        <input class="form-check-input" type="checkbox" id="formCheck-express">
                                        <label class="form-check-label" for="formCheck-express">Express</label>
                                    </div>
                                    <div class="form-check ms-1">
                                        <input class="form-check-input" type="checkbox" id="formCheck-setrika">
                                        <label class="form-check-label" for="formCheck-setrika">Setrika only</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 p-2">
                                <div class="d-flex justify-content-end align-items-center h-100"><button class="btn btn-primary" type="button" style="width: 200px;">Informasi Pengambilan</button></div>
                            </div>
                            <div class="col-6 p-2 d-flex align-items-center">
                                <div class="position-relative w-100"><button class="btn btn-primary" id="show-catatan-trans" type="button" style="width: 200px;">Catatan Transaksi</button>
                                    <div class="position-absolute mt-1 w-100 card p-2" style="z-index: 1;display: none;">
                                        <textarea class="form-control"></textarea>
                                        <button class="btn btn-primary" id="save-catatan-trans" type="button">Simpan Catatan</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3 p-2 d-flex align-items-center">
                                <div class="position-relative text-center w-100">
                                    <button class="btn btn-primary" type="button">Kode Promosi</button>
                                </div>
                            </div>
                            <div class="col-3 p-2 d-flex align-items-center">
                                <div class="position-relative text-end w-100">
                                    <button id="save-trans" class="btn btn-primary" type="button">Simpan Transaksi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <section id="section-info-pelanggan">
                            <header class="d-flex justify-content-between align-items-center">
                                <h5>Pelanggan</h5><button class="btn show-data" id="show-data-pelanggan" type="button"><i class="fas fa-chevron-down large"></i></button>
                            </header>
                            <div id="info-pelanggan" class="mt-2" style="display: none;"><button class="btn btn-primary mb-2" id="search-pelanggan" type="button"><i class="fas fa-search"></i>&nbsp;Cari Pelanggan</button>
                                <div class="modal fade" role="dialog" tabindex="-1" id="modal-list-pelanggan">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Cari Pelanggan</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="mb-3">
                                                    <div class="d-flex"><input class="form-control" type="search" id="input-nama-pelanggan" placeholder="Nama Pelanggan"><button class="btn btn-primary mx-3" data-bs-toggle="tooltip" data-bss-tooltip="" id="search-nama-pelanggan" type="button" title="Cari transaksi"><i class="fas fa-search"></i></button><button class="btn btn-primary" data-bs-toggle="tooltip" data-bss-tooltip="" id="add-new-pelanggan" type="button" title="Buat transaksi baru"><i class="fas fa-plus"></i></button></div>
                                                </form>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-hover" id="table-list-pelanggan">
                                                        <thead class="text-center">
                                                            <tr>
                                                                <th>Nama</th>
                                                                <th>Tanggal Lahir</th>
                                                                <th>Alamat</th>
                                                                <th>Membership</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data['pelanggan'] as $pelanggan)
                                                            <tr data-bs-toggle="tooltip" data-bss-tooltip="" title="Double klik untuk memilih">
                                                                <td>{{ $pelanggan->nama }}</td>
                                                                <td class="text-center">{{ $pelanggan->tanggal_lahir }}</td>
                                                                <td>{{ $pelanggan->alamat }}</td>
                                                                <td class="text-center">
                                                                @if($pelanggan->member)
                                                                    Member
                                                                @else
                                                                    Bukan member
                                                                @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form id="data-pelanggan" style="display: none;">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <h5>Nama</h5>
                                            <input class="form-control" type="text" id="input-nama-pelanggan-1" name="username" readonly="">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <h5>Alamat</h5>
                                            <input class="form-control" type="text" id="input-alamat" readonly="">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <h5>Telepon</h5>
                                            <input class="form-control" type="text" id="input-telepon1" readonly="">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <h5>E-mail</h5>
                                            <input class="form-control" type="text" id="input-email" readonly="">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <h5>Tanggal Lahir</h5>
                                            <input class="form-control" id="input-tanggal-lahir" type="date" readonly="">
                                        </div>
                                        <div class="col-12">
                                            <h5>Catatan Pelanggan</h5>
                                            <textarea class="form-control" style="resize: none;"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                        <hr style="margin: 1rem -1rem;">
                        <section id="section-info-outlet">
                            <header>
                                <h5 class="d-flex justify-content-between align-items-center">Outlet<button class="btn show-data" id="show-data-outlet" type="button"><i class="fas fa-chevron-down large"></i></button></h5>
                            </header>
                            <div id="info-outlet" class="position-relative mt-2" style="display: none;">
                                <h5>Outlet input</h5><select class="form-control">
                                    <option value="">-</option>
                                    @foreach ($data['outlet'] as $outlet)
                                        <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
                                    @endforeach
                                </select>
                                <h5 class="mt-2">Alamat Outlet</h5><input type="text" class="form-control" readonly="">
                            </div>
                        </section>
                        <hr style="margin: 1rem -1rem;">
                        <section id="section-info-pickup-delivery">
                            <header class="d-flex justify-content-between align-items-center">
                                <h5 class="d-flex justify-content-between align-items-center">Pickup &amp; Delivery</h5><button class="btn show-data" id="show-data-pickup-delivery" type="button"><i class="fas fa-chevron-down large"></i></button>
                            </header>
                            <div id="info-pickup-delivery" class="mt-2" style="display: none;">
                                <div class="form-check" id="check-pickup" style="margin-bottom: .5rem;"><input class="form-check-input" type="checkbox" id="formCheck-delivery"><label class="form-check-label" for="formCheck-delivery">Pickup</label></div>
                                <div id="container-pickup" class="position-relative mb-2" style="display: none;">
                                    <h5>Nama driver</h5><select class="form-control">
                                        <option value="">-</option>
                                        @foreach ($data['driver'] as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->nama }}</option>
                                        @endforeach
                                    </select>
                                    <h5 class="mt-2">Alamat ambil</h5><input type="text" class="form-control">
                                </div>
                                <div class="form-check" id="check-delivery" style="margin-bottom: .5rem;"><input class="form-check-input" type="checkbox" id="formCheck-delivery"><label class="form-check-label" for="formCheck-delivery">Delivery</label></div>
                                <div id="container-delivery" class="position-relative mb-2" style="display: none;">
                                    <h5>Nama driver</h5><select class="form-control">
                                        <option value="">-</option>
                                        @foreach ($data['driver'] as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->nama }}</option>
                                        @endforeach
                                    </select>
                                    <h5 class="mt-2">Alamat antar</h5><input type="text" class="form-control">
                                </div>
                                <hr>
                                <h5 class="mt-2">Outlet Ambil</h5><select class="form-control">
                                    <option value="">-</option>
                                    @foreach ($data['outlet'] as $outlet)
                                        <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
                                    @endforeach
                                </select>
                                <h5 class="mt-2">Alamat Outlet</h5><input type="text" class="form-control" readonly="">
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('js/transaksi/bucket.js') }}"></script>
@endsection
