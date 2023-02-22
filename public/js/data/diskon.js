$(document).ready(function() {
    if ($('#table-diskon tbody').children().length == 0) {
        $('#table-diskon tbody').append('<tr><td colspan=4 class="text-center">Data masih kosong</td></tr>');
    }

    if($('#list-action').children().length == 0) {
        $('#list-action').detach();
    }
    var btnIndex = -1, btnId = 0;
    $('#data-diskon .btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    $('#data-diskon .btn-tambah').on('click', function() {
        btnIndex = -1;
        $('#modal-form').attr('action', "/data/diskon/insert");
        $('.modal-title').text('Diskon baru');

        $('#input-kode').val('');
        $('#input-deskripsi').val('');
        $('#input-nominal').val('');

        $('#modal-diskon').modal('show');
    });

    $('#data-diskon #action-update').on('click', function() {
        $('#modal-form').attr('action', "/data/diskon/update/" + btnId);
        $('.modal-title').text('Rubah diskon');

        $('#input-nama').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
        $('#input-deskripsi').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
        $('#input-nominal').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html().replace('.', ''));

        $('#modal-diskon').modal('show');
    });

    $('#action-delete').on('click', function() {
        if (confirm('Yakin menghapus data ?')) {
            $.ajax({
                url: "/data/diskon/delete/" + btnId,
            }).done(function() {
                window.location = window.location.origin + window.location.pathname;
            });
        }
    });

    $('#modal-form').on('submit', function(e) {
        e.preventDefault();
        $('#btn-submit').addClass('disabled');
        e.currentTarget.submit();
    });
});
