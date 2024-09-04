<<<<<<< HEAD
$(document).ready(function($) {
=======
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
>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
    function checkCatalogInUrl() {
        var url = window.location.href;
        var catalogLink = $('a[href="#catalog"]');
        var blockCatalog = $('#block-catalog');
<<<<<<< HEAD
        
        
=======
        var mainHeader = $('#main-header');

>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
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
<<<<<<< HEAD
        
=======

>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
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
<<<<<<< HEAD
        //console.log(catalogLink);
        var blockCatalog = $('#block-catalog');
        $('#main-header').addClass('header-not-fixed');
        
        //if (!catalogLink.hasClass('selected-item-menu')) {
            //console.log('open');
            catalogLink.addClass('selected-item-menu');
            blockCatalog.addClass('display_block');
            setTimeout(() => {
                blockCatalog.addClass('visible');
            }, 200);
            history.pushState(null, null, '#catalog');
        //}
=======
        var blockCatalog = $('#block-catalog');
        catalogLink.addClass('selected-item-menu');
        blockCatalog.addClass('display_block');
        setTimeout(() => {
            blockCatalog.addClass('visible');
        }, 200);
        history.pushState(null, null, '#catalog');
>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
    }

    function closeCatalogMenu(event) {
        event.preventDefault();
        var catalogLink = $('a[href="#catalog"]');
        var blockCatalog = $('#block-catalog');
<<<<<<< HEAD
        
        catalogLink.removeClass('selected-item-menu');
        blockCatalog.removeClass('visible');
            setTimeout(() => {
                blockCatalog.removeClass('display_block');
            }, 500);
=======

        catalogLink.removeClass('selected-item-menu');
        blockCatalog.removeClass('visible');
        setTimeout(() => {
            blockCatalog.removeClass('display_block');
        }, 500);
>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
        history.pushState(null, null, window.location.pathname + window.location.search);
    }

    function closeCatalogMenuBack(event) {
        event.preventDefault();
        var blockCatalog = $('#block-catalog');
<<<<<<< HEAD
        
        blockCatalog.removeClass('visible');
            setTimeout(() => {
                blockCatalog.removeClass('display_block');
            }, 500);
        history.pushState(null, null, window.location.pathname + window.location.search);
        $('#main-header').removeClass('header-not-fixed');
=======

        blockCatalog.removeClass('visible');
        setTimeout(() => {
            blockCatalog.removeClass('display_block');
        }, 500);
        history.pushState(null, null, window.location.pathname + window.location.search);
>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
    }

    checkCatalogInUrl();

    $('a[href="#catalog"]').on('click', openCatalog);
    $('#close-catalog-menu').on('click', closeCatalogMenu);
    $('#close-catalog-menu-back').on('click', closeCatalogMenuBack);
<<<<<<< HEAD
});


$(document).ready(function() {
    $('#burger-menu').click(function() {
        $(this).toggleClass('active');
        $('#site-navigation').toggleClass('visible');
=======

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
>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
    });
});


<<<<<<< HEAD

$(document).ready(function($) {
=======
$(document).ready(function ($) {
>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
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
<<<<<<< HEAD
$(document).ready(function() {
    $('a[href="#uslugi"]').on('click', function(event) {
=======
$(document).ready(function () {
    $('a[href="#uslugi"]').on('click', function (event) {
>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
        event.preventDefault();

        var $menu = $('.sub-menu');

        if ($menu.hasClass('show')) {
            $menu.removeClass('show');
<<<<<<< HEAD
        } else {
            $menu.addClass('show');
=======
            $(this).removeClass('selected-item-menu');
        } else {
            $menu.addClass('show');
            $(this).addClass('selected-item-menu');
>>>>>>> 6792cb3554322df4017191e382c2ca5918daba8f
        }
    });
});

