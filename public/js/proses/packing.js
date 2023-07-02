$(document).ready(function() {
    var btnIndex = -1, btnId = 0, tipeTrans = '';
    $('.btn-show-action').on('click', function() {
        btnIndex = $(this).index('.btn-show-action') + 1;
        btnId = $(this).attr('id').substring(4);
    });

    $('#action-detail').on('click', function() {
        $('#container-bucket').empty();
        $('#container-premium').empty();
        if ($('tr:nth-child(' + btnIndex + ') td:nth-child(1)').html().includes('BU-')) {
            $('#container-bucket').load(window.location.origin + '/component/shortTrans/' + btnId, function() {
                tipeTrans = 'bucket';
                $('#modal-detail').modal('show');
            });
        } else {
            $('#container-premium').load(window.location.origin + '/component/shortTrans/' + btnId, function() {
                tipeTrans = 'premium';
                $('#modal-detail').modal('show');
            });
        }
    });

    $('#action-kemas').on('click', function() {
        $('#table-container').load(window.location.origin + '/component/packing/' + btnId, function() {
            $('#modal-packing').modal('show');
        });
    });

    $('#action-print').on('click', function() {
        window.location = window.location.origin + "/printMemoProduksi/" + btnId;
    });

    $('#simpan-packing').on('click', function() {

    });
});
