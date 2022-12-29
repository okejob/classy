$(document).ready(function() {
    if ($('#table-item tbody').children().length == 0) {
        $('#table-item tbody').append('<tr><td colspan=4 class="text-center">Data masih kosong</td></tr>');
    }

    var btnIndex = -1, btnId = 0;
    $('#data-inventory .btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    $('#data-item .btn-tambah').on('click', function() {
        btnIndex = -1;
        $('#modal-form').attr('action', "/data/inventory");
        $('#modal-title').text('Tambah jenis item');

        $('#input-nama-inventory').val('');
        $('#input-jumlah').val('pcs');
        $('#formCheck-aktif').attr('checked', true);
        $('#formCheck-tidakAktif').attr('checked', false);
        $('#modal-form .modal-body .row .col-12:nth-child(3)').hide();

        $('#modal-inventory').modal('show');
    });

    $('#data-item #action-update').on('click', function() {
        $('#modal-form').attr('action', "/data/inventory/" + btnId);
        $('#modal-title').text('Rubah item inventory');

        $('#input-nama-inventory').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
        $('#input-jumlah').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
        if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html() == "Aktif") {
            $('#formCheck-item-aktif').attr('checked', true);
        } else if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html() == "Tidak aktif") {
            $('#formCheck-item-tidakAktif').attr('checked', true);
        }
        $('#modal-form .modal-body .row .col-12:nth-child(3)').show();

        $('#modal-update').modal('show');
    });

    $('#action-delete').on('click', function() {
        if (confirm('Yakin menghapus data ?')) {
            $.ajax({
                url: "/data/inventory/delete/" + btnId,
            }).done(function() {
                window.location = window.location.origin + window.location.pathname;
            });
        }
    });
});
