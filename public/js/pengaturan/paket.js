$(document).ready(function() {
    var btnIndex = -1;
    var tipePaket = '';
    $('.btn-show-action').on('click', function() {
        tipePaket = $(this).closest('section').attr('id');
        tipePaket = tipePaket.substring(17);
        if (tipePaket == 'cuci') {
            btnIndex = $(this).index('.btn-show-action') + 1;
        } else if (tipePaket == 'deposit') {
            btnIndex = $(this).index('.btn-show-action') + 1 - $('#pengaturan-paket-cuci .btn-show-action').length;
        }
    });

    $('#action-update').on('click', function() {
        if (tipePaket == 'cuci') {
            $('#pengaturan-paket-cuci #input-nama-paket').val($('#table-paket-cuci tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
            $('#pengaturan-paket-cuci #input-deskripsi').val($('#table-paket-cuci tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
            $('#pengaturan-paket-cuci #input-bobot-paket').val($('#table-paket-cuci tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html());
            $('#pengaturan-paket-cuci #input-harga-paket').val($('#table-paket-cuci tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html().replace('.', ''));
            if ($('#table-paket-cuci tbody tr:nth-child(' + btnIndex + ') td:nth-child(8)').html() == 'Aktif') {
                $('#pengaturan-paket-cuci #radio-status-nonaktif-1').attr('checked', false);
                $('#pengaturan-paket-cuci #radio-status-aktif-1').attr('checked', true);
            } else if ($('#table-paket-cuci tbody tr:nth-child(' + btnIndex + ') td:nth-child(8)').html() == 'Tidak aktif') {
                $('#pengaturan-paket-cuci #radio-status-aktif-1').attr('checked', false);
                $('#pengaturan-paket-cuci #radio-status-nonaktif-1').attr('checked', true);
            }

            $('#modal-update-paket-cuci').modal('show');
        } else if (tipePaket == 'deposit') {
            $('#pengaturan-paket-deposit #input-nama-paket').val($('#table-paket-deposit tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
            $('#pengaturan-paket-deposit #input-deskripsi').val($('#table-paket-deposit tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
            $('#pengaturan-paket-deposit #input-harga-paket').val($('#table-paket-deposit tbody tr:nth-child(' + btnIndex + ') td:nth-child(5)').html().replace('.', ''));
            $('#pengaturan-paket-deposit #input-nominal').val($('#table-paket-deposit tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html().replace('.', ''));
            if ($('#table-paket-deposit tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html() == 'Aktif') {
                $('#pengaturan-paket-deposit #radio-status-nonaktif-2').attr('checked', false);
                $('#pengaturan-paket-deposit #radio-status-aktif-2').attr('checked', true);
            } else if ($('#table-paket-deposit tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html() == 'Tidak aktif') {
                $('#pengaturan-paket-deposit #radio-status-aktif-2').attr('checked', false);
                $('#pengaturan-paket-deposit #radio-status-nonaktif-2').attr('checked', true);
            }

            $('#modal-update-paket-deposit').modal('show');
        } else {
            console.log(tipePaket);
        }
    });

    $('.btn-add').on('click', function() {
        tipePaket = $(this).closest('section').attr('id');
        tipePaket = tipePaket.substring(17);
        if (tipePaket == 'cuci') {
            $('#pengaturan-paket-cuci #input-nama-paket').val('');
            $('#pengaturan-paket-cuci #input-deskripsi').val('');
            $('#pengaturan-paket-cuci #input-bobot-paket').val(0);
            $('#pengaturan-paket-cuci #input-harga-paket').val(0);
            $('#pengaturan-paket-cuci #radio-status-aktif-1').attr('checked', false);
            $('#pengaturan-paket-cuci #radio-status-nonaktif-1').attr('checked', false);

            $('#modal-update-paket-cuci').modal('show');
        } else if (tipePaket == 'deposit') {
            $('#pengaturan-paket-deposit #input-nama-paket').val('');
            $('#pengaturan-paket-deposit #input-deskripsi').val('');
            $('#pengaturan-paket-deposit #input-harga-paket').val(0);
            $('#pengaturan-paket-deposit #input-nominal').val(0);
            $('#pengaturan-paket-deposit #radio-status-aktif-2').attr('checked', false);
            $('#pengaturan-paket-deposit #radio-status-nonaktif-2').attr('checked', false);

            $('#modal-update-paket-deposit').modal('show');
        } else {
            console.log(tipePaket);
        }
    });
});
