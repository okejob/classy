$(document).ready(function() {

    var selectedPaketId = 0;
    $('#paket-container .card').on('click', function() {
        $('#paket-container .card').removeClass('selected');

        selectedPaketId = $(this).attr('id');
        $(this).addClass('selected');

        if (selectedPaketId != 'manual') {
            $('#input-dibayarkan').val(removeDot($('#paket-container .card.selected .harga-paket .thousand-separator').text()).toLocaleString(['ban', 'id']));
        } else {
            $('#input-dibayarkan').val(parseInt($('#paket-container .card.selected #input-manual').val()).toLocaleString(['ban', 'id']));
        }
    });

    $('#input-manual').on('input', function() {
        if ($(this).val() != "") {
            $('#input-dibayarkan').val(parseInt($(this).val()).toLocaleString(['ban', 'id']));
        }
    })

    var pelangganId = 0;
    $('#nama-pelanggan').on('change', function() {
        if ($(this).val() != '') {
            pelangganId = $('#data-pelanggan option[value=' + $(this).val() +']').data('id');

            $.ajax({
                url: "/pelanggan/" + pelangganId + "/check-saldo",
            }).done(function(data) {
                console.log(data);
                let saldo = data.saldo;
                $('#input-saldo-akhir').val(parseInt(saldo).toLocaleString(['ban', 'id']));
                $('#input-saldo-akhir').addClass('disabled');

            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            });
        }
    });

    $('#submit-saldo').on('click', function() {
        $(this).addClass('disabled');

        if (selectedPaketId == 'manual') {
            selectedPaketId = null;
        }
        let nominal = removeDot($('#paket-container .card.selected .nominal-paket .thousand-separator').text());
        let saldoAkhir = nominal + removeDot($('#input-saldo-akhir').val());

        let formData = new FormData();
        formData.append('pelanggan_id', pelangganId);
        formData.append('paket_deposit_id', selectedPaketId);
        formData.append('nominal', nominal);
        formData.append('jenis_input', 'deposit');
        formData.append('saldo_akhir', saldoAkhir);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "/pelanggan/" + pelangganId + "/add-saldo",
            method: "POST",
            contentType: false,
            processData: false,
            data: formData,
        }).done(function() {
            window.location = window.location;
        }).fail(function(message) {
            alert('error');
            console.log(message);
        });
    });

    function removeDot(val) {
        if (val != '') {
            while(val.indexOf('.') != -1) {
                val = val.replace('.', '');
            }
            let number = parseInt(val);
            return number;
        }
    }

    function adjustWindow() {
        if ($(window).width() < 992) {
            $('#info-pelanggan').removeClass('border-start');
        } else {
            $('#info-pelanggan').addClass('border-start');
        }
    }

    $(window).on('resize', function() {
        adjustWindow();
    });
});
