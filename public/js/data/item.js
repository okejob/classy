$(document).ready(function() {
    if ($('#table-item tbody').children().length == 0) {
        $('#table-item tbody').append('<tr><td colspan=12 class="text-center">Data masih kosong</td></tr>');
    }

    var btnIndex = -1, btnId = 0;
    $('#data-item .btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    $('#data-item .btn-tambah').on('click', function() {
        btnIndex = -1;
        $('#modal-form').attr('action', "/data/jenis-item");

        $('#modal-update').modal('show');
    });

    $('#data-item #action-update').on('click', function() {
        // get data

        $('#modal-update').modal('show');
    });
});
