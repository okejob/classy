$(document).ready(function() {
    $('#table-parfum').DataTable();

    var btnIndex = -1;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
    });

    $('#data-parfum .btn-tambah').on('click', function() {
        $('#update-nama-parfum').val('');
        $('#update-deskripsi').val('');
        $('#update-jenis').eq(1).prop('selected', true);

        $('#modal-update').modal('show');
    });

    $('#data-parfum #action-update').on('click', function() {
        $('#input-nama-parfum').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
        $('#input-deskripsi').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
        $('#input-jenis').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html());

        $('#modal-update').modal('show');
    });
});
