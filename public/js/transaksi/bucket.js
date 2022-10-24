$(document).ready(function() {
    $('#modal-opsi-trans').modal({
        backdrop: 'static',
        keyboard: false
    });

    // if tidak ada trans, close modal
    $('#modal-opsi-trans').modal('show');

    $('#show-option').on('click', function() {
        $('#modal-opsi-trans').modal('show');
    });

    let transState = true; // 1 -> look for trans, 0 -> create trans
    var trans = [], pelanggan = [];
    $('#table-list-trans tbody tr').on('click', function() {
        $(this).parent().css('pointer-events', 'none');
        let id = $(this).children().eq(0).html();

        $.ajax({
            url: "/transaksi/getTrans/" + id,
        }).done(function(data) {
            trans = data[0];
            $('#id-trans').text(trans.id);
            $('#id-trans').show();

            $('#input-parfum').val(trans.parfum_id);
            $('#formCheck-express').prop('checked', trans.express);
            $('#formCheck-setrika').prop('checked', trans.setrika_only);
            $('#input-catatan-trans').val(trans.catatan);

            // console.log(trans);

            $.ajax({
                url: "/data/pelanggan/" + trans.pelanggan_id,
            }).done(function(data) {
                pelanggan = data[0];

                $('#input-nama').val(pelanggan.nama);
                $('#input-telepon').val(pelanggan.telephone);
                $('#input-alamat').val(pelanggan.alamat);
                $('#input-email').val(pelanggan.email);
                $('#input-tanggal-lahir').val(pelanggan.tanggal_lahir);
                // $('#input-catatan-pelanggan').val(trans.catatan_pelanggan);
                $('#input-catatan-pelanggan').addClass('disabled');

                $('#search-pelanggan').hide();
                $('#data-pelanggan').show();

                $('#select-outlet').addClass('disabled');
                $('#select-outlet').val(trans.outlet_id);

                $.ajax({
                    url: "/transaksi/pickup-delivery/" + trans.pickup_delivery_id,
                }).done(function(data) {
                    let pickup_delivery = data[0];

                    if (pickup_delivery.ambil) {
                        $('#select-driver-pickup').val(pickup_delivery.driver_ambil_id);
                        $('#select-driver-pickup').addClass('disabled');
                        $('#input-alamat-ambil').val(pickup_delivery.alamat_ambil);
                        $('#input-alamat-ambil').addClass('disabled');
                        $('#formCheck-pickup').trigger('click');
                    }

                    if (pickup_delivery.antar) {
                        $('#select-driver-delivery').val(pickup_delivery.driver_antar_id);
                        $('#select-driver-delivery').addClass('disabled');
                        $('#input-alamat-antar').val(pickup_delivery.alamat_antar);
                        $('#input-alamat-antar').addClass('disabled');
                        $('#formCheck-delivery').trigger('click');
                    }

                    if (pickup_delivery.ambil_di_outlet) {
                        $('#select-outlet-ambil').val(pickup_delivery.outlet_ambil_id);
                        $('#select-outlet-ambil').addClass('disabled');
                        $('#formCheck-ambil-outlet').trigger('click');
                    }

                    // console.log(pickup_delivery);

                    $('#show-data-pelanggan').trigger('click');
                    $('#show-data-outlet').trigger('click');
                    $('#show-data-pickup-delivery').trigger('click');
                    $('#modal-opsi-trans').modal('hide');
                    $(this).parent().css('pointer-events', 'initial');
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
        trans = [], pelanggan = [];

        // $('#id-trans').val(id); perlu ajax ambil id baru

        let rowAdd = $('#table-trans-item tbody').children().last().detach();
        $('#table-trans-item tbody').empty();
        $('#table-trans-item tbody').append(rowAdd);

        $('#input-pafrum').val('');
        $('#formCheck-express').prop('checked', trans.express);
        $('#formCheck-setrika').prop('checked', trans.setrika_only);
        $('#input-catatan-trans').val(trans.catatan);

        // reset pelanggan
        $('#input-nama').val('');
        $('#input-telepon').val('');
        $('#input-alamat').val('');
        $('#input-email').val('');
        $('#input-tanggal-lahir').val('');
        $('#input-catatan-pelanggan').remove('disabled');

        $('#search-pelanggan').show();
        $('#data-pelanggan').hide();
        $('#search-pelanggan').text('Cari pelanggan');

        // reset outlet
        $('#select-outlet').removeClass('disabled');
        $('#select-outlet').val('');

        // reset pickup delivery
        $('#formCheck-pickup').prop('checked', false);
        $('#select-driver-pickup').removeClass('disabled');
        $('#select-driver-pickup').val('');
        $('#input-alamat-ambil').removeClass('disabled');
        $('#input-alamat-ambil').val('');

        $('#formCheck-delivery').prop('checked', false);
        $('#select-driver-delivery').removeClass('disabled');
        $('#select-driver-delivery').val('');
        $('#input-alamat-antar').removeClass('disabled');
        $('#input-alamat-antar').val('');

        $('#formCheck-ambil-outlet').prop('checked', false);
        $('#select-outlet-ambil').removeClass('disabled');
        $('#select-outlet-ambil').val('');

        $('#container-pickup').hide();
        $('#container-delivery').hide();
        $('#container-ambil-outlet').hide();

        $('#search-pelanggan').show();

        $.ajax({
            url: "/transaksi/newID",
        }).done(function(data) {
            let id = data[0];

            $('#id-trans').text(id);
            $('#id-trans').show();
            $('#modal-opsi-trans').modal('hide');
            $('#section-transaksi-cuci').children('.row').show();
        });
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

    $('#formCheck-pickup').on('change', function() {
        $(this).parent().next().toggle();
    });

    $('#formCheck-delivery').on('change', function() {
        $('#container-delivery').show();
        $('#container-ambil-outlet').hide();
    });

    $('#formCheck-ambil-outlet').on('change', function() {
        $('#container-ambil-outlet').show();
        $('#container-delivery').hide();
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
    $('#add-item').on('click', function() {
        $('#table-items tbody').empty();

        $.ajax({
            url: "/data/jenis-item/find",
        }).done(function(data) {
            let items = data[0];
            items.forEach(item => {
                $('#table-items tbody').append("<tr id='item-" + item.id + "'><td><input class='checked-items' type='checkbox' /></td><td>" + item.nama + "</td><td>" + item.nama_kategori + "</td><td>" + item.harga_bucket + "</td></tr>");
            });
            $('#modal-add-item').modal('show');
        });
    });

    $('#search-id-item').on('click', function() {
        $.ajax({
            url: "/data/transaksi/newID",
        }).done(function(data) {
            let id = data[0];

        });
    });

    $('#add-item-to-table').on('click', function() {
        $('.checked-items:checked').each(function() {
            let id = $(this).parent().parent().attr('id');
            id = id.substr(5);

            $.ajax({
                url: "/data/jenis-item/" + id,
            }).done(function(data) {
                let item = data[0];

                $('#table-trans-item tbody').prepend("<tr><td>" + item.nama + "</td><td>" + item.nama_kategori + "</td><td></td><td></td><td></td><td class='text-center' style='padding-top: 4px;padding-bottom: 4px;'><button id='btn-catatan-item-" + item.id + "' class='btn btn-primary btn-sm show-catatan-item' type='button'>Catatan</button></td><td class='text-center'>" + item.bobot_bucket + "</td></tr>");
            });
        }).promise().done( function() {
            $('#modal-add-item').modal('hide');
        });
    });

    $('#show-catatan-trans').on('click', function() {
        $(this).next().toggle();
    });

    $('#save-catatan-trans').on('click', function() {
        // ajax save catatan
        $(this).closest('div').hide();
    });

    $('#table-trans-item tbody').on('click', '.show-catatan-item', function() {
        $('#modal-catatan-item').modal('show');
    });

    $('.stain-selection').on('click', function() {
        $(this).toggleClass('selected');
    });
});
