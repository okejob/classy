$(document).ready(function() {

    var btnIndex = -1;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
    });

    $('#action-update').on('click', function() {
        $('#input-kode').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
        $('#input-nama').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
        $('#input-alamat').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html());
        $('#input-telp1').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(4)').html());
        $('#input-telp2').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(5)').html());
        $('#input-fax').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(6)').html());
        if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html() == 'Aktif') {
            $('#radio-status-aktif').attr('checked', true);
        } else if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html() == 'Tidak aktif') {
            $('#radio-status-nonaktif').attr('checked', true);
        }

        $('#col-telp1').removeClass('col-sm-4');
        $('#col-telp2').removeClass('col-sm-4');
        $('#col-fax').removeClass('col-sm-4');
        $('#col-telp1').addClass('col-sm-6');
        $('#col-telp2').addClass('col-sm-6');
        $('#col-fax').addClass('col-sm-6');
        $('#col-status').show();

        $('#modal-outlet').modal('show');
    });

    $('#add-outlet').on('click', function() {
        $('#input-kode').val('');
        $('#input-nama').val('');
        $('#input-alamat').val('');
        $('#input-telp1').val('');
        $('#input-telp2').val('');
        $('#input-fax').val('');

        $('#col-telp1').removeClass('col-sm-6');
        $('#col-telp2').removeClass('col-sm-6');
        $('#col-fax').removeClass('col-sm-6');
        $('#col-telp1').addClass('col-sm-4');
        $('#col-telp2').addClass('col-sm-4');
        $('#col-fax').addClass('col-sm-4');
        $('#col-status').hide();

        $('#modal-outlet').modal('show');
    })
});
