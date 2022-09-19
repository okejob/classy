$(document).ready(function() {
    $('#table-pengeluaran').DataTable();

    var btnIndex = -1;
    $('#data-pengeluaran .btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
    });

    $('#data-pengeluaran .btn-tambah').on('click', function() {
        // reset form data

        $('#modal-update').modal('show');
    });

    $('#data-pengeluaran #action-update').on('click', function() {
        // get data

        $('#modal-update').modal('show');
    });
});
