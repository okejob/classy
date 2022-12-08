@extends('layouts.users')

@section('content')
<div class="container">
    <header class="my-3" style="color: var(--bs-gray);">
        <a>Transaksi</a>
        <i class="fas fa-angle-right mx-2"></i>
        <a>Pembayaran</a>
    </header>
    <section id="section-pembayaran">
        <div class="card">
            <div class="card-body">
                <h4>List Transaksi</h4>
                <hr />
                <div class="table-responsive">
                    <table class="table table-striped" id="table-pembayaran">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Pelanggan</th>
                                <th colspan="2">Total</th>
                                <th>Lunas</th>
                                <th colspan="2">Terbayar</th>
                                <th>Status</th>
                                <th style="width: 50px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($transaksis as $transaksi)
                            <tr>
                                <td class="text-center">{{ $transaksi->kode }}</td>
                                <td class="text-center">{{ $transaksi->pelanggan->nama }}</td>
                                <td style="width: 35px;">Rp</td>
                                <td class="thousand-separator text-end">{{ $transaksi->grand_total }}</td>
                                @if ($transaksi->lunas)
                                    <td class="text-center">Lunas</td>
                                @else
                                    <td class="text-center">Belum lunas</td>
                                @endif
                                <td style="width: 35px;">Rp</td>
                                <td class="thousand-separator text-end">{{ $transaksi->total_terbayar }}</td>
                                <td class="text-center">{{ $transaksi->status }}</td>
                                <td class="cell-action">
                                    <button id="btn-{{ $transaksi->id }}" class="btn btn-primary btn-sm btn-show-action" type="button">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- {{ $transaksis->links() }} --}}

                <ul class="list-unstyled form-control" id="list-action">
                    <li id="action-detail">Lihat detail</li>
                    {{-- <li id="action-delete">Hapus data</li> --}}
                </ul>
            </div>
        </div>
    </section>

    <div class="modal fade" role="dialog" tabindex="-1" id="modal-detail-trans">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Transaksi <span id="kode-trans">kode trans</span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-item-transaksi">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th colspan="2">Bobot/Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-end">Sub Total</td>
                                    <td>Rp</td>
                                    <td class="thousand-separator text-end" id="subtotal"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end">Diskon</td>
                                    <td>Rp</td>
                                    <td class="thousand-separator text-end" id="diskon"></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-end">Grand Total</td>
                                    <td>Rp</td>
                                    <td class="thousand-separator text-end" id="grand-total"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Print Nota</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/transaksi/pembayaran.js') }}"></script>
@endsection
