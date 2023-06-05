$(document).ready(function() {
    function karyawanHubCheck() {
        $('.hub-list').each(function() {
            if ($(this).children().length == 0) {
                if ($(this).hasClass('hub-cuci')) {
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
    $(".hub-cuci, .hub-karyawan").sortable({
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
                    url: "/transaksi/" + currentlySelectedItemId + "/pencuci",
                }).done(function() {
                    ui.item.removeClass('disabled');
                });
            } else if (ui.item.parent().hasClass('hub-cuci')) {
                $.ajax({
                    url: "/transaksi/" + currentlySelectedItemId + "/pencuci/delete",
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

        if ($(this).closest('.hub-cuci').length != 0) {
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
        $('#table-short-trans').load(window.location.origin + '/component/shortTrans/' + btnId);
        $('#modal-detail').modal('show');
    });

    $('#action-add').on('click', function() {
        $('#trans-' + btnId).addClass('disabled');
        let temp = $('#trans-' + btnId).parent().parent().detach();
        $.ajax({
            url: "/transaksi/" + btnId + "/pencuci",
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
            url: "/transaksi/" + btnId + "/pencuci/delete",
        }).done(function(error) {
            if (error.message) {
                alert("error");
                console.log(message);
                $('#trans-' + btnId).removeClass('disabled');
            } else {
                $('.hub-cuci').append(temp);
                $('#trans-' + btnId).removeClass('disabled');
                karyawanHubCheck();
            }
        });
    });

    $('#action-done').on('click', function() {
        if(confirm("Nyatakan cuci selesai ?")) {
            $.ajax({
                url: "/transaksi/" + btnId + "/pencuci/done",
            }).done(function() {
                location.reload();
            });
        }
    });

    var flag = false;
    var btnItemTransId = 0;
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
        btnItemTransId = $(this).attr('id').substring(4);
        flag = true;
    });

    $(document).on('click', function() {
        setTimeout(function (){
            if (flag) {
                flag = !flag;
            } else {
                if ($('#list-action-2').css('display') == 'block') {
                    $('#list-action-2').hide();
                }
            }
        }, 10);
    });

    $('#action-notes').on('click', function() {
        console.log('open note');
    });
});
