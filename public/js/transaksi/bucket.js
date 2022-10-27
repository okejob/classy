$(document).ready(function() {
    $('#modal-opsi-trans, #modal-new-trans').modal({
        backdrop: 'static',
        keyboard: false
    });

    // if tidak ada trans, close modal
    $('#modal-opsi-trans').modal('show');

    $('#show-option').on('click', function() {
        $('#modal-opsi-trans').modal('show');
    });

    let transState = true; // 1 -> look for trans, 0 -> create trans
    $('#table-list-trans tbody tr').on('click', function() {
        $(this).parent().css('pointer-events', 'none');
        let id = $(this).children().eq(0).html();

        $.ajax({
            url: "/transaksi/getTrans/" + id,
        }).done(function(data) {

            let trans = data[0];
            $('#id-trans').text(trans.id);
            $('#id-trans').show();

            $('#input-parfum').val(trans.parfum_id);
            $('#formCheck-express').prop('checked', trans.express);
            if (trans.express) {
                $('#formCheck-express').val(1);
            }
            $('#formCheck-setrika').prop('checked', trans.setrika_only);
            if (trans.setrika_only) {
                $('#formCheck-setrika').val(1);
            }
            $('#input-catatan-trans').val(trans.catatan);

            let pelanggan = trans.pelanggan;

            $('#input-nama').val(pelanggan.nama);
            $('#input-telepon').val(pelanggan.telephone);
            $('#input-alamat').val(pelanggan.alamat);
            $('#input-email').val(pelanggan.email);
            $('#input-tanggal-lahir').val(pelanggan.tanggal_lahir);
            if (pelanggan.catatan_pelanggan != null) {
                $('#input-catatan-pelanggan').val(pelanggan.catatan_pelanggan.catatan_cuci);
                $('#input-catatan-pelanggan').addClass('disabled');
            }

            $('#search-pelanggan').hide();
            $('#data-pelanggan').show();

            $('#select-outlet').addClass('disabled');
            $('#select-outlet').val(trans.outlet_id);

            let pickup = trans.pickup_delivery[0];
            let delivery = trans.pickup_delivery[1];
            let penerima = trans.penerima;

            $('#check-pickup').show();
            if (pickup != null) {
                $('#select-driver-pickup').val(pickup.driver_id);
                $('#select-driver-pickup').addClass('disabled');
                $('#input-alamat-ambil').val(pickup.alamat);
                $('#input-alamat-ambil').addClass('disabled');
                $('#formCheck-pickup').trigger('click');
            }

            if (delivery != null) {
                $('#select-driver-delivery').val(delivery.driver_id);
                $('#select-driver-delivery').addClass('disabled');
                $('#input-alamat-antar').val(delivery.alamat);
                $('#input-alamat-antar').addClass('disabled');
                $('#formCheck-delivery').trigger('click');
            }

            if (penerima != null) {
                $('#select-outlet-ambil').val(penerima.outlet_ambil_id);
                $('#select-outlet-ambil').addClass('disabled');
                // $('#formCheck-ambil-outlet').trigger('click');
            }

            $('#show-data-pelanggan').trigger('click');
            $('#show-data-outlet').trigger('click');
            $('#show-data-pickup-delivery').trigger('click');
            $('#to-pickup-delivery').parent().show();
            $('#section-info').show();

            let rowAdd = $('#table-trans-item tbody').children().last().detach();
            $('#table-trans-item tbody').empty();
            for (let i = 0; i < trans.item_transaksi.length; i++) {
                const item = trans.item_transaksi[i];
                $('#table-trans-item tbody').append("<tr><td>" + item.nama + "</td><td>" + item.nama_kategori + "</td><td></td><td></td><td></td><td class='text-center' style='padding-top: 4px;padding-bottom: 4px;'><button id='btn-catatan-item-" + item.id + "' class='btn btn-primary btn-sm show-catatan-item' type='button'>Catatan</button></td><td class='text-center' colspan='2'>" + item.bobot_bucket + "</td></tr>");
            }
            $('#table-trans-item tbody').append(rowAdd);

            $('#sub-total').html(trans.subtotal);
            $('#diskon').html(trans.diskon);
            $('#diskon-member').html(trans.diskon_member);
            $('#grand-total').html(trans.grand_total);
            setThousandSeparator();
            $('#form-transaksi').attr('action', 'update/' + trans.id);

            $('#modal-opsi-trans').modal('hide');
            $('#table-list-trans tbody').css('pointer-events', 'initial');
            $('#section-transaksi-cuci').children('.row').show();
        });
    });

    $('#search-id-trans').on('click', function() {
        alert("ajax get trans list");
    });

    $('#add-new-trans').on('click', function() {
        transState = 0;

        // $('#id-trans').val(id); perlu ajax ambil id baru

        let rowAdd = $('#table-trans-item tbody').children().last().detach();
        $('#table-trans-item tbody').empty();
        $('#table-trans-item tbody').append(rowAdd);

        $('#input-pafrum').val('');
        $('#formCheck-express').prop('checked', false);
        $('#formCheck-express').val(0);
        $('#formCheck-setrika').prop('checked', false);
        $('#formCheck-setrika').val(0);
        $('#input-catatan-trans').val('');

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
        $('#check-pickup').hide();
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

        // $('#formCheck-ambil-outlet').prop('checked', false);
        $('#select-outlet-ambil').removeClass('disabled');
        $('#select-outlet-ambil').val('');

        $('#container-pickup').hide();
        $('#container-delivery').hide();
        $('#container-ambil-outlet').hide();

        $('#search-pelanggan').show();
        $('#to-pickup-delivery').parent().hide();

        if($('#show-data-pelanggan').hasClass('show')) {
            $('#show-data-pelanggan').trigger('click');
        }
        if($('#show-data-pickup-delivery').hasClass('show')) {
            $('#show-data-pickup-delivery').trigger('click');
        }
        if($('#show-data-outlet').hasClass('show')) {
            $('#show-data-outlet').trigger('click');
        }
        if($('#show-data-pengambilan').hasClass('show')) {
            $('#show-data-pengambilan').trigger('click');
        }
        $('#section-info').hide();

        $('#sub-total').html('');
        $('#diskon').html('');
        $('#diskon-member').html('');
        $('#grand-total').html('');
        $('#input-parfum').val('');

        $.ajax({
            url: "/transaksi/newID",
        }).done(function(data) {
            let id = data[0];

            $('#id-trans').text(id);
            $('#id-trans').show();
            $('#modal-opsi-trans').modal('hide');
            $('#section-transaksi-cuci').children('.row').show();

            $('#modal-new-trans').modal('show');
        });
    });

    $('#search-pelanggan-2').on('click', function() {
        $(this).next().show();
    });

    $('#table-list-pelanggan-2 tbody tr').on('click', function() {
        $(this).parent().css('pointer-events', 'none');
        let id = $(this).attr('id').substring($(this).attr('id').indexOf('row-') + 4);

        $.ajax({
            url: "/data/pelanggan/" + id,
        }).done(function(data) {
            let pelanggan = data[0];

            $('#input-id-2').val(pelanggan.id);
            $('#input-nama-2').val(pelanggan.nama);
            $('#input-telepon-2').val(pelanggan.telephone);
            $('#input-alamat-2').val(pelanggan.alamat);
            $('#input-email-2').val(pelanggan.email);
            $('#input-tanggal-lahir-2').val(pelanggan.tanggal_lahir);

        });

        $('#search-pelanggan-2').text('Ganti pelanggan');
        $(this).closest('.card').hide();
        $(this).parent().css('pointer-events', 'initial');
    });

    $('#create-trans').on('click', function() {
        let pelanggan_id = $('#input-id-2').val();
        $.ajax({
            url: "/transaksi/create?pelanggan_id=" + pelanggan_id,
        }).done(function(data) {
            console.log(data);

            let trans = data[0];
            $('#id-trans').text(trans.id);
            $('#id-trans').show();

            $('#input-parfum').val(trans.parfum_id);
            $('#formCheck-express').prop('checked', trans.express);
            if (trans.express) {
                $('#formCheck-express').val(1);
            }
            $('#formCheck-setrika').prop('checked', trans.setrika_only);
            if (trans.setrika_only) {
                $('#formCheck-setrika').val(1);
            }
            $('#input-catatan-trans').val(trans.catatan);

            let pelanggan = trans.pelanggan;

            $('#input-nama').val(pelanggan.nama);
            $('#input-telepon').val(pelanggan.telephone);
            $('#input-alamat').val(pelanggan.alamat);
            $('#input-email').val(pelanggan.email);
            $('#input-tanggal-lahir').val(pelanggan.tanggal_lahir);
            if (pelanggan.catatan_pelanggan != null) {
                $('#input-catatan-pelanggan').val(pelanggan.catatan_pelanggan.catatan_cuci);
                $('#input-catatan-pelanggan').addClass('disabled');
            }

            $('#search-pelanggan').hide();
            $('#data-pelanggan').show();

            $('#select-outlet').addClass('disabled');
            $('#select-outlet').val(trans.outlet_id);

            let pickup = trans.pickup_delivery[0];
            let delivery = trans.pickup_delivery[1];
            let penerima = trans.penerima;

            $('#check-pickup').show();
            if (pickup != null) {
                $('#select-driver-pickup').val(pickup.driver_id);
                $('#select-driver-pickup').addClass('disabled');
                $('#input-alamat-ambil').val(pickup.alamat);
                $('#input-alamat-ambil').addClass('disabled');
                $('#formCheck-pickup').trigger('click');
            }

            if (delivery != null) {
                $('#select-driver-delivery').val(delivery.driver_id);
                $('#select-driver-delivery').addClass('disabled');
                $('#input-alamat-antar').val(delivery.alamat);
                $('#input-alamat-antar').addClass('disabled');
                $('#formCheck-delivery').trigger('click');
            }

            if (penerima != null) {
                $('#select-outlet-ambil').val(penerima.outlet_ambil_id);
                $('#select-outlet-ambil').addClass('disabled');
                // $('#formCheck-ambil-outlet').trigger('click');
            }

            $('#show-data-pelanggan').trigger('click');
            $('#show-data-outlet').trigger('click');
            $('#show-data-pickup-delivery').trigger('click');
            $('#to-pickup-delivery').parent().show();
            $('#section-info').show();

            let rowAdd = $('#table-trans-item tbody').children().last().detach();
            for (let i = 0; i < trans.item_transaksi.length; i++) {
                const item = trans.item_transaksi[i];
                $('#table-trans-item tbody').append("<tr><td>" + item.nama + "</td><td>" + item.nama_kategori + "</td><td></td><td></td><td></td><td class='text-center' style='padding-top: 4px;padding-bottom: 4px;'><button id='btn-catatan-item-" + item.id + "' class='btn btn-primary btn-sm show-catatan-item' type='button'>Catatan</button></td><td class='text-center' colspan='2'>" + item.bobot_bucket + "</td></tr>");
            }
            $('#table-trans-item tbody').append(rowAdd);

            $('#sub-total').html(trans.subtotal);
            $('#diskon').html(trans.diskon);
            $('#diskon-member').html(trans.diskon_member);
            $('#grand-total').html(trans.grand_total);
            setThousandSeparator();
            $('#form-transaksi').attr('action', 'update/' + trans.id);

            $('#modal-new-trans').modal('hide');
        });
    });

    var separatorInterval = setInterval(setThousandSeparator, 10);
    function setThousandSeparator () {
        let length = $('.thousand-separator').length;
        if (length != 0) {
            $('.thousand-separator').each(function(index, element) {
                let val = $(element).text();
                if (val != '') {
                    while(val.indexOf('.') != -1) {
                        val = val.replace('.', '');
                    }
                    let number = parseInt(val);
                    $(element).text(number.toLocaleString(['ban', 'id']));
                }
            });
            clearInterval(separatorInterval);
        }
    };

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
            let pelanggan = data[0];

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

    $('#info-pickup-delivery .form-check input').on('change', function() {
        $(this).parent().next().toggle();
    });

    $('#to-pickup-delivery').on('click', function() {
        let transID = $('#id-trans').text();
        window.location = "/transaksi/pickup-delivery/";
    });

    $('#simpan-info-trans').on('click', function() {
        $.ajax({
            url: "/setting/outlet/" + $(this).val(),
        }).done(function(data) {

        });
    });

    // bottom
    $('#add-item').on('click', function() {
        $('#table-items tbody').empty();

        $.ajax({
            url: "/data/jenis-item/find?key=&tipe_transaksi=bucket",
        }).done(function(data) {
            let items = data[0];

            items.forEach(item => {
                $('#table-items tbody').append("<tr id='item-" + item.id + "'><td>" + item.nama + "</td><td>" + item.nama_kategori + "</td><td>" + parseFloat(item.bobot_bucket) + "</td></tr>");
            });
            $('#modal-add-item').modal('show');
        });
    });

    $('#search-item').on('click', function() {
        $('#table-items tbody').empty();
        let key = $('#input-nama-item').val();

        $.ajax({
            url: "/data/jenis-item/find?key=" + key + "&tipe_transaksi=bucket",
        }).done(function(data) {
            let items = data[0];

            items.forEach(item => {
                $('#table-items tbody').append("<tr id='item-" + item.id + "'><td>" + item.nama + "</td><td>" + item.nama_kategori + "</td><td>" + parseFloat(item.bobot_bucket) + "</td></tr>");
            });
        });
    });

    $('#table-items tbody').on('click', 'tr', function() {
        let id = $(this).attr('id');
        id = id.substr(5);

        $.ajax({
            url: "/data/jenis-item/" + id,
        }).done(function(data) {
            let item = data[0];

            $('#table-trans-item tbody').prepend("<tr><td>" + item.nama + "</td><td>" + item.nama_kategori + "</td><td></td><td></td><td></td><td class='text-center' style='padding-top: 4px;padding-bottom: 4px;'><button id='btn-catatan-item-" + item.id + "' class='btn btn-primary btn-sm show-catatan-item' type='button'>Catatan</button></td><td class='text-center' colspan='2'>" + item.bobot_bucket + "</td></tr>");

            let rowAdd = $('#table-trans-item tbody').children().last().detach();
            let total_bobot = 0;
            $('#table-trans- item tbody tr').each(function() {
                total_bobot += parseFloat($(this).children().eq(6).html());
            });
            $('#table-trans-item tbody').append(rowAdd);

            $.ajax({
                url: "/transaksi/addItem?jenis_item_id=" + item.id + "&transaksi_id=" + $('#id-trans').text(),
            }).done(function(data) {
                let harga = data[0];
                $('#sub-total').html(harga.subtotal);
                $('#diskon').html(harga.diskon);
                $('#diskon-member').html(harga.diskon_member);
                $('#grand-total').html(harga.grand_total);

                setThousandSeparator();
                $('#modal-add-item').modal('hide');
            });
        });
        // .promise().done( function() {
        //     $.ajax({
        //         // url: ,
        //     }).done(function(data) {

        //     });
        // });
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

    $('#formCheck-express, #formCheck-setrika').on('change', function() {
        if($(this).is(':checked')) {
            $(this).val(1);
        } else {
            $(this).val(0);
        }
    });

    // $("#form-transaksi").submit(function(event) {
    //     event.preventDefault();
    // });
});
