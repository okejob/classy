$(document).ready(function() {
    // untuk menampilkan modal pickup
    $('#create-pickup').on('click', function() {
        $('#modal-create-pickup').modal('show');
    });

    // untuk menampilkan modal delivery
    $('#create-delivery').on('click', function() {
        $('#modal-create-delivery').modal('show');
    });

    $('#table-pickup').load(window.location.origin + '/component/pickup');
    $('#section-pickup').on('click', '.page-link', function(e) {
        e.preventDefault();
        $('#table-pickup').load($(this).attr('href'));
    });

    $('#table-delivery').load(window.location.origin + '/component/delivery');
    $('#section-delivery').on('click', '.page-link', function(e) {
        e.preventDefault();
        $('#table-delivery').load($(this).attr('href'));
    });

    $('#table-di-outlet').load(window.location.origin + '/component/ambil_di_outlet');
    $('#section-ambil-outlet').on('click', '.page-link', function(e) {
        e.preventDefault();
        $('#table-di-outlet').load($(this).attr('href'));
    })
});
