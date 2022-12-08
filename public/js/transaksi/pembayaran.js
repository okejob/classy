$(document).ready(function() {
    var btnIndex = -1, btnId = 0;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    $('#action-detail').on('click', function() {
        $('#diskon').parent().show();

        $.ajax({
            url: "/transaksi/detail/" + btnId,
        }).done(function(data) {
            let trans = data;
            $('#kode-trans').text(trans.kode);
            $('#subtotal').html(trans.subtotal);
            $('#diskon').html(trans.diskon + trans.diskon_member);
            $('#grand-total').html(trans.grand_total);

            let items = trans.item_transaksi;
            items.forEach(item => {
                let temp = "<td>Rp</td><td class='text-end'>" + item.harga_premium + "</td>";
                if (item.harga_premium == 0) {
                    temp = "<td colspan='2' class='text-center'>" + parseFloat(item.bobot_bucket) + "</td>";
                }
                $('#table-item-transaksi tbody').append(
                    "<tr id='item-" + item.jenis_item_id + "'>" +
                        "<td>" + item.nama + "</td>" +
                        "<td class='text-center'>" + item.nama_kategori + "</td>" +
                        temp +
                    "</tr>"
                );
            });

            if (trans.diskon + trans.diskon_member == 0) {
                $('#diskon').parent().hide();
            }
            setThousandSeparator();
            $('#modal-detail-trans').modal('show');
        });
    });

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
        }
    };
});
