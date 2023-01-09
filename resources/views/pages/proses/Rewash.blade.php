@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Master Data</a><i class="fas fa-angle-right mx-2"></i><a>Data Rewash</a></header>
    <section id="data-pengeluaran">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Rewash</h4>
                <hr>
                <div class="table-responsive">
                    <table class="table" id="table-rewash">
                        <thead>
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>Nama Item</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th style="width: 46.25px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rewashes as $rewash)
                                <tr id='{{ $rewash->id }}'>
                                    <td class="text-center">{{ $rewash->itemTransaksi->kode_transaksi }}</td>
                                    <td>{{ $rewash->itemTransaksi->nama }}</td>
                                    <td>{{ $rewash['jenis_rewash'] }}</td>
                                    @if ($rewash->status)
                                        <td class="text-center">is done</td>
                                    @else
                                        <td class="text-center">in progress</td>
                                    @endif
                                    <td class="cell-action" style="width: 46.25px;">
                                        <button id="btn-{{ $rewash->id }}" class="btn btn-primary btn-sm btn-show-action" type="button">
                                            <i class="fas fa-bars"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <ul class="list-unstyled form-control" id="list-action">
                    <li id="action-update">Rubah data</li>
                    <li id="action-change-status">Rubah status</li>
                </ul> --}}
                <button class="btn btn-primary btn-tambah mt-2" type="button">
                    <i class="fas fa-plus-circle"></i>
                    &nbsp;Tambah
                </button>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-update">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Data Rewash</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="/proses/rewash/insert">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4 mb-3">
                                    <h5>Kode Transaksi</h5>
                                    <select id="kode-trans" class="form-select">
                                        <option value hidden selected></option>
                                        @foreach ($transaksis as $transaksi)
                                            <option value="{{ $transaksi->id }}">{{ $transaksi->kode }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-8 mb-3">
                                    <h5>Jenis Item</h5>
                                    <select name="item_transaksi_id" id="item-trans" class="form-select" required>
                                        <option value hidden selected></option>
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <h5>Alasan Cuci</h5>
                                    <select name="jenis_rewash_id" id="jenis-rewash" class="form-select" required>
                                        <option value hidden selected></option>
                                        @foreach ($jenisRewashes as $jenisRewash)
                                            <option value="{{ $jenisRewash->id }}">{{ $jenisRewash->keterangan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <h5>Keterangan</h5>
                                    <textarea class="form-control" id="input-deskripsi" style="resize: none;"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('js/proses/rewash.js') }}"></script>
@endsection
