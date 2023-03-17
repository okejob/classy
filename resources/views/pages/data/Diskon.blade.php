@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);">
        <a>Master Data</a>
        <i class="fas fa-angle-right mx-2"></i>
        <a>Data Diskon</a>
    </header>
    <section id="data-diskon">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Diskon</h4>
                <hr>
                <div class="table-responsive mb-2">
                    <table class="table table-striped" id="table-diskon">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Deskripsi</th>
                                <th colspan="2">Besar Diskon</th>
                                <th>Expired Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($diskons as $diskon)
                            <tr>
                                <td>{{ $diskon->code }}</td>
                                <td>{{ $diskon->description }}</td>
                                <td>Rp</td>
                                <td class="text-end thousand-separator">{{ $diskon->nominal }}</td>
                                <td class="text-center">{{ $diskon->expired }}</td>
                                @if ($diskon->deleted_at != null)
                                    <td class="text-center">Deleted</td>
                                    <td></td>
                                @else
                                    @if (date('Y-m-d') > $diskon->expired)
                                        <td class="text-center">Expired</td>
                                    @else
                                        <td class="text-center">Active</td>
                                    @endif
                                    <td class="cell-action">
                                        <button id="btn-{{ $diskon->id }}" class="btn btn-primary btn-sm btn-show-action" type="button">
                                            <i class="fas fa-bars"></i>
                                        </button>
                                    </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $diskons->links() }}
                @if(in_array("Menambah Data Diskon", Session::get('permissions')) || Session::get('role') == 'administrator')
                <button class="btn btn-primary btn-tambah mt-2" type="button">
                    <i class="fas fa-plus-circle"></i>
                    &nbsp;Tambah
                </button>
                @endif
                <ul class="list-unstyled form-control" id="list-action">
                    @if(in_array("Mengubah Data Diskon", Session::get('permissions')) || Session::get('role') == 'administrator')
                    <li id="action-update">Rubah data</li>
                    @endif
                    @if(in_array("Menghapus Data Diskon", Session::get('permissions')) || Session::get('role') == 'administrator')
                    <li id="action-delete">Hapus data</li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="modal fade" role="dialog" tabindex="-1" id="modal-diskon">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-fullscreen-lg-down" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Diskon Baru</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="modal-form" action="/data/diskon" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Kode Diskon</h5>
                                    <input class="form-control" type="text" id="input-kode" name="code" required>
                                </div>
                                <div class="col-12">
                                    <h5>Deskripsi</h5>
                                    <textarea class="form-control" id="input-deskripsi" name="description"></textarea>
                                </div>
                                <div class="col-6">
                                    <h5>Besar Diskon</h5>
                                    <div class="form-control d-flex">
                                        <p>Rp</p>
                                        <input class="w-100 ms-2 input-thousand-separator" type="text" id="input-nominal" name="nominal" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h5>Tanggal Expired</h5>
                                    <input class="form-control" type="date" id="input-expired" name="expired_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btn-submit" class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('js/data/diskon.js') }}"></script>
@endsection