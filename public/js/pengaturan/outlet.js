$(document).ready(function() {
    if($('#list-action').children().length == 0) {
        $('#list-action').detach();
    }
    var btnIndex = -1, btnId = 0;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    // untuk update data outlet
    $('#action-update').on('click', function() {
        $('#form-outlet').attr('action', "/setting/outlet/" + btnId);
        $('.modal-title').text('Rubah outlet');

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

    // untuk menambah data outlet
    $('#add-outlet').on('click', function() {
        $('#form-outlet').attr('action', "/setting/outlet");
        $('.modal-title').text('Tambah outlet');

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
    });
});
