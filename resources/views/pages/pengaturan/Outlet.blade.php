@extends('layouts.users')

@section('content')
<div class="container">
    <header class="d-flex align-items-center my-3" style="color: var(--bs-gray);"><a>Pengaturan</a><i class="fas fa-angle-right mx-2"></i><a>Pengaturan Outlet</a></header>

    <section id="pengaturan-outlet">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pengaturan Data Outlet</h4>
                <hr />
                <div class="table-responsive">
                    <table class="table" id="table-pengaturan-outlet">
                        <thead>
                            <tr>
                                <th>Kode Outlet</th>
                                <th>Nama Outlet</th>
                                <th>Alamat</th>
                                <th>Telepon 1</th>
                                <th>Telepon 2</th>
                                <th>Nomor Fax</th>
                                <th>Saldo</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $outlet)
                            <tr>
                                <td>{{ $outlet->kode }}</td>
                                <td>{{ $outlet->nama }}</td>
                                <td>{{ $outlet->alamat }}</td>
                                <td>{{ $outlet->telp_1 }}</td>
                                <td>{{ $outlet->telp_2 }}</td>
                                <td>{{ $outlet->saldo }}</td>
                                <td>{{ $outlet->fax }}</td>
                                @if ($outlet->status)
                                    <td class="text-center">Aktif</td>
                                @else
                                    <td class="text-center">Tidak aktif</td>
                                @endif
                                <td class="cell-action"><button id="btn-{{ $outlet->id }}"  class="btn btn-primary btn-sm btn-show-action" type="button"><i class="fas fa-bars"></i></button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $data->links() }}
                @if(in_array("Membuat Outlet", Session::get('permissions')) || Session::get('role') == 'administrator')
                <button class="btn btn-primary" id="add-outlet" type="button">
                    <i class="fas fa-plus-circle"></i> Tambah
                </button>
                @endif
            </div>
            <ul class="list-unstyled form-control" id="list-action">
                @if(in_array("Mengubah Data Outlet", Session::get('permissions')) || Session::get('role') == 'administrator')
                <li id="action-update">Rubah data</li>
                @endif
            </ul>
        </div>
    </section>

    <div role="dialog" tabindex="-1" class="modal fade" id="modal-outlet">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Rubah Data Outlet</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-outlet" method="POST" action>
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h5>Kode Outlet</h5>
                                <input type="text" class="form-control" id="input-kode" name="kode" required />
                            </div>
                            <div class="col-12 col-sm-6">
                                <h5>Nama Outlet</h5>
                                <input type="text" class="form-control" id="input-nama" name="nama" required />
                            </div>
                            <div class="col-12">
                                <h5>Alamat lengkap</h5>
                                <input type="text" class="form-control" id="input-alamat" name="alamat" required />
                            </div>
                            <div class="col-12 col-sm-6" id="col-telp1">
                                <h5>Telepon 1</h5>
                                <input type="text" class="form-control" id="input-telp1" name="telp_1" required />
                            </div>
                            <div class="col-12 col-sm-6" id="col-telp2">
                                <h5>Telepon 2</h5>
                                <input type="text" class="form-control" id="input-telp2" name="telp_2" />
                            </div>
                            <div class="col-12 col-sm-6" id="col-fax">
                                <h5>Nomor Fax</h5>
                                <input type="text" class="form-control" id="input-fax" name="fax" />
                            </div>
                            <div class="col-12 col-sm-6" id="col-status">
                                <h5>Status</h5>
                                <div class="form-control d-flex justify-content-around" style="height: 38px;">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="radio-status-aktif" name="status" value=1 />
                                        <label class="form-check-label" for="radio-status-aktif">Aktif</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="radio-status-nonaktif" name="status" value=0 />
                                        <label class="form-check-label" for="radio-status-nonaktif">Tidak aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary float-end" type="submit"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/pengaturan/outlet.js') }}"></script>
@endsection
