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
            $('#container-bucket').load(window.location.origin + '/component/shortTrans/' + btnId, function() {
                $('#modal-detail').modal('show');
            });
        } else {
            $('#container-premium').load(window.location.origin + '/component/shortTrans/' + btnId, function() {
                $('#modal-detail').modal('show');
            });
        }
    });

    $('#btn-packing').on('click', function() {
        $('#modal-detail').modal('hide');
        $('#modal-packing').modal('show');
    });

    // modal kemas
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
