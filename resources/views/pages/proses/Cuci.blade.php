@extends('layouts.users')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<div class="container">
    <header class="my-3" style="color: var(--bs-gray);"><a>Proses</a><i class="fas fa-angle-right mx-2"></i><a>Cuci</a></header>
    <ul role="tablist" class="nav nav-tabs position-relative border-bottom-0">
        <li role="presentation" class="nav-item"><a role="tab" data-bs-toggle="tab" class="nav-link active" href="#tab-1">Hub Cuci</a></li>
        <li role="presentation" class="nav-item"><a role="tab" data-bs-toggle="tab" class="nav-link" href="#tab-2">Hub Rewash</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="tab-1">
            <section id="proses-cuci">
                <div id="hub" class="row card d-flex flex-row position-relative border-0">
                    <div class="col-12 col-md-6">
                        <div class="p-3 border rounded" style="border: 1px solid rgba(0,0,0,.125);">
                            <h4>Hub Cuci</h4>
                            <hr />
                            <div class="hub-list hub-cuci">
                                @foreach ($transaksis as $transaksi)
                                    @if ($transaksi->pencuci == null && !$transaksi->setrika_only)
                                    <div class="p-3 border rounded item d-flex justify-content-between align-items-start">
                                        <div class="d-flex flex-column">
                                            <h4>{{ $transaksi->kode }}</h4>
                                            <h6 class="text-muted">{{ $transaksi->created_at }}</h6>
                                        </div>
                                        <button class="btn btn-sm btn-show-action" type="button" id="trans-{{ $transaksi->id }}" style="box-shadow: none;">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
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
                                    @if ($transaksi->pencuci == Auth::id())
                                    <div class="p-3 border rounded item d-flex justify-content-between align-items-start">
                                        <div class="d-flex flex-column">
                                            <h4>{{ $transaksi->kode }}</h4>
                                            <h6 class="text-muted">{{ $transaksi->created_at }}</h6>
                                        </div>
                                        <button class="btn btn-sm btn-show-action" type="button" id="trans-{{ $transaksi->id }}" style="box-shadow: none;">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
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
        </div>
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
        </div>
    </div>
</div>

<script src="{{ asset('js/proses/cuci.js') }}"></script>
@endsection

