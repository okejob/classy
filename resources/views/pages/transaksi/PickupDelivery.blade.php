@extends('layouts.users')

@section('content')

{{-- @dump(in_array("Melihat Detail Transaksi", Session::get('permissions'))) --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<div class="container">
    <header class="my-3" style="color: var(--bs-gray);">
        <a>Transaksi</a>
        <i class="fas fa-angle-right mx-2"></i>
        <a>Pickup &amp; Delivery</a>
    </header>

    {{-- if admin --}}
    @if(Session::get('role') != 'delivery')
        <ul role="tablist" class="nav nav-tabs position-relative border-bottom-0">
            <li role="presentation" class="nav-item"><a role="tab" data-bs-toggle="tab" class="nav-link active" href="#tab-1">Data</a></li>
            <li role="presentation" class="nav-item"><a role="tab" data-bs-toggle="tab" class="nav-link" href="#tab-2">Task Hub</a></li>
            <div class="d-flex align-items-center position-absolute end-0" style="bottom: -1px;">
                <h6 class="me-2">Tanggal</h6>
                <input type="date" name="input-date" class="form-control" style="width: 200px;">
            </div>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab-1">
                <div class="card">
                    <div class="card-body">
                        <section id="section-pickup" class="mb-4">
                            <h4>Pickup</h4>
                            <hr />
                            <div id="table-pickup"></div>
                            @if(in_array("Membuat Pickup Delivery", Session::get('permissions')) || Session::get('role') == 'administrator')
                            <div class="text-end mt-3">
                                <button id="create-pickup" class="btn btn-primary">Pickup Baru</button>
                            </div>
                            @endif
                        </section>
                        <hr style="margin: 1rem -1rem;" />
                        <section id="section-delivery" class="mb-4">
                            <h4>Delivery</h4>
                            <hr />
                            <div id="table-delivery"></div>
                            @if(in_array("Membuat Pickup Delivery", Session::get('permissions')) || Session::get('role') == 'administrator')
                            <div class="text-end mt-3">
                                <button id="create-delivery" class="btn btn-primary">Delivery Baru</button>
                            </div>
                            @endif
                        </section>
                        <hr style="margin: 1rem -1rem;" />
                        <section id="section-ambil-outlet" class="mb-4">
                            <h4>Ambil di outlet</h4>
                            <hr />
                            <div id="table-di-outlet"></div>
                        </section>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab-2">
                <div class="row">
                    @foreach ($dataDriver as $driver)
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4>Hub {{ $driver->name }}</h4>
                                <button class="btn btn-sm btn-toggle" style="box-shadow: none;"><i class="fa-solid fa-down-left-and-up-right-to-center"></i></button>
                            </div>
                            <div class="hub-container">
                                <hr />
                                <div class="hub-list">
                                    @foreach ($pickups as $pickup)
                                        @if($driver->id == $pickup->driver_id)
                                            <div class="p-3 border rounded d-flex justify-content-between align-items-center mt-3"
                                                @if ($pickup->is_done)
                                                    style="border-bottom: 3px solid rgb(75, 192, 192)!important; background-image: linear-gradient(to bottom right, white, rgb(75, 192, 192, .5));"
                                                @else
                                                    style="border-bottom: 3px solid rgb(75, 192, 192)!important;"
                                                @endif
                                            >
                                                <div id="{{ $pickup->id }}" class="d-flex flex-column">
                                                    <h4>
                                                        <span>{{ $pickup->pelanggan->nama }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" class="bi bi-dot">
                                                            <path fill-rule="evenodd" d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                                        </svg>
                                                        <span class="text-muted">{{ $pickup->alamat }}</span>
                                                    </h4>
                                                    <h6>{{ $pickup->kode }}</h6>
                                                </div>
                                                <div class="position-relative">
                                                    <h4 class="fw-bold" style="font-style: italic;">Pickup</h4>
                                                    @if ($pickup->is_done)
                                                        <i class="fa-solid fa-flag-checkered position-absolute top-50 start-0 translate-middle fa-4x" style="font-style: italic; opacity: 0.25;"></i>
                                                    @else
                                                        <i class="fa-solid fa-spinner position-absolute top-50 start-0 translate-middle fa-4x" style="font-style: italic; opacity: 0.25;"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    @foreach ($deliveries as $delivery)
                                        @if($driver->id == $delivery->driver_id)
                                            <div class="p-3 border rounded d-flex justify-content-between align-items-center mt-3"
                                                @if ($delivery->is_done)
                                                    style="border-bottom: 3px solid rgb(153, 102, 255)!important; background-image: linear-gradient(to bottom right, white, rgb(153, 102, 255, .5));"
                                                @else
                                                    style="border-bottom: 3px solid rgb(153, 102, 255)!important;"
                                                @endif
                                            >
                                                <div id="{{ $delivery->id }}" class="d-flex flex-column">
                                                    <h4>
                                                        <span>{{ $delivery->pelanggan->nama }}</span>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" class="bi bi-dot">
                                                            <path fill-rule="evenodd" d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                                        </svg>
                                                        <span class="text-muted">{{ $delivery->alamat }}</span>
                                                    </h4>
                                                    <h6>{{ $delivery->kode }}</h6>
                                                </div>
                                                <div class="position-relative">
                                                    {{-- background-image: linear-gradient(to bottom right, red, yellow); --}}
                                                    <h4 class="fw-bold" style="font-style: italic;">Delivery</h4>
                                                    @if ($delivery->is_done)
                                                        <i class="fa-solid fa-flag-checkered position-absolute top-50 start-0 translate-middle fa-4x" style="font-style: italic; opacity: 0.25;"></i>
                                                    @else
                                                        <i class="fa-solid fa-spinner position-absolute top-50 start-0 translate-middle fa-4x" style="font-style: italic; opacity: 0.25;"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div role="dialog" tabindex="-1" class="modal fade" id="modal-create-pickup">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Pickup</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/transaksi/pickup-delivery" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <h5>Pilih Pelanggan</h5>
                                    <select class="form-control" name="pelanggan_id" required >
                                        <option value="" selected hidden>-</option>
                                        @foreach ($dataPelanggan as $pelanggan)
                                            <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 mb-2">
                                    <h5>Pilih Driver</h5>
                                    <select class="form-control" name="driver_id" required >
                                        <option value="" selected hidden>-</option>
                                        @foreach ($dataDriver as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-2">
                                    <h5>Alamat</h5>
                                    <input type="text" class="form-control" name="alamat" required />
                                </div>
                                <div class="col-12 mb-2">
                                    <h5>Catatan Pelanggan</h5>
                                    <textarea class="form-control" name="request"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="pickup">
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div role="dialog" tabindex="-1" class="modal fade" id="modal-create-delivery">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create Delivery</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="/transaksi/pickup-delivery" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6 mb-2" id="col-transaksi">
                                    <h5>Pilih Transaksi</h5>
                                    <select class="form-control" name="transaksi_id" required >
                                        <option value="" selected hidden>-</option>
                                        @foreach ($dataTransaksi as $trans)
                                            @if($trans->kode != '')
                                                <option value="{{ $trans->id }}">{{ $trans->kode }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 mb-2">
                                    <h5>Pilih Driver</h5>
                                    <select class="form-control" name="driver_id" required >
                                        <option value="" selected hidden>-</option>
                                        @foreach ($dataDriver as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mb-2">
                                    <h5>Alamat</h5>
                                    <input type="text" class="form-control" name="alamat" required />
                                </div>
                                <div class="col-12 mb-2">
                                    <h5>Catatan Pelanggan</h5>
                                    <textarea class="form-control" name="request"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="delivery">
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    {{-- if delivery --}}
    @else
        <div class="row">
            @foreach ($dataDriver as $driver)
                @if($driver->id == Auth::id())
                <div class="col-12 col-lg-6">
                    <div class="card p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>Hub {{ $driver->name }}</h4>
                            <button class="btn btn-sm btn-toggle" style="box-shadow: none;"><i class="fa-solid fa-down-left-and-up-right-to-center"></i></button>
                        </div>
                        <div class="hub-container">
                            <hr />
                            <div class="hub-list hub-karyawan">
                                @foreach ($pickups as $pickup)
                                    @if($driver->id == $pickup->driver_id)
                                        <div class="p-3 border rounded d-flex justify-content-between align-items-center mt-3 card-pickup"
                                            @if ($pickup->is_done)
                                                style="border-bottom: 3px solid rgb(75, 192, 192)!important; background-image: linear-gradient(to bottom right, white, rgb(75, 192, 192, .5)); background-color: white;"
                                            @else
                                                style="border-bottom: 3px solid rgb(75, 192, 192)!important; background-color: white;"
                                            @endif
                                        >
                                            <div id="{{ $pickup->id }}" class="d-flex flex-column">
                                                <h4>
                                                    <span>{{ $pickup->pelanggan->nama }}</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" class="bi bi-dot">
                                                        <path fill-rule="evenodd" d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                                    </svg>
                                                    <span class="text-muted">{{ $pickup->alamat }}</span>
                                                </h4>
                                                <h6>{{ $pickup->kode }}</h6>
                                            </div>
                                            <div class="d-flex h-100">
                                                <div class="position-relative h-100">
                                                    <h4 class="fw-bold" style="font-style: italic; margin-right: 2.5rem;">Pickup</h4>
                                                    @if ($pickup->is_done)
                                                        <i class="fa-solid fa-flag-checkered position-absolute top-50 start-0 translate-middle fa-4x" style="font-style: italic; opacity: 0.25;"></i>
                                                    @else
                                                        <i class="fa-solid fa-spinner position-absolute top-50 start-0 translate-middle fa-4x" style="font-style: italic; opacity: 0.25;"></i>
                                                        <button class="btn btn-sm btn-show-action position-absolute end-0" type="button" style="top: -12px;" id="trans-{{ $pickup->id }}" style="box-shadow: none;">
                                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                                @foreach ($deliveries as $delivery)
                                    @if($driver->id == $pickup->driver_id)
                                        <div class="p-3 border rounded d-flex justify-content-between align-items-center mt-3 card-delivery" data-transaksi="{{ $delivery->transaksi_id }}"
                                            @if ($delivery->is_done)
                                                style="border-bottom: 3px solid rgb(153, 102, 255)!important; background-image: linear-gradient(to bottom right, white, rgb(153, 102, 255, .5)); background-color: white;"
                                            @else
                                                style="border-bottom: 3px solid rgb(153, 102, 255)!important; background-color: white;"
                                            @endif
                                        >
                                            <div id="{{ $delivery->id }}" class="d-flex flex-column">
                                                <h4>
                                                    <span>{{ $delivery->pelanggan->nama }}</span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" class="bi bi-dot">
                                                        <path fill-rule="evenodd" d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                                    </svg>
                                                    <span class="text-muted">{{ $delivery->alamat }}</span>
                                                </h4>
                                                <h6>{{ $delivery->kode }}</h6>
                                            </div>
                                            <div class="position-relative">
                                                <h4 class="fw-bold me-4" style="font-style: italic;">Delivery</h4>
                                                @if ($delivery->is_done)
                                                    <i class="fa-solid fa-flag-checkered position-absolute top-50 start-0 translate-middle fa-4x" style="font-style: italic; opacity: 0.25;"></i>
                                                @else
                                                    <i class="fa-solid fa-spinner position-absolute top-50 start-0 translate-middle fa-4x" style="font-style: italic; opacity: 0.25;"></i>
                                                    <button class="btn btn-sm btn-show-action position-absolute end-0" type="button" style="top: -12px;" id="trans-{{ $delivery->id }}" style="box-shadow: none;">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <ul class="list-unstyled form-control" id="list-action">
                                @if(in_array("Melihat Detail Transaksi", Session::get('permissions')) || Session::get('role') == 'administrator')
                                    <li id="action-detail">Detail Transaksi</li>
                                @endif
                                @if(in_array("Mengganti Status Selesai Pickup Delivery", Session::get('permissions')))
                                    <li id="action-change-status">Selesai</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        <div role="dialog" tabindex="-1" class="modal fade" id="modal-transaksi">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Transaksi <span id="kode-transaksi"></span></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="table-short-trans">

                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script src="{{ asset('js/transaksi/pickupDelivery.js') }}"></script>
@endsection
