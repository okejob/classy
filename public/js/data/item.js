$(document).ready(function() {
    $('#table-item').DataTable();

    var btnIndex = -1;
    $('#data-item .btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
    });

    $('#data-item .btn-tambah').on('click', function() {
        // reset form data

        $('#modal-update').modal('show');
    });

    $('#data-item #action-update').on('click', function() {
        // get data

        $('#modal-update').modal('show');
    });
});
