$(document).ready(function() {
    // untuk menampilkan modal pickup
    $('#create-pickup').on('click', function() {
        $('#modal-create-pickup').modal('show');
    });

    // untuk menampilkan modal delivery
    $('#create-delivery').on('click', function() {
        $('#modal-create-delivery').modal('show');
    });

    $('#table-pickup').load(window.location.origin + '/component/pickup');
    $('#section-pickup').on('click', '.page-link', function(e) {
        e.preventDefault();
        $('#table-pickup').load($(this).attr('href'));
    });

    $('#table-delivery').load(window.location.origin + '/component/delivery');
    $('#section-delivery').on('click', '.page-link', function(e) {
        e.preventDefault();
        $('#table-delivery').load($(this).attr('href'));
    });

    $('#table-di-outlet').load(window.location.origin + '/component/ambil_di_outlet');
    $('#section-ambil-outlet').on('click', '.page-link', function(e) {
        e.preventDefault();
        $('#table-di-outlet').load($(this).attr('href'));
    });

    $('.btn-toggle').on('click', function() {
        let icon = $(this).children();
        if (icon.hasClass('fa-down-left-and-up-right-to-center')) {
            icon.removeClass('fa-down-left-and-up-right-to-center');
            icon.addClass('fa-up-right-and-down-left-from-center');
            icon.closest('div').next().hide();
        } else {
            icon.removeClass('fa-up-right-and-down-left-from-center');
            icon.addClass('fa-down-left-and-up-right-to-center');
            icon.closest('div').next().show();
        }
    });

    var btnIndex = -1, btnId = 0, currentlySelectedType = '', transId = 0;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).closest('.border.rounded').data('transaksi');
        if ($(this).closest('.card-pickup').length == 1) {
            currentlySelectedType = "pickup";
            transId = 0;
            $('#action-detail').hide();
        } else if ($(this).closest('.card-delivery').length == 1) {
            currentlySelectedType = "delivery";
            transId = $(this).closest('.card-delivery').data('transaksi');
            $('#action-detail').show();
        }
    });

    $('#action-change-status').on('click', function() {
        if (confirm('Nyatakan ' + currentlySelectedType + ' selesai ?') == true) {
            $.ajax({
                url: "/transaksi/pickup-delivery/" + btnId + "/is-done",
            }).done(function(data) {
                window.location = window.location.origin + window.location.pathname;
            });
        }
    });

    $(".hub-karyawan").sortable();

    $('#action-detail').on('click', function() {
        $('#kode-transaksi').text($('h6').eq(btnIndex).text());

        // not done
        $('#table-short-trans').load(window.location.origin + '/component/shortTrans/' + btnId + '/delivery');
        $('#kode-trans').text($('.btn-show-action').eq(btnIndex - 1).prev().find('h4').text());
        $('#modal-transaksi').modal('show');

        // $.ajax({
        //     url: "/transaksi/detail/" + transId,
        // }).done(function(data) {
        //     $('#kode-transaksi').text(data.kode);
        //     if (data.kode.indexOf('BU') !== -1) {
        //         $('#detail-transaksi').load(window.location.origin + "/component/transBucket/" + transId, function() {
        //             $('#detail-transaksi tbody tr:last-child').detach();
        //             $('#detail-transaksi tr').each(function(index, element) {
        //                 $(this).children().eq(6).detach();
        //                 $(this).children().eq(5).detach();
        //                 $(this).children().eq(4).detach();
        //                 $(this).children().eq(2).detach();
        //             });
        //             $('#detail-transaksi tfoot').detach();
        //             $('#modal-transaksi').modal('show');
        //         });
        //     } else if (data.kode.indexOf('PR') !== -1) {
        //         $('#detail-transaksi').load(window.location.origin + "/component/transPremium/" + transId, function() {
        //             $('#detail-transaksi thead th:nth-child(7), #detail-transaksi thead th:nth-child(6), #detail-transaksi thead th:nth-child(5), #detail-transaksi thead th:nth-child(3)').detach();
        //             $('#detail-transaksi tbody tr:last-child').detach();
        //             $('#detail-transaksi tbody tr').each(function(index, element) {
        //                 $(this).children().eq(8).detach();
        //                 $(this).children().eq(7).detach();
        //                 $(this).children().eq(6).detach();
        //                 $(this).children().eq(5).detach();
        //                 $(this).children().eq(4).detach();
        //                 $(this).children().eq(2).detach();
        //             });
        //             $('#detail-transaksi tfoot').detach();
        //             $('#modal-transaksi').modal('show');
        //         });
        //     }
        // });
    });
});
