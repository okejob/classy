$(document).ready(function() {
    // untuk menampilkan modal pickup
    $('#create-pickup').on('click', function() {
        $('#modal-create-pickup').modal('show');
    });

    // untuk menampilkan modal delivery
    $('#create-delivery').on('click', function() {
        $('#modal-create-delivery').modal('show');
    });
});
