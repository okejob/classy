$(document).ready(function() {
    // untuk "enable" kan komponen yang nantinya digunakan untuk mengupdate data pelanggan
    $('#btn-ubah').on('click', function() {
        $('.disabled').each(function(index, element) {
            $(element).removeClass('disabled');
        });
        $(this).hide();
        $(this).next().show();
    });

});
