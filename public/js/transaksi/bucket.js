$(document).ready(function() {
    $('#modal-opsi-trans').modal('show');

    $('#show-option').on('click', function() {
        $('#modal-opsi-trans').modal('show');
    });

    $('#table-list-trans tbody tr').on('click', function() {
        //alert("reset isi halaman, get data & fill data trans");
        let id = $(this).children().eq(0).html();

        $.ajax({
            url: "/transaksi/getTrans/" + id,
        }).done(function(data) {
            $('#id-trans').text(data[0].id);
            $('#id-trans').show();
        });

        $.ajax({
            url: "/transaksi/getTrans/" + id,
        }).done(function(data) {
            
        });

        $('#modal-opsi-trans').modal('hide');
    });

    $('#search-id-trans').on('click', function() {
        alert("ajax get trans list");
    });

    $('#add-new-trans').on('click', function() {
        alert("generate trans id baru & reset isi halaman");
    });

    // bagian kanan
    $('.show-data').on('click', function() {
        let dataType = $(this).attr('id').substring($(this).attr('id').indexOf('data-') + 5);
        if (!$(this).hasClass('show')) {
            $(this).addClass('show');
            $(this).children().addClass('fa-rotate-180');

            $('#info-' + dataType).show();
        } else {
            $(this).removeClass('show');
            $(this).children().removeClass('fa-rotate-180');

            $('#info-' + dataType).hide();
        }
    });

    $('#search-pelanggan').on('click', function() {
        $('#modal-list-pelanggan').modal('show');
    });

    $('#table-list-pelanggan tbody tr').on('dblclick', function() {
        alert("reset isi data pelanggan, get data & fill data pelanggan");
        let nama = $(this).children().eq(0).html();
        alert("Selected nama pelanggan: " + nama);

        $('#search-pelanggan').text('Ganti pelanggan');
        $('#data-pelanggan').show();
        $('#modal-list-pelanggan').modal('hide');
    });

    $('#info-pickup-delivery input[type=checkbox]').on('change', function() {
        if (this.checked) {
            $(this).parent().next().show();
        } else {
            $(this).parent().next().hide();
        }
    });

    let expandState = false;
    const leftCol = $('#expand-table').closest('.row').children().eq(0);
    const rightCol = $('#expand-table').closest('.row').children().eq(1);
    $('#expand-table').on('click', function() {
        expandState = !expandState;
        if (expandState) {
            $(this).children().removeClass('fa-expand-alt');
            $(this).children().addClass('fa-compress-alt');

            leftCol.removeClass('col-8');
            leftCol.addClass('col-12');

            rightCol.removeClass('col-4');
            rightCol.addClass('d-none');
        } else {
            $(this).children().removeClass('fa-compress-alt');
            $(this).children().addClass('fa-expand-alt');

            leftCol.removeClass('col-12');
            leftCol.addClass('col-8');

            rightCol.removeClass('d-none');
            rightCol.addClass('col-4');
        }
    });


    // bagian kiri
    $('#show-catatan-trans').on('click', function() {
        $(this).next().show();
    });

    $('#save-catatan-trans').on('click', function() {
        // ajax save catatan
        $(this).closest('div').hide();
    });
});
