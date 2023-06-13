$(document).ready(function() {
    function karyawanHubCheck() {
        $('.hub-list').each(function() {
            if ($(this).children().length == 0) {
                if ($(this).hasClass('hub-setrika')) {
                    $(this).append('<div class="alert alert-success" role="alert">Tidak ada pekerjaan</div>');
                } else {
                    $(this).append('<div class="alert alert-warning" role="alert">Tidak ada pekerjaan</div>');
                }
            } else {
                $(this).find('.alert').detach();
            }
        });
    }
    karyawanHubCheck();

    var currentlySelectedItemId = 0;
    $(".hub-setrika, .hub-karyawan").sortable({
        connectWith: ".hub-list",
        placeholder: "sortable-placeholder",
        items: ".item",
        start: function( event, ui ) {
            currentlySelectedItemId = ui.item.find('.btn').attr('id').substring(6);
        },
        receive: function( event, ui ) {
            karyawanHubCheck();
            ui.item.addClass('disabled');
            if (ui.item.parent().hasClass('hub-karyawan')) {
                $.ajax({
                    url: "/transaksi/" + currentlySelectedItemId + "/penyetrika",
                }).done(function() {
                    ui.item.removeClass('disabled');
                });
            } else if (ui.item.parent().hasClass('hub-setrika')) {
                $.ajax({
                    url: "/transaksi/" + currentlySelectedItemId + "/penyetrika/delete",
                }).done(function() {
                    ui.item.removeClass('disabled');
                });
            }
        },
    }).disableSelection();

    var btnIndex = -1, btnId = 0;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(6);

        if ($(this).closest('.hub-setrika').length != 0) {
            $('#action-add').show();
            $('#action-remove').hide();
            $('#action-done').hide();
        } else if ($(this).closest('.hub-karyawan').length != 0) {
            $('#action-add').hide();
            $('#action-remove').show();
            $('#action-done').show();
        }
    });

    $('#action-detail').on('click', function() {
        $('#table-short-trans').load(window.location.origin + '/component/shortTrans/' + btnId + '/process');
        $('#kode-trans').text($('.btn-show-action').eq(btnIndex - 1).prev().find('h4').text());
        $('#modal-detail').modal('show');
    });

    $('#action-add').on('click', function() {
        $('#trans-' + btnId).addClass('disabled');
        let temp = $('#trans-' + btnId).parent().parent().detach();
        $.ajax({
            url: "/transaksi/" + btnId + "/penyetrika",
        }).done(function() {
            $('.hub-karyawan').append(temp);
            $('#trans-' + btnId).removeClass('disabled');
            karyawanHubCheck();
        });
    });

    $('#action-remove').on('click', function() {
        $('#trans-' + btnId).addClass('disabled');
        let temp = $('#trans-' + btnId).parent().parent().detach();
        $.ajax({
            url: "/transaksi/" + btnId + "/penyetrika/delete",
        }).done(function(error) {
            if (error.message) {
                alert("error");
                console.log(message);
                $('#trans-' + btnId).removeClass('disabled');
            } else {
                $('.hub-setrika').append(temp);
                $('#trans-' + btnId).removeClass('disabled');
                karyawanHubCheck();
            }
        });
    });

    $('#action-done').on('click', function() {
        if(confirm("Nyatakan setrika selesai ?")) {
            $.ajax({
                url: "/transaksi/" + btnId + "/penyetrika/done",
            }).done(function() {
                location.reload();
            });
        }
    });

    var flag = false;
    var btnItemTransId = 0, btnItemTransName = '';
    $('#table-short-trans').on('click', '.btn-show-action-2', function() {
        let lebarList = 150;
        let lebarBtn = $(this).css('width');
        let lebarTambahan = 2;
        lebarBtn = parseInt(lebarBtn.substr(0, lebarBtn.indexOf('px')));
        $('#list-action-2').css('left', $(this).offset().left - $('#modal-detail .modal-body').offset().left - lebarList + lebarBtn + lebarTambahan);

        let tinggiBtn = $(this).css('height');
        let tinggiHeader = 0;
        tinggiBtn = parseInt(tinggiBtn.substr(0, tinggiBtn.indexOf('px')));
        $('#list-action-2').css('top', $(this).offset().top - $('#modal-detail .modal-body').offset().top + tinggiBtn + tinggiHeader);
        $('#list-action-2').show();
        btnItemTransId = $(this).attr('id').substr(4);
        btnItemTransName = $(this).closest('tr').children(0).html();
        btnItemTransId = $(this).attr('id').substring(4);
        flag = true;
    });

    $(document).on('click', function() {
        setTimeout(function (){
            if (flag) {
                flag = !flag;
            } else {
                $('.list-action').each(function(index, element) {
                    if ($(element).css('display') == 'block') {
                        $(element).hide();
                    }
                });
            }
        }, 10);
    });

    $('#action-notes').on('click', function() {
        $('#table-catatan-item').load(window.location.origin + '/component/note/' + btnItemTransId, function() {
            $('#modal-list-catatan-item').modal('show');
        });
    });

    $('#action-rewash').on('click', function() {
        $('#input-nama').val($('#btn-' + btnItemTransId).closest('tr').children().eq(0).html());
        $('#input-jenis').val("");
        $('#input-keterangan').val("");
        $('#input-hidden-id').val(btnItemTransId);
        $('#modal-rewash').modal('show');
    });

    var btnItemNoteId = 0;
    $('#table-catatan-item').on('click', '.btn-show-action-2', function() {
        let lebarList = 150;
        let lebarBtn = $(this).css('width');
        let lebarTambahan = 2;
        lebarBtn = parseInt(lebarBtn.substr(0, lebarBtn.indexOf('px')));
        $('#list-action-3').css('left', $(this).offset().left - $('#modal-list-catatan-item .modal-body').offset().left - lebarList + lebarBtn + lebarTambahan);
        let tinggiBtn = $(this).css('height');
        let tinggiHeader = 0;
        tinggiBtn = parseInt(tinggiBtn.substr(0, tinggiBtn.indexOf('px')));
        $('#list-action-3').css('top', $(this).offset().top - $('#modal-list-catatan-item .modal-body').offset().top + tinggiBtn + tinggiHeader);
        $('#list-action-3').show();
        btnItemNoteId = $(this).closest('tr').attr('id');
        flag = true;
    });

    $('#action-detail-note').on('click', function() {
        $('#catatan-item-name').text(btnItemTransName);
        $.ajax({
            url: "/transaksi/item/note/" + btnItemNoteId,
        }).done(function(data) {
            let transNote = data[0];

            $('#penulis-catatan-item').parent().show();
            $('#penulis-catatan-item').val(transNote.nama_user);
            $('#catatan-item').val(transNote.catatan);
            $('#container-image-item').attr('src', transNote.image_path);

            transNote.front_top_left == 1 ? $('#td-kiri-atas').addClass('selected') : $('#td-kiri-atas').removeClass('selected');
            transNote.front_top_right == 1 ? $('#td-kanan-atas').addClass('selected') : $('#td-kanan-atas').removeClass('selected');
            transNote.front_bottom_left == 1 ? $('#td-kiri-bawah').addClass('selected') : $('#td-kiri-bawah').removeClass('selected');
            transNote.front_bottom_right == 1 ? $('#td-kanan-bawah').addClass('selected') : $('#td-kanan-bawah').removeClass('selected');
            transNote.back_top_left == 1 ? $('#tb-kiri-atas').addClass('selected') : $('#tb-kiri-atas').removeClass('selected');
            transNote.back_top_right == 1 ? $('#tb-kanan-atas').addClass('selected') : $('#tb-kanan-atas').removeClass('selected');
            transNote.back_bottom_left == 1 ? $('#tb-kiri-bawah').addClass('selected') : $('#tb-kiri-bawah').removeClass('selected');
            transNote.back_bottom_right == 1 ? $('#tb-kanan-bawah').addClass('selected') : $('#tb-kanan-bawah').removeClass('selected');

            $('#penulis-catatan-item').addClass('disabled');
            $('#catatan-item').addClass('disabled');
            $('#input-foto-item').hide();
            $('#tab-noda').addClass('disabled');

            $('#modal-catatan-item .modal-footer').hide();
            $('#modal-catatan-item').modal('show');
        });
    });
});
