@extends('layouts.users')
@section('content')
<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);">
        <a>Transaksi</a>
        <i class="fas fa-angle-right mx-2"></i>
        <a>Cancelled</a>
    </header>

    <section id="data-transaksi">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">List Cancelled</h4>
                <hr>
                <div class="d-flex justify-content-end">
                    <form method="GET" action="/transaksi/pembatalan" class="d-flex align-items-center">
                        Search :
                        <input class="form-control mx-1" type="search" name="search" style="max-width: 200px;">
                    </form>
                </div>
                <div class="table-responsive mb-2">
                    <table class="table table-striped" id="table-list-trans">
                        <thead class="text-center">
                            <tr>
                                <th>Kode</th>
                                <th>Outlet</th>
                                <th class="d-none d-lg-table-cell">Tanggal Transaksi</th>
                                <th>Nama Pelanggan</th>
                                <th colspan="2">Harga Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody style="cursor: pointer">
                            @foreach ($last_transaksi as $trans)
                            <tr id={{ $trans->id }}>
                                <td class="text-center">{{ $trans->kode }}</td>
                                <td class="text-center">{{ $trans->outlet->nama }}</td>
                                <td class="d-none d-lg-table-cell text-center">{{ $trans->created_at }}</td>
                                <td>{{ $trans->pelanggan->nama }}</td>
                                <td>Rp</td>
                                <td class="text-end thousand-separator">{{ $trans->grand_total }}</td>
                                <td class='text-end' style='width: 46.25px;'>
                                    <button id='btn-{{ $trans->id }}' class='btn btn-primary btn-sm btn-show-action' type='button' style="line-height: .75rem">
                                        <i class='fas fa-bars' aria-hidden='true'></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $last_transaksi->links() }}
                <ul class="list-unstyled form-control" id="list-action">
                    {{-- @if(in_array("Mengubah Data Inventory", Session::get('permissions')) || Session::get('role') == 'administrator') --}}
                    {{-- <li id="action-detail">Lihat Detail</li> --}}
                    {{-- @endif --}}
                    {{-- @if(in_array("Menghapus Inventory", Session::get('permissions')) || Session::get('role') == 'administrator') --}}
                    <li id="action-restore">Restore Transaksi</li>
                    {{-- @endif --}}
                </ul>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('js/transaksi/cancelled.js') }}"></script>
@endsection
