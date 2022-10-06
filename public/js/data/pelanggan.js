$(document).ready(function() {
    $('#table-pelanggan').DataTable();

    var btnIndex = -1;
    $('#data-pelanggan .btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
    });

    $('#data-pelanggan .btn-tambah').on('click', function() {
        // reset form data

        $('#modal-update').modal('show');
    });

    $('#data-pelanggan #action-update').on('click', function() {
        // get data

        $('#modal-update').modal('show');
    });
});
