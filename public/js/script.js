$(document).ready(function() {
    $('form').on('click', '.fas.fa-eye-slash', function() {
        $(this).siblings().attr('type', 'text');
        $(this).attr('class', 'fas fa-eye');
    });
    
    $('form').on('click', '.fas.fa-eye', function() {
        $(this).siblings().attr('type', 'password');
        $(this).attr('class', 'fas fa-eye-slash');
    });
});