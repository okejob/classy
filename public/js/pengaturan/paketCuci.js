$(document).ready(function() {
    var btnIndex = -1, btnId = 0;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    $('#action-update').on('click', function() {
        $('#form-paket-cuci').attr('action', "/setting/paket-cuci/" + btnId);
        $('#modal-title').text('Rubah paket');

        $('#input-nama-paket').val($('#table-paket-cuci tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
        $('#input-deskripsi').val($('#table-paket-cuci tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
        $('#input-bobot-paket').val($('#table-paket-cuci tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html());
        $('#input-harga-paket').val($('#table-paket-cuci tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html().replace('.', ''));
        if ($('#table-paket-cuci tbody tr:nth-child(' + btnIndex + ') td:nth-child(8)').html() == 'Aktif') {
            $('#radio-status-tidakAktif').attr('checked', false);
            $('#radio-status-aktif').attr('checked', true);
        } else if ($('#table-paket-cuci tbody tr:nth-child(' + btnIndex + ') td:nth-child(8)').html() == 'Tidak aktif') {
            $('#radio-status-aktif').attr('checked', false);
            $('#radio-status-tidakAktif').attr('checked', true);
        }

        $('#modal-paket-cuci').modal('show');
    });

    $('.btn-add').on('click', function() {
        $('#form-paket-cuci').attr('action', "/setting/paket-cuci");
        $('#modal-title').text('Tambah paket');

        $('#input-nama-paket').val('');
        $('#input-deskripsi').val('');
        $('#input-bobot-paket').val(0);
        $('#input-harga-paket').val(0);
        $('#radio-status-aktif').attr('checked', false);
        $('#radio-status-tidakAktif').attr('checked', false);

        $('#modal-paket-cuci').modal('show');
    });

    $('#action-delete').on('click', function() {
        if (confirm('Yakin menghapus paket ?')) {
            $.ajax({
                url: "/setting/paket-cuci/delete/" + btnId,
            }).done(function() {
                location.reload();
            });
        }
    });
});



