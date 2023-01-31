$(document).ready(function() {
    var btnIndex = -1, btnId = 0;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    $('#action-detail').on('click', function() {
        $('#container-bucket').empty();
        $('#container-premium').empty();
        if ($('tr:nth-child(' + btnIndex + ') td:nth-child(1)').html().includes('BU-')) {
            $('#container-bucket').load(window.location.origin + '/component/transBucket/' + btnId, function() {
                setThousandSeparator();
                adjustWidthBucket();
                $('#modal-detail').modal('show');
            });
        } else {
            $('#container-premium').load(window.location.origin + '/component/transPremium/' + btnId, function() {
                setThousandSeparator();
                adjustWidthPremium();
                $('#modal-detail').modal('show');
            });
        }
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

    $('#btn-packing').on('click', function() {
        $('#modal-detail').modal('hide');
        $('#modal-packing').modal('show');
    });

    function adjustWidthBucket() {
        if ($(window).width() < 576) {
            $('#container-bucket thead th:nth-child(1)').css('width', '60%');

            $('#container-bucket tbody tr td:nth-child(1)').css('width', '60%');
            $('#container-bucket tbody tr td:nth-child(1)').css('white-space', 'initial');

            $('#container-bucket tfoot tr td:nth-child(1)').css('width', '55%');
            $('#container-bucket tfoot tr td:nth-child(2)').css('width', '10%');
        } else if ($(window).width() < 992) {
            $('#container-bucket thead th:nth-child(1)').css('width', '35%');
            $('#container-bucket thead th:nth-child(3)').css('width', '20%');
            $('#container-bucket thead th:nth-child(4)').css('width', '10%');
            $('#container-bucket thead th:nth-child(5)').css('width', '15%');

            $('#container-bucket tbody tr td:nth-child(1)').css('width', '35%');
            $('#container-bucket tbody tr td:nth-child(1)').css('white-space', 'nowrap');
            $('#container-bucket tbody tr td:nth-child(3)').css('width', '20%');
            $('#container-bucket tbody tr td:nth-child(4)').css('width', '10%');
            $('#container-bucket tbody tr td:nth-child(5)').css('width', '15%');

            $('#container-bucket tfoot tr td:nth-child(1)').css('width', '70%');
            $('#container-bucket tfoot tr td:nth-child(2)').css('width', '10%');
        } else {
            $('#container-bucket thead th:nth-child(1)').css('width', '35%');
            $('#container-bucket thead th:nth-child(2)').css('width', '20%');
            $('#container-bucket thead th:nth-child(3)').css('width', '10%');
            $('#container-bucket thead th:nth-child(4)').css('width', '10%');
            $('#container-bucket thead th:nth-child(5)').css('width', '10%');

            $('#container-bucket tbody tr td:nth-child(1)').css('width', '35%');
            $('#container-bucket tbody tr td:nth-child(1)').css('white-space', 'nowrap');
            $('#container-bucket tbody tr td:nth-child(2)').css('width', '20%');
            $('#container-bucket tbody tr td:nth-child(3)').css('width', '10%');
            $('#container-bucket tbody tr td:nth-child(4)').css('width', '10%');
            $('#container-bucket tbody tr td:nth-child(5)').css('width', '10%');

            $('#container-bucket tfoot tr td:nth-child(1)').css('width', '80%');
            $('#container-bucket tfoot tr td:nth-child(2)').css('width', '5%');
        }
    }

    function adjustWidthPremium() {
        if ($(window).width() < 576) {
            $('#container-premium thead th:nth-child(1)').css('width', '60%');

            $('#container-premium tbody tr td:nth-child(1)').css('width', '60%');
            $('#container-premium tbody tr td:nth-child(1)').css('white-space', 'initial');

            $('#container-premium tfoot tr td:nth-child(1)').css('width', '55%');
            $('#container-premium tfoot tr td:nth-child(2)').css('width', '10%');
        } else if ($(window).width() < 992) {
            $('#container-premium thead th:nth-child(1)').css('width', '35%');
            $('#container-premium thead th:nth-child(3)').css('width', '15%');
            $('#container-premium thead th:nth-child(4)').css('width', '10%');
            $('#container-premium thead th:nth-child(5)').css('width', '20%');

            $('#container-premium tbody tr td:nth-child(1)').css('width', '35%');
            $('#container-premium tbody tr td:nth-child(1)').css('white-space', 'nowrap');
            $('#container-premium tbody tr td:nth-child(3)').css('width', '15%');
            $('#container-premium tbody tr td:nth-child(4)').css('width', '10%');

            $('#container-premium tfoot tr td:nth-child(1)').css('width', '70%');
            $('#container-premium tfoot tr td:nth-child(2)').css('width', '10%');
        } else {
            $('#container-premium thead th:nth-child(1)').css('width', '30%');
            $('#container-premium thead th:nth-child(2)').css('width', '20%');
            $('#container-premium thead th:nth-child(3)').css('width', '10%');
            $('#container-premium thead th:nth-child(4)').css('width', '5%');
            $('#container-premium thead th:nth-child(5)').css('width', '15%');

            $('#container-premium tbody tr td:nth-child(1)').css('width', '30%');
            $('#container-premium tbody tr td:nth-child(1)').css('white-space', 'nowrap');
            $('#container-premium tbody tr td:nth-child(2)').css('width', '20%');
            $('#container-premium tbody tr td:nth-child(3)').css('width', '10%');
            $('#container-premium tbody tr td:nth-child(4)').css('width', '5%');

            $('#container-premium tfoot tr td:nth-child(1)').css('width', '80%');
            $('#container-premium tfoot tr td:nth-child(2)').css('width', '5%');
        }
    }

    var originalRow = $('.row-clone');
    originalRow.removeClass('row-clone').hide();
    var items = 0;
    $('#add-clone').on('click', function() {
        var clonedRow = originalRow.clone();
        clonedRow.attr('id', 'row-' + ++items);
        clonedRow.addClass('cloned-row');
        $("#table-list-inventory tbody").append(clonedRow.show());
        $("#table-list-inventory tbody").append($('.row-add').detach());
    });

    function hideSelected() {
        $('.cloned-row').each(function() {
            let nama = $(this).find('.nama-inventory').val();
            if ($('option[value="' + nama + '"]') !== undefined) {
                $('option[value="' + nama + '"]').hide();
            }
        });
    }

    function resetSelected() {
        $('.data-inventory option').each(function() {
            $(this).show();
        });
    }

    $('#table-list-inventory').on('click', '.nama-inventory', function() {
        resetSelected();
        hideSelected();
    });

    $('#table-list-inventory').on('change', '.nama-inventory', function() {
        $(this).parent().next().children().attr('max', $('option[value="' + $(this).val() + '"]').data('stok'));
    });

    $('#table-list-inventory').on('click', '.btn-delete-item', function() {
        $(this).closest('tr').detach();
    });

    $('#form-packing').on('submit', function(e) {
        e.preventDefault();
        let inventories = [];
        $('.cloned-row').each(function() {
            let nama = $(this).find('.nama-inventory').val();
            let qty = $(this).find('.qty-inventory').val();
            if ($('option[value="' + nama + '"]') !== undefined && qty != '') {
                inventories.push({
                    "inventory_id": $('option[value="' + nama + '"]').data('id'),
                    "qty": $(this).find('.qty-inventory').val(),
                });
            }
        });

        let formData = new FormData();
        formData.append('transaksi_id', btnId);
        formData.append('alamat', $('#alamat-antar').val());
        formData.append('inventories', JSON.stringify(inventories));

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "/proses/packing",
            method: "POST",
            contentType: false,
            processData: false,
            data: formData,
        }).done(function(data) {
            alert('Barang & request delivery berhasil disimpan');
            window.location = "/proses/packing/";
        }).fail(function(message) {
            alert('error');
            console.log(message);
        });
    });
});
