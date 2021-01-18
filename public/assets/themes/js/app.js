(function ($) {
    'use strict';




    /*===================================*
                MENU JS
     *===================================*/
    //Main navigation scroll spy for shadow
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 150) {
            $('header.fixed-top').addClass('nav-fixed');
        } else {
            $('header.fixed-top').removeClass('nav-fixed');
        }

    });
    /*===================================*
            List Grid JS
    *===================================*/
    $(document).on('click', '.shorting_icon', function () {
        if ($(this).hasClass('grid')) {
            $('.shop_container').removeClass('list').addClass('grid');
            $(this).addClass('active').siblings().removeClass('active');
        } else if ($(this).hasClass('list')) {
            $('.shop_container').removeClass('grid').addClass('list');
            $(this).addClass('active').siblings().removeClass('active');
        }
        $(".shop_container").append('<div class="loading_pr"><div class="mfp-preloader"></div></div>');
        setTimeout(function () {
            $('.loading_pr').remove();
        }, 500);
    });
    // Show Hide dropdown-menu Main navigation
    $(document).on('ready', function () {
        $('.dropdown-menu a.dropdown-toggler').on('click', function () {
            if (!$(this).next().hasClass('show')) {
                $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
            }
            var $subMenu = $(this).next(".dropdown-menu");
            $subMenu.toggleClass('show');

            $(this).parent("li").toggleClass('show');

            $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function () {
                $('.dropdown-menu .show').removeClass("show");
            });

            return false;
        });
    });

    //Hide Navbar Dropdown After Click On Links
    var navBar = $('.header_wrap');
    var navbarLinks = navBar.find(".navbar-collapse ul li a.page-scroll");

    $.each(navbarLinks, function () {

        var navbarLink = $(this);

        navbarLink.on('click', function () {
            navBar.find(".navbar-collapse").collapse('hide');
            $("header").removeClass("active");
        });

    });

    // Main navigation Active Class Add Remove
    $('.navbar-toggler').on('click', function () {
        $("header").toggleClass("active");
        if ($('.search-overlay').hasClass('open')) {
            $(".search-overlay").removeClass('open');
            $(".search_trigger").removeClass('open');
        }
    });

    $(document).on('ready', function () {
        if ($('.header_wrap').hasClass("fixed-top") && !$('.header_wrap').hasClass("transparent_header") && !$('.header_wrap').hasClass("no-sticky")) {
            $(".header_wrap").before('<div class="header_sticky_bar d-none"></div>');
        }
    });

    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 150) {
            $('.header_sticky_bar').removeClass('d-none');
            $('header.no-sticky').removeClass('nav-fixed');

        } else {
            $('.header_sticky_bar').addClass('d-none');
        }

    });

    var setHeight = function () {
        var height_header = $(".header_wrap").height();
        $('.header_sticky_bar').css({'height': height_header});
    };

    $(window).on('load', function () {
        setHeight();
    });

    $(window).on('resize', function () {
        setHeight();
    });

    $('.sidetoggle').on('click', function () {
        $(this).addClass('open');
        $('body').addClass('sidetoggle_active');
        $('.sidebar_menu').addClass('active');
        $("body").append('<div id="header-overlay" class="header-overlay"></div>');
    });

    $(document).on('click', '#header-overlay, .sidemenu_close', function () {
        $('.sidetoggle').removeClass('open');
        $('body').removeClass('sidetoggle_active');
        $('.sidebar_menu').removeClass('active');
        $('#header-overlay').fadeOut('3000', function () {
            $('#header-overlay').remove();
        });
        return false;
    });

    $(".categories_btn").on('click', function () {
        $('.side_navbar_toggler').attr('aria-expanded', 'false');
        $('#navbarSidetoggle').removeClass('show');
    });

    $(".side_navbar_toggler").on('click', function () {
        $('.categories_btn').attr('aria-expanded', 'false');
        $('#navCatContent').removeClass('show');
    });

    $(".pr_search_trigger").on('click', function () {
        $(this).toggleClass('show');
        $('.product_search_form').toggleClass('show');
    });

    var rclass = true;

    $("html").on('click', function () {
        if (rclass) {
            $('.categories_btn').addClass('collapsed');
            $('.categories_btn,.side_navbar_toggler').attr('aria-expanded', 'false');
            $('#navCatContent,#navbarSidetoggle').removeClass('show');
        }
        rclass = true;
    });

    $(".categories_btn,#navCatContent,#navbarSidetoggle .navbar-nav,.side_navbar_toggler").on('click', function () {
        rclass = false;
    });

    /*===================================*
   SMOOTH SCROLLING JS
   *===================================*/
    // Select all links with hashes

    var topheaderHeight = $(".top-header").innerHeight();
    var mainheaderHeight = $(".header_wrap").innerHeight();
    var headerHeight = mainheaderHeight - topheaderHeight - 20;
    $('a.page-scroll[href*="#"]:not([href="#"])').on('click', function () {
        $('a.page-scroll.active').removeClass('active');
        $(this).closest('.page-scroll').addClass('active');
        // On-page links
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            // Figure out element to scroll to
            var target = $(this.hash),
                speed = $(this).data("speed") || 800;
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

            // Does a scroll target exist?
            if (target.length) {
                // Only prevent default if animation is actually gonna happen
                event.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - headerHeight
                }, speed);
            }
        }
    });
    $(window).on('scroll', function () {
        var lastId,
            // All list items
            menuItems = $(".header_wrap").find("a.page-scroll"),
            topMenuHeight = $(".header_wrap").innerHeight() + 20,
            // Anchors corresponding to menu items
            scrollItems = menuItems.map(function () {
                var items = $($(this).attr("href"));
                if (items.length) {
                    return items;
                }
            });
        var fromTop = $(this).scrollTop() + topMenuHeight;

        // Get id of current scroll item
        var cur = scrollItems.map(function () {
            if ($(this).offset().top < fromTop)
                return this;
        });
        // Get the id of the current element
        cur = cur[cur.length - 1];
        var id = cur && cur.length ? cur[0].id : "";

        if (lastId !== id) {
            lastId = id;
            // Set/remove active class
            menuItems.closest('.page-scroll').removeClass("active").end().filter("[href='#" + id + "']").closest('.page-scroll').addClass("active");
        }

    });
    /*===================================*
    SCROLLUP JS
   *===================================*/
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 150) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $(".scrollup").on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 600);
        return false;
    });
})(jQuery);
