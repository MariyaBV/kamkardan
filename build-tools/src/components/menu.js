// $(document).ready(function ($) {
//     function checkCatalogInUrl() {
//         var url = window.location.href;
//         var catalogLink = $('a[href="#catalog"]');
//         var blockCatalog = $('#block-catalog');
//         var mainHeader = $('#main-header');


//         if (url.includes('#catalog') && catalogLink.length) {
//             catalogLink.addClass('selected-item-menu');
//             blockCatalog.addClass('visible');
//         } else {
//             catalogLink.removeClass('selected-item-menu');
//             blockCatalog.removeClass('visible');
//         }
//     }

//     function toggleCatalogClass(event) {
//         event.preventDefault();
//         $(this).toggleClass('selected-item-menu');
//         var blockCatalog = $('#block-catalog');

//         if ($(this).hasClass('selected-item-menu')) {
//             history.pushState(null, null, '#catalog');
//             blockCatalog.addClass('visible');
//         } else {
//             history.pushState(null, null, window.location.pathname + window.location.search);
//             blockCatalog.removeClass('visible');
//         }
//     }

//     function openCatalog(event) {
//         event.preventDefault();
//         var catalogLink = $(this);
//         var blockCatalog = $('#block-catalog');
//         catalogLink.addClass('selected-item-menu');
//         blockCatalog.addClass('display_block');
//         setTimeout(() => {
//             blockCatalog.addClass('visible');
//         }, 200);
//         history.pushState(null, null, '#catalog');
//     }

//     function closeCatalogMenu(event) {
//         event.preventDefault();
//         var catalogLink = $('a[href="#catalog"]');
//         var blockCatalog = $('#block-catalog');

//         catalogLink.removeClass('selected-item-menu');
//         blockCatalog.removeClass('visible');
//         setTimeout(() => {
//             blockCatalog.removeClass('display_block');
//         }, 500);
//         history.pushState(null, null, window.location.pathname + window.location.search);
//     }

//     function closeCatalogMenuBack(event) {
//         event.preventDefault();
//         var blockCatalog = $('#block-catalog');

//         blockCatalog.removeClass('visible');
//         setTimeout(() => {
//             blockCatalog.removeClass('display_block');
//         }, 500);
//         history.pushState(null, null, window.location.pathname + window.location.search);
//     }

//     checkCatalogInUrl();

//     $('a[href="#catalog"]').on('click', openCatalog);
//     $('#close-catalog-menu').on('click', closeCatalogMenu);
//     $('#close-catalog-menu-back').on('click', closeCatalogMenuBack);
// });


// $(document).ready(function () {
//     $('#burger-menu').click(function () {
//         $(this).toggleClass('active');
//         $('#site-navigation').toggleClass('visible');
//     });
// });

$(document).ready(function () {
    function checkCatalogInUrl() {
        var url = window.location.href;
        var catalogLink = $('a[href="#catalog"]');
        var blockCatalog = $('#block-catalog');
        var mainHeader = $('#main-header');

        if (url.includes('#catalog') && catalogLink.length) {
            catalogLink.addClass('selected-item-menu');
            blockCatalog.addClass('visible');
        } else {
            catalogLink.removeClass('selected-item-menu');
            blockCatalog.removeClass('visible');
        }
    }

    function toggleCatalogClass(event) {
        event.preventDefault();
        $(this).toggleClass('selected-item-menu');
        var blockCatalog = $('#block-catalog');

        if ($(this).hasClass('selected-item-menu')) {
            history.pushState(null, null, '#catalog');
            blockCatalog.addClass('visible');
        } else {
            history.pushState(null, null, window.location.pathname + window.location.search);
            blockCatalog.removeClass('visible');
        }
    }

    function openCatalog(event) {
        event.preventDefault();
        var catalogLink = $(this);
        var blockCatalog = $('#block-catalog');
        catalogLink.addClass('selected-item-menu');
        blockCatalog.addClass('display_block');
        setTimeout(() => {
            blockCatalog.addClass('visible');
        }, 200);
        history.pushState(null, null, '#catalog');
    }

    function closeCatalogMenu(event) {
        event.preventDefault();
        var catalogLink = $('a[href="#catalog"]');
        var blockCatalog = $('#block-catalog');

        catalogLink.removeClass('selected-item-menu');
        blockCatalog.removeClass('visible');
        setTimeout(() => {
            blockCatalog.removeClass('display_block');
        }, 500);
        history.pushState(null, null, window.location.pathname + window.location.search);
    }

    function closeCatalogMenuBack(event) {
        event.preventDefault();
        var blockCatalog = $('#block-catalog');

        blockCatalog.removeClass('visible');
        setTimeout(() => {
            blockCatalog.removeClass('display_block');
        }, 500);
        history.pushState(null, null, window.location.pathname + window.location.search);
    }

    checkCatalogInUrl();

    $('a[href="#catalog"]').on('click', openCatalog);
    $('#close-catalog-menu').on('click', closeCatalogMenu);
    $('#close-catalog-menu-back').on('click', closeCatalogMenuBack);

    $('#burger-menu').click(function () {
        $(this).toggleClass('active');
        $('#site-navigation').toggleClass('visible');

        var $menu = $('.sub-menu');

        if ($menu.hasClass('show')) {
            $menu.removeClass('show');
            $(this).removeClass('selected-item-menu');
        } 
        
        var blockCatalog = $('#block-catalog');
        if (blockCatalog.hasClass('visible')) {
            blockCatalog.removeClass('visible');
            history.pushState(null, null, window.location.pathname + window.location.search);
        }
    });
});


$(document).ready(function ($) {
    function closeCatalogSidebar(event) {
        event.preventDefault();
        var sidebarCatalog = $('#catalog-sidebar');
        sidebarCatalog.removeClass('visible-mobile');
    }

    function openCatalogSidebar(event) {
        event.preventDefault();
        var sidebarCatalog = $('#catalog-sidebar');
        sidebarCatalog.addClass('visible-mobile');
    }

    $('#show-catalog-sidebar').on('click', openCatalogSidebar);
    $('#close-catalog-sidebar').on('click', closeCatalogSidebar);
    $('#close-catalog-sidebar-x').on('click', closeCatalogSidebar);
});


//выпадающий список
$(document).ready(function () {
    $('a[href="#uslugi"]').on('click', function (event) {
        event.preventDefault();

        var $menu = $('.sub-menu');

        if ($menu.hasClass('show')) {
            $menu.removeClass('show');
            $(this).removeClass('selected-item-menu');
        } else {
            $menu.addClass('show');
            $(this).addClass('selected-item-menu');
        }
    });
});

