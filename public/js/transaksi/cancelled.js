$(document).ready(function() {
    var btnIndex = -1, btnId = 0;
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    $('#search-key-trans').on('click', function() {
        let key = $('#input-key-trans').val()
        $.ajax({
            url: "/transaksi/search?key=" + key,
        }).done(function(data) {
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
                        "<td class='text-end thousand-separator'>" + trans.grand_total + "</td>" +
                        "<td class='text-center'>" + ((trans.lunas) ? 'Lunas' : 'Belum Lunas') + "</td>" +
                    "</tr>"
                );
            }
            setThousandSeparator();
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

    $('#action-restore').on('click', function() {
        if (confirm('Yakin memulihkan transaksi ?')) {
            $.ajax({
                url: "/transaksi/" + btnId + "/restore",
            }).done(function() {
                window.location = window.location.origin + window.location.pathname;
            });
        }
    });
});
