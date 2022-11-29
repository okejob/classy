$(document).ready(function() {
    var btnIndex = -1, btnId = 0;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    $('#action-update').on('click', function() {
        $('#form-paket-deposit').attr('action', "/setting/paket-deposit/" + btnId);
        $('#modal-title').text('Rubah paket');

        $('#input-nama-paket').val($('#table-paket-deposit tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
        $('#input-deskripsi').val($('#table-paket-deposit tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
        $('#input-nominal').val($('#table-paket-deposit tbody tr:nth-child(' + btnIndex + ') td:nth-child(4)').html().replace('.', ''));
        $('#input-harga-paket').val($('#table-paket-deposit tbody tr:nth-child(' + btnIndex + ') td:nth-child(6)').html().replace('.', ''));
        if ($('#table-paket-deposit tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html() == 'Aktif') {
            $('#radio-status-tidakAktif').attr('checked', false);
            $('#radio-status-aktif').attr('checked', true);
        } else if ($('#table-paket-deposit tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html() == 'Tidak aktif') {
            $('#radio-status-aktif').attr('checked', false);
            $('#radio-status-tidakAktif').attr('checked', true);
        }

        $('#modal-paket-deposit').modal('show');
    });

    $('.btn-add').on('click', function() {
        $('#form-paket-deposit').attr('action', "/setting/paket-deposit");
        $('#modal-title').text('Rubah paket');

        $('#input-nama-paket').val('');
        $('#input-deskripsi').val('');
        $('#input-harga-paket').val(0);
        $('#input-nominal').val(0);
        $('#radio-status-aktif').attr('checked', false);
        $('#radio-status-tidakAktif').attr('checked', false);

        $('#modal-paket-deposit').modal('show');
    });

    $('#action-delete').on('click', function() {
        if (confirm('Yakin menghapus paket ?')) {
            $.ajax({
                url: "/setting/paket-deposit/delete/" + btnId,
            }).done(function() {
                window.location = window.location.origin + window.location.pathname;
            });
        }
    });
});
