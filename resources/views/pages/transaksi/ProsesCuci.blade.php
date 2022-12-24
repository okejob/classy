@extends('layouts.users')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<div class="container">
    <header class="my-3" style="color: var(--bs-gray);"><a>Transaksi</a><i class="fas fa-angle-right mx-2"></i><a>Proses Cuci</a></header>
    <section id="proses-cuci">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div id="hub" class="d-flex">
                        <div class="card-1 w-50 py-2" style="padding-right: .75rem!important;">
                            <div class="p-3 border rounded" style="border: 1px solid rgba(0,0,0,.125);">
                                <h4>Hub Cuci</h4>
                                <hr />
                                <div class="hub-list hub-cuci">
                                    @foreach ($transaksis as $transaksi)
                                    <div class="p-3 border rounded item d-flex justify-content-between align-items-start">
                                        <div class="d-flex flex-column">
                                            <h4>{{ $transaksi->kode }}</h4>
                                            <h6 class="text-text-muted">{{ $transaksi->created_at }}</h6>
                                        </div>
                                        <button class="btn btn-sm btn-show-action" type="button" id="trans-{{ $transaksi->id }}" style="box-shadow: none;">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-1 w-50 py-2" style="padding-left: .75rem!important;">
                            <div class="p-3 border rounded" style="border: 1px solid rgba(0,0,0,.125);">
                                <h4>Hub Penyuci</h4>
                                <hr />
                                <div class="hub-list hub-karyawan"></div>
                            </div>
                        </div>
                        <ul class="list-unstyled form-control" id="list-action">
                            <li id="action-detail">Detail</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal fade" role="dialog" tabindex="-1" id="modal-detail">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-lg-down" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Detail Transaksi</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('js/transaksi/prosesCuci.js') }}"></script>
@endsection

