$(document).ready(function() {
    $('form').on('click', '.fas.fa-eye-slash', function() {
        $(this).siblings().attr('type', 'text');
        $(this).attr('class', 'fas fa-eye');
    });

    $('form').on('click', '.fas.fa-eye', function() {
        $(this).siblings().attr('type', 'password');
        $(this).attr('class', 'fas fa-eye-slash');
    });

    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    if (getCookie('submenu-Data') != '') {
        $('#nav-menu-data .nav-items').show();
        $('#nav-menu-data .menu-header .fa-angle-down').addClass('fa-rotate-180');
    }
    if (getCookie('submenu-Transaksi') != '') {
        $('#nav-menu-transaksi .nav-items').show();
        $('#nav-menu-transaksi .menu-header .fa-angle-down').addClass('fa-rotate-180');
    }
    if (getCookie('submenu-Setting') != '') {
        $('#nav-menu-setting .nav-items').show();
        $('#nav-menu-setting .menu-header .fa-angle-down').addClass('fa-rotate-180');
    }

    $('#side-nav .menu-header').on('click', function() {
        let submenu = $(this).find('p').text();
        let state = '';
        $(this).find('.fa-angle-down').removeClass('fa-rotate-180');
        if ($(this).next().css('display') == 'none') {
            state = 'open';
            $(this).find('.fa-angle-down').addClass('fa-rotate-180');
        }
        $(this).next().toggle('fast', null);
        setCookie('submenu-' + submenu, state, 1);
    });

    if (getCookie('current-menu') != '') {
        let menu = getCookie('current-menu').split('/');
        menu.shift();

        $('#nav-menu-' + menu[0] + ' #nav-' + menu[0] + '-' + menu[1] + ' .menu-item').addClass('active color-sub');
    }

    $('#side-nav .nav-items div').on('click', function() {
        setCookie('current-menu', $(this).children().attr('href'), 1);
    });

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

});
