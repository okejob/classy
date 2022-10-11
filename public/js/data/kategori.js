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
        console.log($('#modal-form .modal-body .row .col-12:nth-child(3)'));
        $('#formCheck-aktif').attr('checked', false);
        $('#formCheck-tidakAktif').attr('checked', false);
        $('#modal-form .modal-body .row .col-12:nth-child(3)').hide();

        $('#modal-update').modal('show');
    });

    $('#data-kategori #action-update').on('click', function() {
        $('#modal-form').attr('action', "/data/kategori/" + btnId);
        $('#input-nama-kategori').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
        $('#input-deskripsi').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
        if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html() == "Aktif") {
            $('#formCheck-aktif').attr('checked', true);
        } else if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html() == "Tidak aktif"){
            $('#formCheck-tidakAktif').attr('checked', true);
        } else {
            console.log($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html());
        }
        $('#modal-form .modal-body .row .col-12:nth-child(3)').show();

        $('#modal-update').modal('show');
    });
});
