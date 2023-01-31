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
                $('#modal-detail').modal('show');
            });
        } else {
            $('#container-premium').load(window.location.origin + '/component/transPremium/' + btnId, function() {
                setThousandSeparator();
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
});
