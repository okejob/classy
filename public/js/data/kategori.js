$(document).ready(function() {
    $('#table-kategori').DataTable();

    var btnIndex = -1;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
    });

    $('#data-kategori .btn-tambah').on('click', function() {
        $('#update-nama-kategori').val('');
        $('#update-deskripsi').val('');

        $('#modal-update').modal('show');
    });

    $('#data-kategori #action-update').on('click', function() {
        $('#update-nama-kategori').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
        $('#update-deskripsi').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());

        $('#modal-update').modal('show');
    });
});
