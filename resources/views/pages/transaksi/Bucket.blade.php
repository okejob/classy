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
                                <tbody style="cursor: pointer">
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
        <div class="row" style="display: none">
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
                                        <td>Item 2</td>
                                        <td>Kategori 1</td>
                                        <td>Si mbah</td>
                                        <td>Si mbah</td>
                                        <td>Sedang cuci</td>
                                        <td class="text-center" style="padding-top: 4px;padding-bottom: 4px;">
                                            <button id="btn-catatan-item-2" class="btn btn-primary btn-sm show-catatan-item" type="button">Catatan</button>
                                        </td>
                                        <td class="text-center">10</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="7" style="padding-top: 4px;padding-bottom: 4px;">
                                            <button class="btn btn-primary btn-sm" id="add-item" type="button">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-end" colspan="6">Sub Total</td>
                                        <td id="sub-total"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-end" colspan="6">Diskon</td>
                                        <td id="diskon"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-end" colspan="6">Grand Total</td>
                                        <td id="grand-total"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-4 p-2">
                                <h5>Parfum</h5>
                                <select class="form-select-sm form-control" id="input-parfum" style="max-width: 200px;">
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
                                <div class="position-relative w-100">
                                    <button class="btn btn-primary" id="show-catatan-trans" type="button" style="width: 200px;">Catatan Transaksi</button>
                                    <div class="position-absolute mt-1 w-100 card p-2" style="z-index: 1;display: none;">
                                        <textarea class="form-control" id="input-catatan-trans"></textarea>
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
                        <div role="dialog" tabindex="-1" class="modal fade" id="modal-add-item">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Pilih Item</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex mb-3">
                                            <input class="form-control" type="search" id="input-nama-item" placeholder="Nama Item">
                                            <button class="btn btn-primary mx-3" data-bs-toggle="tooltip" data-bss-tooltip="" id="search-id-trans" type="button" title="Cari Item">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table" id="table-items">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Nama Item</th>
                                                        <th>Kategori</th>
                                                        <th>Harga</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" id="add-item-to-table" type="button">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="dialog" tabindex="-1" class="modal fade" id="modal-catatan-item">
                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Catatan Item <span class="catatan-item-name">nama item</span></h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="mb-2">
                                                    <h5>Noted by</h5>
                                                    <input type="text" class="form-control" />
                                                </div>
                                                <div class="h-100">
                                                    <h5>Notes</h5>
                                                    <textarea class="form-control"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div>
                                                    <ul role="tablist" class="nav nav-tabs">
                                                        <li role="presentation" class="nav-item"><a role="tab" data-bs-toggle="tab" class="nav-link active" href="#tab-foto">Foto</a></li>
                                                        <li role="presentation" class="nav-item"><a role="tab" data-bs-toggle="tab" class="nav-link" href="#tab-noda">Tandai Noda</a></li>
                                                    </ul>
                                                    <div class="tab-content card" style="border-top: none;border-radius: 0;height: 513px;">
                                                        <div role="tabpanel" class="tab-pane active p-2" id="tab-foto">
                                                            <img id="container-image-item" class="w-100 mb-2" style="object-fit: contain;max-height: 450px;height: 450px;" />
                                                            <div class="text-end">
                                                                <input type="file" class="form-control" id="input-foto-item" accept="image/*" onchange="document.getElementById('container-image-item').src = window.URL.createObjectURL(this.files[0])"/>
                                                            </div>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane p-2" id="tab-noda">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h5>Tampak Depan</h5>
                                                                    <div id="tampak-depan" class="position-relative">
                                                                        <div class="card p-2" style="height: 230px;">
                                                                            <div class="w-100 h-100" style="background-image: url({{asset('image/tshirt-front.jpg')}});background-size: cover;"></div>
                                                                        </div>
                                                                        <div id="td-kiri-atas" class="position-absolute w-50 h-50 card stain-selection" style="top: 0;left: 0;"></div>
                                                                        <div id="td-kanan-atas" class="position-absolute w-50 h-50 card stain-selection" style="top: 0;left: 50%;"></div>
                                                                        <div id="td-kiri-bawah" class="position-absolute w-50 h-50 card stain-selection" style="top: 50%;left: 0;"></div>
                                                                        <div id="td-kanan-bawah" class="position-absolute w-50 h-50 card stain-selection" style="top: 50%;left: 50%;"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <h5>Tampak Belakang</h5>
                                                                    <div id="tampak-belakang" class="position-relative">
                                                                        <div class="card p-2" style="height: 230px;">
                                                                            <div class="w-100 h-100" style="background-image: url({{asset('image/tshirt-back.jpg')}});background-size: cover;"></div>
                                                                        </div>
                                                                        <div id="tb-kiri-atas" class="position-absolute w-50 h-50 card stain-selection" style="top: 0;left: 0;"></div>
                                                                        <div id="tb-kanan-atas" class="position-absolute w-50 h-50 card stain-selection" style="top: 0;left: 50%;"></div>
                                                                        <div id="tb-kiri-bawah" class="position-absolute w-50 h-50 card stain-selection" style="top: 50%;left: 0;"></div>
                                                                        <div id="tb-kanan-bawah" class="position-absolute w-50 h-50 card stain-selection" style="top: 50%;left: 50%;"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="button">Simpan</button>
                                    </div>
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
                                <h5>Pelanggan</h5>
                                <button class="btn show-data" id="show-data-pelanggan" type="button">
                                    <i class="fas fa-chevron-down large"></i>
                                </button>
                            </header>
                            <div id="info-pelanggan" class="mt-2" style="display: none;">
                                <button class="btn btn-primary mb-2" id="search-pelanggan" type="button">
                                    <i class="fas fa-search"></i>
                                    &nbsp;Cari Pelanggan
                                </button>
                                <div class="modal fade" role="dialog" tabindex="-1" id="modal-list-pelanggan">
                                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Cari Pelanggan</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="mb-3">
                                                    <div class="d-flex">
                                                        <input class="form-control" type="search" id="input-nama-pelanggan" placeholder="Nama Pelanggan">
                                                        <button class="btn btn-primary mx-3" data-bs-toggle="tooltip" data-bss-tooltip="" id="search-nama-pelanggan" type="button" title="Cari transaksi">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                        <button class="btn btn-primary" data-bs-toggle="tooltip" data-bss-tooltip="" id="add-new-pelanggan" type="button" title="Buat transaksi baru">
                                                            <i class="fas fa-plus"></i>
                                                        </button>
                                                    </div>
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
                                                        <tbody style="cursor: pointer">
                                                            @foreach ($data['pelanggan'] as $pelanggan)
                                                            <tr id="row-{{ $pelanggan->id }}" data-bs-toggle="tooltip" data-bss-tooltip="" title="Double klik untuk memilih">
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
                                            <h6>Nama</h6>
                                            <input class="form-control disabled" type="text" id="input-nama" name="username" value="temp">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <h6>Alamat</h6>
                                            <input class="form-control disabled" type="text" id="input-alamat">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <h6>Telepon</h6>
                                            <input class="form-control disabled" type="text" id="input-telepon">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <h6>E-mail</h6>
                                            <input class="form-control disabled" type="text" id="input-email">
                                        </div>
                                        <div class="col-12 mb-2">
                                            <h6>Tanggal Lahir</h6>
                                            <input class="form-control disabled" id="input-tanggal-lahir" type="date">
                                        </div>
                                        <div class="col-12">
                                            <h6>Catatan Pelanggan</h6>
                                            <textarea class="form-control" style="resize: none;" id="input-catatan-pelanggan"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                        <hr style="margin: 1rem -1rem;">
                        <section id="section-info-outlet">
                            <header>
                                <h5 class="d-flex justify-content-between align-items-center">
                                    Outlet
                                    <button class="btn show-data" id="show-data-outlet" type="button">
                                        <i class="fas fa-chevron-down large"></i>
                                    </button>
                                </h5>
                            </header>
                            <div id="info-outlet" class="position-relative mt-2" style="display: none;">
                                <h6>Outlet input</h6>
                                <select class="form-control" id="select-outlet">
                                    <option value="" selected hidden>-</option>
                                    @foreach ($data['outlet'] as $outlet)
                                        <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </section>
                        <hr style="margin: 1rem -1rem;">
                        <section id="section-info-pickup-delivery">
                            <header class="d-flex justify-content-between align-items-center">
                                <h5 class="d-flex justify-content-between align-items-center">Pickup &amp; Delivery</h5>
                                <button class="btn show-data" id="show-data-pickup-delivery" type="button">
                                    <i class="fas fa-chevron-down large"></i>
                                </button>
                            </header>
                            <div id="info-pickup-delivery" class="mt-2" style="display: none;">
                                <div class="form-check" id="check-pickup" style="margin-bottom: .5rem;">
                                    <input class="form-check-input" type="checkbox" id="formCheck-pickup">
                                    <label class="form-check-label" for="formCheck-pickup">Pickup</label>
                                </div>
                                <div id="container-pickup" class="position-relative mb-2" style="display: none;">
                                    <h6>Nama driver</h6>
                                    <select class="form-control" id="select-driver-pickup">
                                        <option value="" selected hidden>-</option>
                                        @foreach ($data['driver'] as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->username }}</option>
                                        @endforeach
                                    </select>
                                    <h6 class="mt-2">Alamat ambil</h6>
                                    <input type="text" class="form-control" id="input-alamat-ambil">
                                </div>
                                <div class="d-flex justify-content-around" style="margin-bottom: .5rem;">
                                    <div class="form-check w-50" id="check-delivery">
                                        <input type="radio" class="form-check-input" name="tipe-delivery" id="formCheck-delivery" />
                                        <label class="form-check-label" for="formCheck-delivery">Delivery</label>
                                    </div>
                                    <div class="form-check w-50" id="check-ambil-outlet">
                                        <input type="radio" class="form-check-input" name="tipe-delivery" id="formCheck-ambil-outlet" />
                                        <label class="form-check-label" for="formCheck-ambil-outlet">Ambil di outlet</label>
                                    </div>
                                </div>
                                <div id="container-delivery" class="position-relative mb-2" style="display: none;">
                                    <h6>Nama driver</h6>
                                    <select class="form-control" id="select-driver-delivery">
                                        <option value="" selected hidden>-</option>
                                        @foreach ($data['driver'] as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->username }}</option>
                                        @endforeach
                                    </select>
                                    <h6 class="mt-2">Alamat antar</h6>
                                    <input type="text" class="form-control" id="input-alamat-antar">
                                </div>
                                <div id="container-ambil-outlet" class="position-relative mb-2" style="display: none;">
                                    <h6 class="mt-2">Outlet Ambil</h6>
                                    <select class="form-control" id="select-outlet-ambil">
                                        <option value="">-</option>
                                        @foreach ($data['outlet'] as $outlet)
                                            <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
