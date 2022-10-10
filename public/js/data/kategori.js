$(document).ready(function() {
    var btnIndex = -1, btnId = 0;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    $('#data-kategori .btn-tambah').on('click', function() {
        btnIndex = -1;
        $('#modal-form').attr('action', "/data/kategori");
        $('#input-nama-kategori').val('');
        $('#input-deskripsi').val('');

        $('#modal-update').modal('show');
    });

    $('#data-kategori #action-update').on('click', function() {
        $('#modal-form').attr('action', "/data/kategori/" + btnId);
        $('#input-nama-kategori').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
        $('#input-deskripsi').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());

        $('#modal-update').modal('show');
    });
});
