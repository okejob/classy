$(document).ready(function() {
    $('#modal-opsi-trans, #modal-new-trans').modal({
        backdrop: 'static',
        keyboard: false
    });

    $('#modal-opsi-trans').modal('show');

    $('#show-option').on('click', function() {
        $('#modal-opsi-trans').modal('show');
    });

    $('#table-list-trans tbody').on('click', 'tr', function() {
        let parent = $(this).parent();
        parent.addClass('disabled');
        let id = $(this).children().eq(0).html();

        $.ajax({
            url: "/transaksi/detail/" + id,
        }).done(function(data) {
            // console.log(data[0]);

            let trans = data;
            $('#id-trans').text(trans.id);
            $('#kode-trans').text(trans.kode);

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
            }

            $('#search-pelanggan').hide();
            $('#data-pelanggan').show();

            $('#select-outlet').val(trans.outlet_id);

            let pickup = trans.pickup_delivery[0];
            let delivery = trans.pickup_delivery[1];
            let penerima = trans.penerima;
            console.log(pickup);

            if (typeof pickup !== "undefined") {
                $('#formCheck-pickup').parent().next().show();
                $('#formCheck-pickup').prop('checked', true);
                $('#select-kode-pickup').val(pickup.driver_id);
                if (pickup.is_done) {
                    $('#check-pickup').addClass('disabled');
                    $('#container-pickup').addClass('disabled');
                } else {
                    $('#check-pickup').removeClass('disabled');
                    $('#container-pickup').removeClass('disabled');
                }
            } else {
                $('#formCheck-pickup').parent().next().hide();
                $('#formCheck-pickup').prop('checked', false);
                $('#select-kode-pickup').val('');
            }

            if (typeof delivery !== "undefined") {
                $('#formCheck-delivery').parent().next().show();
                $('#formCheck-delivery').prop('checked', true);
                $('#select-kode-delivery').val(delivery.driver_id);
                if (delivery.is_done) {
                    $('#check-delivery').addClass('disabled');
                    $('#container-delivery').addClass('disabled');
                } else {
                    $('#check-delivery').removeClass('disabled');
                    $('#container-delivery').removeClass('disabled');
                }
            }else {
                $('#formCheck-delivery').parent().next().hide();
                $('#formCheck-delivery').prop('checked', false);
                $('#select-kode-delivery').val('');
            }

            if (penerima) {
                $('#select-outlet-ambil').parent().addClass('disabled');
                $('#select-outlet-ambil').val(penerima.outlet_id);
                $('#input-nama-penerima').val(penerima.penerima);
                $('#input-date-penerimaan').val(penerima.tanggal_penerimaan);
                $('#input-foto-penerima').hide().prev().hide();

                $('#simpan-info-penerimaan').hide();
            } else {
                $('#select-outlet-ambil').parent().removeClass('disabled');
                $('#select-outlet-ambil').val('');
                $('#input-nama-penerima').val('');
                $('#input-date-penerimaan').val('');
                $('#input-foto-penerima').show().prev().show();

                $('#simpan-info-penerimaan').show();
            }

            if (!$('#show-data-pelanggan').hasClass('show')) {
                $('#show-data-pelanggan').trigger('click');
            }
            if (!$('#show-data-pickup-delivery').hasClass('show')) {
                $('#show-data-pickup-delivery').trigger('click');
            }
            if (!$('#show-data-outlet').hasClass('show')) {
                $('#show-data-outlet').trigger('click');
            }
            if (!$('#show-data-penerimaan').hasClass('show')) {
                $('#show-data-penerimaan').trigger('click');
            }

            let rowAdd = $('#table-trans-item tbody').children().last().detach();
            $('#table-trans-item tbody').empty();
            for (let i = 0; i < trans.item_transaksi.length; i++) {
                const item = trans.item_transaksi[i];
                $('#table-trans-item tbody').append(
                    "<tr id='" + item.id + "'>" +
                        "<td style='white-space: nowrap; width: 25%;'>" + item.nama + "</td>" +
                        "<td class='d-none d-lg-table-cell' style='width: 15%;'>" + item.nama_kategori + "</td>" +
                        "<td class='d-none d-xl-table-cell' style='width: 10%;'></td>" +
                        "<td class='d-none d-xl-table-cell' style='width: 10%;'></td>" +
                        "<td class='d-none d-md-table-cell' style='width: 10%;'></td>" +
                        "<td class='text-center' style='width: 10%;'>" + item.bobot_bucket + "</td>" +
                        "<td class='d-none d-sm-table-cell' style='width: 5%;'>Rp</td>" +
                        "<td class='text-end thousand-separator'>" + item.harga_premium + "</td>" +
                        "<td style='width: 46.25px;'>" +
                            "<button id='btn-" + item.id + "' class='btn btn-primary btn-sm btn-show-action' type='button'><i class='fas fa-bars' aria-hidden='true'></i></button>" +
                        "</td>" +
                    "</tr>"
                );
            }
            $('#table-trans-item tbody').append(rowAdd);

            $('#sub-total').html(trans.subtotal);
            $('#diskon').html(trans.diskon);
            $('#diskon-member').html(trans.diskon_member);
            $('#grand-total').html(trans.grand_total);
            setThousandSeparator();
            $('#form-transaksi').attr('action', '/transaksi/update/' + trans.id);

            parent.removeClass('disabled');
            adjustWidth();
            $('#modal-opsi-trans').modal('hide');
            if (getCookie('transaksi-intro_trans') == '') {
                introDetailTransaksi();
            }
        });
    });

    $('#search-key-trans').on('click', function() {
        let key = $('#input-key-trans').val()
        $.ajax({
            url: "/transaksi/search/" + key,
        }).done(function(data) {
            console.log(data);
            let transaksi = data[0];

            $('#table-list-trans tbody').empty();
            for (let i = 0; i < transaksi.length; i++) {
                const trans = transaksi[i];
                console.log(trans);
                $('#table-list-trans tbody').prepend(
                    "<tr>" +
                        "<td>" + trans.id + "</td>" +
                        "<td>" + trans.outlet.nama + "</td>" +
                        "<td class='text-center'>" + trans.created_at + "</td>" +
                        "<td>" + trans.pelanggan.nama + "</td>" +
                        "<td>Rp</td>" +
                        "<td class='text-end thousand-separator'>" + trans.grand_total + "</td>" +
                        "<td class='text-center'>" + ((trans.lunas) ? 'Lunas' : 'Belum Lunas') + "</td>" +
                    "</tr>"
                );
            }
            setThousandSeparator();
        });
    });

    $('#add-new-trans').on('click', function() {
        $('#modal-opsi-trans').modal('hide');
        $('#modal-new-trans').modal('show');
    });

    $('#new-trans-back').on('click', function() {
        $('#modal-opsi-trans').modal('show');
    });

    $('#search-pelanggan-2').on('click', function() {
        $(this).next().toggle();
    });

    $('#table-list-pelanggan-2 tbody tr').on('click', function() {
        let parent = $(this).parent();
        parent.addClass('disabled');
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
        parent.removeClass('disabled');
    });

    $('#create-trans').on('click', function() {
        let pelanggan_id = $('#input-id-2').val();
        $.ajax({
            url: "/transaksi/create?pelanggan_id=" + pelanggan_id,
        }).done(function(data) {
            window.location = window.location;
        });
    });

    function setThousandSeparator() {
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
        }
    };

    $('#formCheck-pickup, #formCheck-delivery').on('change', function() {
        if ($(this).is(':checked')) {
            $(this).parent().next().show();
        } else {
            $(this).parent().next().hide();
        }
    });

    $('#form-penerimaan').on('submit', function(e) {
        e.preventDefault();
        $(this).addClass('disabled');
        let id_trans = $('#id-trans').text();
        let id_outlet = $('#select-outlet-ambil').val();
        let ambil_di_outlet = 0;
        if (id_outlet) {
            ambil_di_outlet = 1;
        }

        let formData = new FormData();
        formData.append('transaksi_id', id_trans);
        formData.append('ambil_di_outlet', ambil_di_outlet);
        formData.append('outlet_id', id_outlet);
        formData.append('tanggal_penerimaan', $('#input-date-penerimaan').val());
        formData.append('penerima', $('#input-nama-penerima').val());
        formData.append('image', $('#input-foto-penerima').prop("files")[0]);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "/transaksi/penerima",
            method: "POST",
            contentType: false,
            processData: false,
            data: formData,
        }).done(function() {
            $('#simpan-info-penerimaan').removeClass('disabled');
            $('#simpan-info-penerimaan').hide();
        }).fail(function(message) {
            alert('error');
            console.log(message);
        });
    });

    $('.show-data').on('click', function() {
        let dataType = $(this).attr('id').substring($(this).attr('id').indexOf('data-') + 5);
        if (!$(this).hasClass('show')) {
            $(this).addClass('show');
            $(this).children().addClass('fa-rotate-180');
            $(this).closest('.card').addClass('h-100');

            $('#info-' + dataType).show();
        } else {
            $(this).removeClass('show');
            $(this).children().removeClass('fa-rotate-180');
            $(this).closest('.card').removeClass('h-100');

            $('#info-' + dataType).hide();
        }
    });

    $('#search-pelanggan').on('click', function() {
        $('#modal-list-pelanggan').modal('show');
    });

    // select pelanggan
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

    $('#to-pickup-delivery').on('click', function() {
        window.location = "/transaksi/pickup-delivery/";
    });

    // bottom
    function adjustWidth() {
        if ($(window).width() < 576) {
            $('#table-trans-item thead th:nth-child(1)').css('width', '40%');
            $('#table-trans-item thead th:nth-child(6)').css('width', '15%');

            $('#table-trans-item tbody tr td:nth-child(1)').css('width', '40%');
            $('#table-trans-item tbody tr td:nth-child(1)').css('white-space', 'initial');
            $('#table-trans-item tbody tr td:nth-child(6)').css('width', '15%');

            $('#table-trans-item tfoot tr td:nth-child(1)').css('width', '55%');
            $('#table-trans-item tfoot tr td:nth-child(2)').css('width', '10%');
        } else if ($(window).width() < 992) {
            $('#table-trans-item thead th:nth-child(1)').css('width', '40%');
            $('#table-trans-item thead th:nth-child(5)').css('width', '15%');
            $('#table-trans-item thead th:nth-child(6)').css('width', '10%');

            $('#table-trans-item tbody tr td:nth-child(1)').css('width', '40%');
            $('#table-trans-item tbody tr td:nth-child(1)').css('white-space', 'nowrap');
            $('#table-trans-item tbody tr td:nth-child(5)').css('width', '15%');
            $('#table-trans-item tbody tr td:nth-child(6)').css('width', '10%');
            $('#table-trans-item tbody tr td:nth-child(7)').css('width', '7.5%');

            $('#table-trans-item tfoot tr td:nth-child(1)').css('width', '65%');
            $('#table-trans-item tfoot tr td:nth-child(2)').css('width', '7.5%');
        } else if ($(window).width() < 1200) {
            $('#table-trans-item thead th:nth-child(1)').css('width', '30%');
            $('#table-trans-item thead th:nth-child(2)').css('width', '20%');
            $('#table-trans-item thead th:nth-child(5)').css('width', '10%');
            $('#table-trans-item thead th:nth-child(6)').css('width', '10%');

            $('#table-trans-item tbody tr td:nth-child(1)').css('width', '30%');
            $('#table-trans-item tbody tr td:nth-child(1)').css('white-space', 'nowrap');
            $('#table-trans-item tbody tr td:nth-child(2)').css('width', '20%');
            $('#table-trans-item tbody tr td:nth-child(5)').css('width', '10%');
            $('#table-trans-item tbody tr td:nth-child(6)').css('width', '10%');
            $('#table-trans-item tbody tr td:nth-child(7)').css('width', '5%');

            $('#table-trans-item tfoot tr td:nth-child(1)').css('width', '70%');
            $('#table-trans-item tfoot tr td:nth-child(2)').css('width', '5%');
        } else {
            $('#table-trans-item thead th:nth-child(1)').css('width', '25%');
            $('#table-trans-item thead th:nth-child(2)').css('width', '15%');
            $('#table-trans-item thead th:nth-child(5)').css('width', '10%');
            $('#table-trans-item thead th:nth-child(6)').css('width', '10%');

            $('#table-trans-item tbody tr td:nth-child(1)').css('width', '25%');
            $('#table-trans-item tbody tr td:nth-child(1)').css('white-space', 'nowrap');
            $('#table-trans-item tbody tr td:nth-child(2)').css('width', '15%');
            $('#table-trans-item tbody tr td:nth-child(5)').css('width', '10%');
            $('#table-trans-item tbody tr td:nth-child(6)').css('width', '10%');
            $('#table-trans-item tbody tr td:nth-child(7)').css('width', '5%');

            $('#table-trans-item tfoot tr td:nth-child(1)').css('width', '80%');
            $('#table-trans-item tfoot tr td:nth-child(2)').css('width', '5%');
        }
    }

    $(window).on('resize', function() {
        adjustWidth();
    });

    $('#add-item').on('click', function() {
        $('#table-items tbody').empty();

        $.ajax({
            url: "/data/jenis-item/find?",
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
            url: "/data/jenis-item/find?key=" + key,
        }).done(function(data) {
            let items = data[0];

            items.forEach(item => {
                $('#table-items tbody').append("<tr id='item-" + item.id + "'><td>" + item.nama + "</td><td>" + item.nama_kategori + "</td><td>" + parseFloat(item.bobot_bucket) + "</td></tr>");
            });
        });
    });

    // tambah item
    $('#table-items tbody').on('click', 'tr', function() {
        let parent = $(this).parent();
        parent.addClass('disabled');
        let id = $(this).attr('id');
        id = id.substr(5);

        $.ajax({
            url: "/data/jenis-item/" + id,
        }).done(function(data) {
            let item = data[0];

            let rowAdd = $('#table-trans-item tbody').children().last().detach();
            let total_bobot = 0;
            $('#table-trans-item tbody tr').each(function() {
                total_bobot += parseFloat($(this).children().eq(6).html());
            });

            $.ajax({
                url: "/transaksi/addItem?jenis_item_id=" + item.id + "&transaksi_id=" + $('#id-trans').text(),
            }).done(function(data) {
                let trans = data[0];
                $('#sub-total').html(trans.subtotal);
                $('#diskon').html(trans.diskon);
                $('#diskon-member').html(trans.diskon_member);
                $('#grand-total').html(trans.grand_total);

                const temp = trans.item_transaksi[trans.item_transaksi.length - 1];
                $('#table-trans-item tbody').append(
                    "<tr id='" + temp.id + "'>" +
                        "<td style='white-space: nowrap; width: 25%;'>" + temp.nama + "</td>" +
                        "<td class='d-none d-lg-table-cell' style='width: 15%;'>" + temp.nama_kategori + "</td>" +
                        "<td class='d-none d-xl-table-cell' style='width: 10%;'></td>" +
                        "<td class='d-none d-xl-table-cell' style='width: 10%;'></td>" +
                        "<td class='d-none d-md-table-cell' style='width: 10%;'></td>" +
                        "<td class='text-center' style='width: 10%;'>" + temp.bobot_bucket + "</td>" +
                        "<td class='d-none d-sm-table-cell' style='width: 5%;'>Rp</td>" +
                        "<td class='text-end thousand-separator'>" + temp.harga_premium + "</td>" +
                        "<td style='width: 46.25px;'>" +
                            "<button id='btn-" + temp.id + "' class='btn btn-primary btn-sm btn-show-action' type='button'><i class='fas fa-bars' aria-hidden='true'></i></button>" +
                        "</td>" +
                    "</tr>"
                );
                $('#table-trans-item tbody').append(rowAdd);

                setThousandSeparator();
                parent.removeClass('disabled');
                $('#modal-add-item').modal('hide');
            });
        });
    });

    $('#show-catatan-trans').on('click', function() {
        let containerCatatan = $(this).next();
        console.log(containerCatatan.css('height'));
        containerCatatan.css('top', 'calc(-' + containerCatatan.css('height') + ' - .75rem');
        containerCatatan.toggle();
    });

    $('#save-catatan-trans').on('click', function() {
        $(this).closest('div').hide();
    });

    var btnIndex = -1, currentlySelectedItemTransactionID = 0, currentlySelectedItemName = '';
    $('#table-trans-item tbody').on('click', '.btn-show-action', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        currentlySelectedItemTransactionID = $('#table-trans-item tbody tr:nth-child(' + btnIndex + ')').attr('id');
        currentlySelectedItemName = $('#table-trans-item tbody tr:nth-child(' + btnIndex + ')').children().eq(0).html();
    });

    $('#action-notes').on('click', function() {
        $.ajax({
            url: "/transaksi/item/note/list/" + currentlySelectedItemTransactionID,
        }).done(function(data) {
            let notes = data[0];
            $('#table-list-catatan tbody').empty();

            notes.forEach(note => {
                $('#table-list-catatan tbody').append(
                    "<tr id='" + note.id + "'>" +
                        "<td>" + note.nama_user + "</td>" +
                        "<td>" + note.catatan + "</td>" +
                        "<td class='text-end' style='padding: 4px 8px;'>" +
                            "<button class='btn btn-primary btn-sm' type='button'>Show</button>" +
                        "</td>" +
                    "</tr>"
                );
            });

            $('#modal-list-catatan-item').modal('show');
        });
    });

    $('#action-delete').on('click', function() {
        if (confirm('Yakin menghapus data  ?')) {
            $.ajax({
                url: "/transaksi/item-transaksi/delete/" + currentlySelectedItemTransactionID,
            }).done(function(data) {
                let trans = data[0];
                $('#sub-total').html(trans.subtotal);
                $('#diskon').html(trans.diskon);
                $('#diskon-member').html(trans.diskon_member);
                $('#grand-total').html(trans.grand_total);

                $('#table-trans-item tbody tr:nth-child(' + btnIndex + ')').detach();
                currentlySelectedItemTransactionID = 0;
                currentlySelectedItemName = '';
                setThousandSeparator();

            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            });
        }
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

    // show catatan item
    $('#table-list-catatan tbody').on('click', '.btn', function() {
        $('#catatan-item-name').text(currentlySelectedItemName);
        $.ajax({
            url: "/transaksi/item/note/" + $(this).closest('tr').attr('id'),
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

    // add catatan item
    $('#add-catatan-item').on('click', function() {
        $('#catatan-item-name').text(currentlySelectedItemName);

        $('#penulis-catatan-item').parent().hide();
        $('#penulis-catatan-item').removeClass('disabled');
        $('#catatan-item').removeClass('disabled');
        $('#input-foto-item').show();
        $('#tab-noda').removeClass('disabled');

        // clear catatan
        $('#penulis-catatan-item').val('');
        $('#catatan-item').val('');
        $('#container-image-item').prop('src', '');
        $('#input-foto-item').val('');

        $('#td-kiri-atas').addClass('selected').removeClass('selected');
        $('#td-kanan-atas').addClass('selected').removeClass('selected');
        $('#td-kiri-bawah').addClass('selected').removeClass('selected');
        $('#td-kanan-bawah').addClass('selected').removeClass('selected');
        $('#tb-kiri-atas').addClass('selected').removeClass('selected');
        $('#tb-kanan-atas').addClass('selected').removeClass('selected');
        $('#tb-kiri-bawah').addClass('selected').removeClass('selected');
        $('#tb-kanan-bawah').addClass('selected').removeClass('selected');

        $('#modal-catatan-item .modal-footer').show();
        $('#modal-catatan-item').modal('show');
    });

    // save catatan item
    $('#simpan-catatan-item').on('click', function() {
        if ($('#form-catatan')[0].checkValidity()) {
            $(this).addClass('disabled');

            let formData = new FormData();
            formData.append('item_transaksi_id', currentlySelectedItemTransactionID);
            formData.append('modified_by', $('#penulis-catatan-item').val());
            formData.append('catatan', $('#catatan-item').val());
            formData.append('image', $('#input-foto-item').prop("files")[0]);

            formData.append('front_top_left', $('#td-kiri-atas').hasClass('selected') ? 1 : 0);
            formData.append('front_top_right', $('#td-kanan-atas').hasClass('selected') ? 1 : 0);
            formData.append('front_bottom_left', $('#td-kiri-bawah').hasClass('selected') ? 1 : 0);
            formData.append('front_bottom_right', $('#td-kanan-bawah').hasClass('selected') ? 1 : 0);
            formData.append('back_top_left', $('#tb-kiri-atas').hasClass('selected') ? 1 : 0);
            formData.append('back_top_right', $('#tb-kanan-atas').hasClass('selected') ? 1 : 0);
            formData.append('back_bottom_left', $('#tb-kiri-bawah').hasClass('selected') ? 1 : 0);
            formData.append('back_bottom_right', $('#tb-kanan-bawah').hasClass('selected') ? 1 : 0);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                url: "/transaksi/item/note/add",
                method: "POST",
                contentType: false,
                processData: false,
                data: formData,
            }).done(function() {
                $('#simpan-catatan-item').removeClass('disabled');
                $('#modal-catatan-item').modal('hide');
                $('#modal-list-catatan-item').modal('hide');
            }).fail(function(message) {
                console.log(message);
            });
        } else {
            $('#form-catatan')[0].reportValidity()
        }
    });

    // intro.js
    // intro init halaman
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    if (getCookie('transaksi-intro_halaman') == '') {
        introHalaman();
    }

    function introHalaman() {
        introJs().setOptions({
            showBullets: false,
            showProgress: true,
            disableInteraction: true,
            steps: [
                {
                    title: "Tutorial",
                    intro: "Berikut adalah tutorial cara menggunakan halaman ini"
                }, {
                    title: "Tutorial Transaksi",
                    element: document.querySelector('#modal-opsi-trans .modal-content'),
                    intro: "Bagian ini digunakan untuk memilih transaksi",
                }, {
                    title: "Tutorial Transaksi",
                    element: document.querySelector('#modal-opsi-trans tbody'),
                    intro: "Ini adalah 5 transaksi terakhir",
                }, {
                    title: "Tutorial Transaksi",
                    element: document.querySelector('#modal-opsi-trans .intro-1'),
                    intro: "Ini adalah search bar untuk mencari transaksi yang mau dipilih",
                }, {
                    title: "Tutorial Transaksi",
                    element: document.querySelector('#modal-opsi-trans #add-new-trans'),
                    intro: "Klik tombol ini untuk membuat transaksi baru",
                },
            ]
        }).start();
        setCookie('transaksi-intro_halaman', 'done', 1);
    }

    function introDetailTransaksi() {
        introJs().setOptions({
            showBullets: false,
            showProgress: true,
            disableInteraction: true,
            steps: [
                {
                    title: "Informasi Transaksi",
                    element: document.querySelector('#section-info'),
                    intro: "Bagian ini berisikan informasi mengenai transaksi",
                }, {
                    title: "Informasi Transaksi",
                    element: document.querySelector('#section-info .row .col:nth-child(1) .card'),
                    intro: "Ini adalah informasi data pelanggan",
                }, {
                    title: "Informasi Transaksi",
                    element: document.querySelector('#section-info .row .col:nth-child(2) .card'),
                    intro: "Ini adalah informasi data penjemputan & pengantaran barang pelanggan",
                }, {
                    title: "Informasi Transaksi",
                    element: document.querySelector('#section-info .row .col:nth-child(3) .card'),
                    intro: "Ini adalah informasi data outlet",
                }, {
                    title: "Informasi Transaksi",
                    element: document.querySelector('#section-info .row .col:nth-child(4) .card'),
                    intro: "Ini adalah informasi data penerimaan",
                }, {
                    title: "Detail Transaksi",
                    element: document.querySelector('#section-detail-transaksi'),
                    intro: "Bagian ini berisikan data item",
                }, {
                    title: "Detail Transaksi",
                    element: document.querySelector('#section-detail-transaksi tbody tr:last-child'),
                    intro: "Klik tombol untuk menambahkan item pada transaksi",
                }, {
                    title: "Detail Transaksi",
                    element: document.querySelector('#section-detail-transaksi #form-transaksi .form-check:nth-child(1)'),
                    intro: "Centang bagian ini, bila transaksi bersifat express (1 hari selesai)",
                }, {
                    title: "Detail Transaksi",
                    element: document.querySelector('#section-detail-transaksi #form-transaksi .form-check:nth-child(2)'),
                    intro: "Centang bagian ini, bila transaksi hanya perlu di setrika (tidak perlu di cuci)",
                }, {
                    title: "Detail Transaksi",
                    element: document.querySelector('#section-detail-transaksi #save-trans'),
                    intro: "Jangan lupa untuk menyimpan transaksi bila mengganti parfum, keterangan transaksi atau catatan transaksi",
                    position: 'left',
                },
            ]
        }).start();
        setCookie('transaksi-intro_trans', 'done', 1);
    }
});
