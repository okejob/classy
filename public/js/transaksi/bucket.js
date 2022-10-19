$(document).ready(function() {
    $('#modal-opsi-trans').modal({
        backdrop: 'static',
        keyboard: false
    });

    $('#modal-opsi-trans').modal('show');

    $('#show-option').on('click', function() {
        $('#modal-opsi-trans').modal('show');
    });

    let transState = true; // 1 -> look for trans, 0 -> create trans
    var trans = [], pelanggan = [], outlet = [];
    $('#table-list-trans tbody tr').on('click', function() {
        let id = $(this).children().eq(0).html();

        $.ajax({
            url: "/transaksi/getTrans/" + id,
        }).done(function(data) {
            trans = data[0];
            $('#id-trans').text(trans.id);
            $('#id-trans').show();

            $('#input-parfum').val(trans.parfum_id);

            console.log(trans);

            $.ajax({
                url: "/data/pelanggan/" + trans.pelanggan_id,
            }).done(function(data) {
                pelanggan = data[0];

                $('#input-nama').val(pelanggan.nama);
                $('#input-telepon').val(pelanggan.telephone);
                $('#input-alamat').val(pelanggan.alamat);
                $('#input-email').val(pelanggan.email);
                $('#input-tanggal-lahir').val(pelanggan.tanggal_lahir);

                $('#search-pelanggan').hide();
                $('#data-pelanggan').show();

                $.ajax({
                    url: "/setting/outlet/" + trans.outlet_id,
                }).done(function(data) {
                    outlet = data[0];

                    $('#select-outlet').attr('disabled', true);
                    $('#select-outlet').val(trans.outlet_id);
                    $('#input-alamat-outlet').val(outlet.alamat);


                    $('#show-data-pelanggan').trigger('click');
                    $('#show-data-outlet').trigger('click');
                    $('#modal-opsi-trans').modal('hide');
                    $('#section-transaksi-cuci').children('.row').show();
                });
            });
        });

    });

    $('#search-id-trans').on('click', function() {
        alert("ajax get trans list");
    });

    $('#add-new-trans').on('click', function() {
        transState = 0;
        trans = [], pelanggan = [], outlet = [];

        // $('#id-trans').val(id); perlu ajax ambil id baru

        let rowAdd = $('#table-trans-item tbody').children().last().detach();
        $('#table-trans-item tbody').empty();
        $('#table-trans-item tbody').append(rowAdd);

        $('#input-pafrum').val('');

        // reset pelanggan
        $('#input-nama').val('');
        $('#input-telepon').val('');
        $('#input-alamat').val('');
        $('#input-email').val('');
        $('#input-tanggal-lahir').val('');

        // reset outlet
        $('#select-outlet').attr('disabled', false);
        $('#select-outlet').val('');
        $('#input-alamat-outlet').val('');

        $('#search-pelanggan').show();
        $('#modal-opsi-trans').modal('hide');
        $('#section-transaksi-cuci').children('.row').show();
    });

    $('#select-outlet').on('change', function() {
        if ($(this).val() && !transState) {
            $.ajax({
                url: "/setting/outlet/" + $(this).val(),
            }).done(function(data) {
                outlet = data[0];

                $('#input-alamat-outlet').val(outlet.alamat);

                // console.log(outlet);
            });
        }
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

    $('#table-list-pelanggan tbody tr').on('click', function() {
        let id = $(this).attr('id').substring($(this).attr('id').indexOf('row-') + 4);

        $.ajax({
            url: "/data/pelanggan/" + id,
        }).done(function(data) {
            pelanggan = data[0];

            $('#input-nama').val(pelanggan.nama);
            $('#input-telepon').val(pelanggan.telephone);
            $('#input-alamat').val(pelanggan.alamat);
            $('#input-email').val(pelanggan.email);
            $('#input-tanggal-lahir').val(pelanggan.tanggal_lahir);

            // console.log(pelanggan);
        });

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
