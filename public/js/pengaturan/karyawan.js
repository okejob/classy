$(document).ready(function() {
    var btnIndex = -1, btnId = 0;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    $('#action-update').on('click', function() {
        $('#form-karyawan').attr('action', "/setting/karyawan/" + btnId);

        $('#input-username').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
        $('#input-nama').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
        $('#input-telepon').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html());
        $('#input-email').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(4)').html());
        $("#input-outlet option:contains(" + $('tbody tr:nth-child(' + btnIndex + ') td:nth-child(5)').html() +")").attr("selected", true);
        $("#input-role option:contains(" + $('tbody tr:nth-child(' + btnIndex + ') td:nth-child(6)').html() +")").attr("selected", true);
        if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html() == 'Aktif') {
            $('#radio-status-aktif').attr('checked', true);
        } else if ($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(7)').html() == 'Tidak aktif') {
            $('#radio-status-tidakAktif').attr('checked', true);
        }

        $('#modal-data-user').modal('show');
    });

    $('#btn-add').on('click', function() {
        $('#input-username').val('');
        $('#input-nama').val('');
        $('#input-telepon').val('');
        $('#input-email').val('');
        $('#input-outlet').val('');
        $('#input-role').val('');
        $('#col-status').hide();
        $('#radio-status-aktif').attr('checked', false);
        $('#radio-status-tidakAktif').attr('checked', false);

        $('#modal-data-user').modal('show');
    });

    $('#action-change-password').on('click', function() {
        $('#modal-change-password').modal('show');
    });

    $('#btn-change-password').on('click', function() {
        $(this).addClass('disabled');
        $('#error-msg').parent().addClass('d-none');

        let formData = new FormData();
        formData.append('current_password', $('#input-password-lama').val());
        formData.append('new_password', $('#input-password-baru').val());
        formData.append('new_password_confirmation', $('#input-konfirmasi').val());

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "/setting/karyawan/" + btnId + "/change-password",
            method: "POST",
            contentType: false,
            processData: false,
            data: formData,
        }).done(function(data) {
            $('#btn-change-password').removeClass('disabled');
            if (data.message == "Success") {
                $('#modal-change-password').modal('hide');
            } else {
                $('#error-msg').text(data.message);
                $('#error-msg').parent().removeClass('d-none');
            }
        }).fail(function(message) {
            alert('error');
            console.log(message);
        });
    });
});
