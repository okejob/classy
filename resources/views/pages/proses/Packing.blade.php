@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Proses</a><i class="fas fa-angle-right mx-2"></i><a>Packing</a></header>
    <section id="data-kategori">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Packing</h4>
                <hr>
                <div class="d-flex justify-content-end">
                    <form method="GET" action="/proses/packing" class="d-flex align-items-center">
                        Search :
                        <input class="form-control mx-1" type="search" name="search" style="max-width: 200px;">
                    </form>
                </div>
                <div class="table-responsive mb-2">
                    <table class="table table-striped table-hover" id="table-list-trans">
                        <thead class="text-center">
                            <tr>
                                <th>Kode</th>
                                <th>Outlet</th>
                                <th class="d-none d-lg-table-cell">Tanggal Transaksi</th>
                                <th>Nama Pelanggan</th>
                                <th colspan="2">Harga Total</th>
                                <th>Lunas</th>
                                <th style="width: 46.25px;"></th>
                            </tr>
                        </thead>
                        <tbody style="cursor: pointer">
                            @foreach ($last_transaksi as $trans)
                            <tr id="{{ $trans->id }}" data-bs-toggle="tooltip" data-bss-tooltip="" title="Double klik untuk memilih">
                                <td class="text-center">{{ $trans->kode }}</td>
                                <td class="text-center">{{ $trans->outlet->nama }}</td>
                                <td class="d-none d-lg-table-cell text-center">{{ $trans->created_at }}</td>
                                <td>{{ $trans->pelanggan->nama }}</td>
                                <td>Rp</td>
                                <td class="text-end thousand-separator">{{ $trans->grand_total }}</td>
                                <td class="text-center" style="white-space: nowrap">
                                @if($trans->lunas)
                                    Lunas
                                @else
                                    Belum Lunas
                                @endif
                                </td>
                                <td class="cell-action">
                                    <button id="btn-{{ $trans->id }}" class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $last_transaksi->links() }}
                <ul class="list-unstyled form-control" id="list-action">
                    {{-- @if(in_array("Mengubah Data Kategori", Session::get('permissions')) || Session::get('role') == 'administrator') --}}
                    <li id="action-detail">Lihat Detail</li>
                    {{-- @endif --}}
                </ul>
            </div>
        </div>


        <div class="modal fade" role="dialog" tabindex="-1" id="modal-detail">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Transaksi</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="container-bucket"></div>
                        <div id="container-premium"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btn-packing" type="btn">Kemas</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" role="dialog" tabindex="-1" id="modal-packing">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Kemas</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form-packing">
                        <div class="modal-body">
                            <div class="mb-3">
                                <h5>Alamat Antar</h5>
                                <input id="alamat-antar" type="text" class="form-control" name="alamat" required/>
                            </div>
                            <hr>
                            <h5>Item</h5>
                            <div class="table-responsive mb-2">
                                <table class="table" id="table-list-inventory">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 80%;">Nama Item</th>
                                            <th>Quantity</th>
                                            <th style="width: 56px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody style="cursor: pointer">
                                        <datalist id="data-inventory">
                                            @foreach ($inventories as $inventory)
                                                <option value="{{ $inventory->nama }}" data-id="{{ $inventory->id }}" data-stok="{{ $inventory->stok }}"></option>
                                            @endforeach
                                        </datalist>
                                        <tr class="row-clone">
                                            <td>
                                                <input class="nama-inventory form-control" list="data-inventory" placeholder="nama item inventory">
                                            </td>
                                            <td>
                                                <input class="qty-inventory form-control" type="number" min=1 placeholder="qty">
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btn-delete-item" type="btn"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <tr class="row-add">
                                            <td colspan="3" class="text-center">
                                                <button class="btn btn-primary btn-sm" id="add-clone" type="button"><i class="fas fa-plus"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" id="simpan-packing" type="submit">Simpan & Antar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('js/proses/packing.js') }}"></script>
@endsection