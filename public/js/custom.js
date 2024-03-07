function navbarResponsive() {
    let navbar = $("#myTopnav");
    if (!navbar.hasClass("responsive")) {
        navbar.addClass("responsive");
    } else {
        navbar.removeClass("responsive");
    }
}

let hiddenTimeout;
let prevWindowY = 0;
window.onscroll = function() {
    navbarScroll();
};

function navbarScroll() {
    let navbar = $('#myTopnav');
    let windowPositionY = window.scrollY;

    if (windowPositionY >= prevWindowY) {
        navbar.css("opacity", "0");

        if (hiddenTimeout) {
            clearTimeout(hiddenTimeout);
            hiddenTimeout = null;
        }

        hiddenTimeout = setTimeout(function () {
            navbar.css("visibility", "hidden");
        }, 500);
    } else {
        if (typeof hiddenTimeout !== 'undefined') {
            clearTimeout(hiddenTimeout);
        }
        navbar.css("visibility", "visible");
        navbar.css("opacity", "1");
    }

    if (windowPositionY === 0) {
        if (typeof hiddenTimeout !== 'undefined') {
            clearTimeout(hiddenTimeout);
        }

        navbar.css("visibility", "visible");
        navbar.css("opacity", "1");
    }
    prevWindowY = windowPositionY;
}

$(document).ready(function() {

    if ($(document.body).hasClass('new-body')) {
        setSelectSize();
    }

    $('.js-example-responsive').select2({
        maximumSelectionLength: 5,
        tags: true,
        tokenSeparators: [',', ' '],
        createTag: function (params) {
            let term = $.trim(params.term);

            if (term === '') {
                return null;
            }

            return {
                id: term,
                text: term,
                newTag: true
            }
        }
    });

    $('.js-example-basic-multiple').select2({
        maximumSelectionLength: 5
    });
    
    $(window).on('resize', function() {
        if ($(document.body).hasClass('new-body')) {
            setSelectSize();
        }
    });

    function setSelectSize() {
        if ($(window).width() < 600) {
            $('#select2').css('width', '100%');
            $('#select2').siblings('.select2-container').css('width', '100%');
         }
        else {
            $('#select2').css('width', '75%');
            $('#select2').siblings('.select2-container').css('width', '75%');
        }
    }

    $('#filter-button').on('click', function(){
        $("#collapsing-form").slideToggle('medium', function() {
            if ($(this).is(':visible'))
                $(this).css('display','flex');
        });
    });

    $('#close-alert-button').on('click', function(){
        $(this).closest('.alert').css('display','none');
    });
});
