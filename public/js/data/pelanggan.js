$(document).ready(function() {
    $('#table-pelanggaran').DataTable();

    var btnIndex = -1;
    $('#data-pelanggaran .btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
    });

    $('#data-pelanggaran .btn-tambah').on('click', function() {
        // reset form data

        $('#modal-update').modal('show');
    });

    $('#data-pelanggaran #action-update').on('click', function() {
        // get data

        $('#modal-update').modal('show');
    });
});
