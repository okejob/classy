$(document).ready(function() {

    $('#btn-ubah').on('click', function() {
        $('.disabled').each(function(index, element) {
            $(element).removeClass('disabled');
        });
        $(this).hide();
        $(this).next().show();
    });


});
