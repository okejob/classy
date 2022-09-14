$(document).ready(function() {
    $('#table-pengaturan-karyawan').DataTable();
    
    var flag = false;
    var btnIndex = -1;
    $('.btn-show-action').on('click', function() {
        let lebarList = 150;
        let lebarBtn = $(this).css('width');
        let lebarTambahan = 2;
        lebarBtn = parseInt(lebarBtn.substr(0, lebarBtn.indexOf('px')));
        $('#list-action').css('left', $(this).offset().left - $('.card').offset().left - lebarList + lebarBtn + lebarTambahan);

        let tinggiBtn = $(this).css('height');
        let tinggiHeader = 0;
        tinggiBtn = parseInt(tinggiBtn.substr(0, tinggiBtn.indexOf('px')));
        $('#list-action').css('top', $(this).offset().top - $('.card').offset().top + tinggiBtn + tinggiHeader);

        $('#list-action').show();
        btnIndex = $(this).index('.btn-show-action') + 1;
        flag = true;
    });
    
    $(document).on('click', function() {
        setTimeout(function (){
            if (flag) {
                flag = !flag;
            } else {
                if ($('#list-action').css('display') == 'block') {
                    $('#list-action').hide();
                }
            }
        }, 10);
    });
    
    $('#action-update').on('click', function() {
        $('#update-username').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(1)').html());
        $('#update-nama').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(2)').html());
        $('#update-telepon').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(3)').html());
        $('#update-email').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(4)').html());
        $('#update-role').val($('tbody tr:nth-child(' + btnIndex + ') td:nth-child(5)').html().toLowerCase());
        
        $('#modal-update').modal('show');
    });
    
    $('#action-change-password').on('click', function() {
        $('#modal-change-password').modal('show');
    });
});