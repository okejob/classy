@extends('layouts.users')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<div class="container">
    <header class="my-3" style="color: var(--bs-gray);"><a>Proses</a><i class="fas fa-angle-right mx-2"></i><a>Cuci</a></header>

    {{-- if admin --}}
    @if(Session::get('role') != 'produksi_cuci')
        <ul role="tablist" class="nav nav-tabs position-relative border-bottom-0">
            <li role="presentation" class="nav-item"><a role="tab" data-bs-toggle="tab" class="nav-link active" href="#tab-1">Data</a></li>
            <li role="presentation" class="nav-item"><a role="tab" data-bs-toggle="tab" class="nav-link" href="#tab-2">Task Hub</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tab-1">
                <section id="section-data-cuci">
                    <div class="card">
                        <div class="card-body">
                            <section id="section-staging" class="mb-4">
                                <h4>Staging</h4>
                                <hr />
                                <div class="table-responsive mb-2">
                                    <table class="table table-striped" id="table-staging">
                                        <thead>
                                            <tr>
                                                <th>Kode Transaksi</th>
                                                <th>Tanggal</th>
                                                <th>Jenis</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transaksis as $transaksi)
                                                @if($transaksi->status != 'done' && $transaksi->pencuci == null)
                                                <tr>
                                                    <td class="text-center">{{ $transaksi->kode }}</td>
                                                    <td class="text-center">{{ $transaksi->created_at }}</td>
                                                    @if($transaksi->express)
                                                        <td class="text-center">Express</td>
                                                    @else
                                                        <td class="text-center">Normal</td>
                                                    @endif
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                            <hr style="margin: 1rem -1rem;" />
                            <section id="section-on-process" class="mb-4">
                                <h4>On Process</h4>
                                <hr />
                                <div class="table-responsive mb-2">
                                    <table class="table table-striped" id="table-on-process">
                                        <thead>
                                            <tr>
                                                <th>Kode Transaksi</th>
                                                <th>Tanggal</th>
                                                <th>Jenis</th>
                                                <th>Pencuci</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transaksis as $transaksi)
                                                @if(!$transaksi->is_done_cuci && $transaksi->pencuci != null)
                                                <tr>
                                                    <td class="text-center">{{ $transaksi->kode }}</td>
                                                    <td class="text-center">{{ $transaksi->created_at }}</td>
                                                    @if($transaksi->express)
                                                        <td class="text-center">Express</td>
                                                    @else
                                                        <td class="text-center">Normal</td>
                                                    @endif
                                                    <td class="text-center">{{ $transaksi->pencuci }}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                            <hr style="margin: 1rem -1rem;" />
                            <section id="section-on-process" class="mb-4">
                                <h4>Done</h4>
                                <hr />
                                <div class="table-responsive mb-2">
                                    <table class="table table-striped" id="table-on-process">
                                        <thead>
                                            <tr>
                                                <th>Kode Transaksi</th>
                                                <th>Tanggal</th>
                                                <th>Jenis</th>
                                                <th>Pencuci</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($transaksis as $transaksi)
                                                @if($transaksi->is_done_cuci && $transaksi->pencuci != null)
                                                <tr>
                                                    <td class="text-center">{{ $transaksi->kode }}</td>
                                                    <td class="text-center">{{ $transaksi->created_at }}</td>
                                                    @if($transaksi->express)
                                                        <td class="text-center">Express</td>
                                                    @else
                                                        <td class="text-center">Normal</td>
                                                    @endif
                                                    <td class="text-center">{{ $transaksi->pencuci }}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                        </div>
                    </div>
                </section>
            </div>
            <div role="tabpanel" class="tab-pane" id="tab-2">
                <section id="proses-cuci">
                    <div id="hub" class="row card d-flex flex-row position-relative border-0">
                        <div class="col-12 col-md-6">
                            <div class="p-3 border rounded" style="border: 1px solid rgba(0,0,0,.125);">
                                <h4>Staging</h4>
                                <hr />
                                <div class="hub-list hub-staging">
                                    @foreach ($transaksis as $transaksi)
                                    @if ($transaksi->status != 'done' && $transaksi->pencuci == null && !$transaksi->setrika_only && !$transaksi->is_done_cuci)
                                        <div class="p-3 border rounded item d-flex justify-content-between align-items-center my-3" style="border-bottom: 3px solid rgb(54, 162, 235)!important; background-color: white;">
                                            <div class="d-flex flex-column">
                                                <h4>{{ $transaksi->kode }}</h4>
                                                <h6 class="text-muted">{{ $transaksi->created_at }}</h6>
                                            </div>
                                            <div class="position-relative">
                                                <h4 class="fw-bold me-4" style="font-style: italic;">Process</h4>
                                                <i class="fa-solid fa-spinner position-absolute top-50 start-0 translate-middle fa-4x" style="font-style: italic; opacity: 0.25;"></i>
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @foreach ($pencucis as $pencuci)
                            <div class="col-12 col-md-6">
                                <div class="p-3 border rounded" style="border: 1px solid rgba(0,0,0,.125);">
                                    <h4>Hub {{ $pencuci->name }}</h4>
                                    <hr />
                                    <div class="hub-list hub-karyawan">
                                        @foreach ($transaksis as $transaksi)
                                        @if ($transaksi->status != 'done' && $transaksi->pencuci == $pencuci->id && !$transaksi->setrika_only)
                                            @if ($transaksi->is_done_cuci == 1)
                                                <div class="p-3 border rounded d-flex justify-content-between align-items-center my-3" style="border-bottom: 3px solid rgb(54, 162, 235)!important; background-image: linear-gradient(to bottom right, white, rgb(54, 162, 235, .5)); background-color: white;">
                                            @else
                                                <div class="p-3 border rounded d-flex justify-content-between align-items-center my-3" style="border-bottom: 3px solid rgb(54, 162, 235)!important; background-color: white;">
                                            @endif
                                                <div class="d-flex flex-column">
                                                    <h4>{{ $transaksi->kode }}</h4>
                                                    <h6 class="text-muted">{{ $transaksi->created_at }}</h6>
                                                </div>
                                                <div class="position-relative">
                                                    @if ($transaksi->is_done_cuci == 1)
                                                        <h4 class="fw-bold me-4" style="font-style: italic;">Done</h4>
                                                        <i class="fa-solid fa-flag-checkered position-absolute top-50 start-0 translate-middle fa-4x" style="font-style: italic; opacity: 0.25;"></i>
                                                    @else
                                                        <h4 class="fw-bold me-4" style="font-style: italic;">Process</h4>
                                                        <i class="fa-solid fa-spinner position-absolute top-50 start-0 translate-middle fa-4x" style="font-style: italic; opacity: 0.25;"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal fade" role="dialog" tabindex="-1" id="modal-detail">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-lg-down" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Detail Transaksi</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive my-2 tbody-wrap">
                                        <table class="table table-striped mb-0" id="table-trans-item">
                                            <thead>
                                                <tr>
                                                    <th>Nama Item</th>
                                                    <th>Kategori</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transaksis as $transaksi)
                                                    @foreach ($transaksi->item_transaksi as $item_transaksi)
                                                    <tr class="trans-{{ $transaksi->id }}">
                                                        <td>{{ $item_transaksi->nama }}</td>
                                                        <td>{{ $item_transaksi->nama_kategori }}</td>
                                                        <td>keterangan</td>
                                                    </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    {{-- if pencuci --}}
    @else
        {{-- <ul role="tablist" class="nav nav-tabs position-relative border-bottom-0">
            <li role="presentation" class="nav-item"><a role="tab" data-bs-toggle="tab" class="nav-link active" href="#tab-1">Hub Cuci</a></li>
            <li role="presentation" class="nav-item"><a role="tab" data-bs-toggle="tab" class="nav-link" href="#tab-2">Hub Rewash</a></li>
        </ul>
        <div class="tab-content"> --}}
            <div role="tabpanel" class="tab-pane active" id="tab-1">
                <section id="proses-cuci">
                    <div id="hub" class="row card d-flex flex-row position-relative border-0">
                        <div class="col-12 col-md-6">
                            <div class="p-3 border rounded" style="border: 1px solid rgba(0,0,0,.125);">
                                <h4>Hub Cuci</h4>
                                <hr />
                                <div class="hub-list hub-cuci">
                                    @foreach ($transaksis as $transaksi)
                                    @if ($transaksi->status != 'done' && $transaksi->pencuci == null && !$transaksi->setrika_only && !$transaksi->is_done_cuci)
                                        <div class="p-3 border rounded item d-flex justify-content-between align-items-center my-3" style="border-bottom: 3px solid rgb(54, 162, 235)!important; background-color: white;">
                                            <div class="d-flex flex-column">
                                                <h4>{{ $transaksi->kode }}</h4>
                                                <h6 class="text-muted">{{ $transaksi->created_at }}</h6>
                                            </div>
                                            <div class="position-relative">
                                                <h4 class="fw-bold me-4" style="font-style: italic;">Process</h4>
                                                <i class="fa-solid fa-spinner position-absolute top-50 start-0 translate-middle fa-4x" style="font-style: italic; opacity: 0.25;"></i>
                                                <button class="btn btn-sm btn-show-action position-absolute end-0" type="button" style="top: -12px;" id="trans-{{ $transaksi->id }}" style="box-shadow: none;">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="p-3 border rounded" style="border: 1px solid rgba(0,0,0,.125);">
                                <h4>Hub Pencuci</h4>
                                <hr />
                                <div class="hub-list hub-karyawan">
                                    @foreach ($transaksis as $transaksi)
                                    @if ($transaksi->status != 'done' && $transaksi->pencuci == Auth::id() && !$transaksi->setrika_only)
                                        @if ($transaksi->is_done_cuci == 1)
                                            <div class="p-3 border rounded d-flex justify-content-between align-items-center my-3" style="border-bottom: 3px solid rgb(54, 162, 235)!important; background-image: linear-gradient(to bottom right, white, rgb(54, 162, 235, .5)); background-color: white;">
                                        @else
                                            <div class="p-3 border rounded item d-flex justify-content-between align-items-center my-3" style="border-bottom: 3px solid rgb(54, 162, 235)!important; background-color: white;">
                                        @endif
                                            <div class="d-flex flex-column">
                                                <h4>{{ $transaksi->kode }}</h4>
                                                <h6 class="text-muted">{{ $transaksi->created_at }}</h6>
                                            </div>
                                            <div class="position-relative">
                                                @if ($transaksi->is_done_cuci == 1)
                                                    <h4 class="fw-bold me-4" style="font-style: italic;">Done</h4>
                                                    <i class="fa-solid fa-flag-checkered position-absolute top-50 start-0 translate-middle fa-4x" style="font-style: italic; opacity: 0.25;"></i>
                                                @else
                                                    <h4 class="fw-bold me-4" style="font-style: italic;">Process</h4>
                                                    <i class="fa-solid fa-spinner position-absolute top-50 start-0 translate-middle fa-4x" style="font-style: italic; opacity: 0.25;"></i>
                                                    <button class="btn btn-sm btn-show-action position-absolute end-0" type="button" style="top: -12px;" id="trans-{{ $transaksi->id }}" style="box-shadow: none;">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <ul class="list-unstyled form-control" id="list-action">
                            <li id="action-add">Tambahkan</li>
                            <li id="action-remove">Kembalikan</li>
                            <li id="action-detail">Detail</li>
                            <li id="action-done">Selesai</li>
                        </ul>
                    </div>
                    <div class="modal fade" role="dialog" tabindex="-1" id="modal-detail">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-lg-down" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Detail Transaksi</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive my-2 tbody-wrap">
                                        <table class="table table-striped mb-0" id="table-trans-item">
                                            <thead>
                                                <tr>
                                                    <th>Nama Item</th>
                                                    <th>Kategori</th>
                                                    <th>Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($transaksis as $transaksi)
                                                    @foreach ($transaksi->item_transaksi as $item_transaksi)
                                                    <tr class="trans-{{ $transaksi->id }}">
                                                        <td>{{ $item_transaksi->nama }}</td>
                                                        <td>{{ $item_transaksi->nama_kategori }}</td>
                                                        <td>keterangan</td>
                                                    </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            {{-- </div>
            <div role="tabpanel" class="tab-pane" id="tab-2">
                <section id="proses-rewash">
                    <div id="hub" class="row card d-flex flex-row position-relative border-0">
                        <div class="col-12 col-md-6">
                            <div class="p-3 border rounded" style="border: 1px solid rgba(0,0,0,.125);">
                                <h4>Hub Pencuci</h4>
                                <hr />
                                <div class="hub-list hub-rewash-karyawan">
                                    @foreach ($rewashes as $rewash)
                                        <div class="p-3 border rounded item d-flex justify-content-between align-items-start mb-3">
                                            <div class="d-flex flex-column">
                                                <h4>
                                                    {{ $rewash->itemTransaksi->kode_transaksi }}
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" class="bi bi-dot">
                                                        <path fill-rule="evenodd" d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                                    </svg>
                                                    {{ $rewash->itemTransaksi->nama }}
                                                </h4>
                                                <h6 class="text-muted">{{ $transaksi->created_at }}</h6>
                                            </div>
                                            <button class="btn btn-sm btn-show-action" type="button" id="trans-{{ $transaksi->id }}" style="box-shadow: none;">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div> --}}
        </div>
    @endif
</div>

<script src="{{ asset('js/proses/cuci.js') }}"></script>
@endsection

