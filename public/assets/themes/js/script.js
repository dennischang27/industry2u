! function(e) {
    "use strict";
    e.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": e('meta[name="csrf-token"]').attr("content")
        }
    }), window.botbleCookieNewsletter = (() => {
        const a = 1,
            t = "botble_cookie_newsletter",
            s = e("div[data-session-domain]").data("session-domain"),
            o = e("#newsletter-modal");

        function r(e) {
            ! function(e, a, t) {
                const o = new Date;
                o.setTime(o.getTime() + 24 * t * 60 * 60 * 1e3), document.cookie = e + "=" + a + ";expires=" + o.toUTCString() + ";domain=" + s + ";path=/"
            }(t, a, e)
        }

        function i(e) {
            return -1 !== document.cookie.split("; ").indexOf(e + "=" + a)
        }
        return i(t) || setTimeout(() => {
            o.modal("show", {}, 500)
        }, 5e3), o.on("hidden.bs.modal", () => {
            !i(t) && e("#dont_show_again").is(":checked") ? r(3) : r(1 / 24)
        }), {
            newsletterWithCookies: r,
            hideCookieDialog: function() {
                o.modal("hide", {}, 500)
            }
        }
    })(), e(document).ready(function() {
        var a = a => {
                e(".newsletter-error-message").html(a).show()
            },
            t = t => {
                let s = "";
                e.each(t, (e, a) => {
                    "" !== s && (s += "<br />"), s += a
                }), a(s)
            };
        window.showAlert = ((a, t) => {
            if (a && "" !== t) {
                let s = Math.floor(1e3 * Math.random()),
                    o = `<div class="alert ${a} alert-dismissible" id="${s}">\n                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>\n                            ${t}\n                        </div>`;
                e("#alert-container").append(o).ready(() => {
                    window.setTimeout(() => {
                        e(`#alert-container #${s}`).remove()
                    }, 6e3)
                })
            }
        }), e(document).on("click", ".newsletter-form button[type=submit]", function(s) {
            s.preventDefault(), s.stopPropagation();
            let o = e(this);
            o.addClass("button-loading"), e(".newsletter-success-message").html("").hide(), e(".newsletter-error-message").html("").hide(), e.ajax({
                type: "POST",
                cache: !1,
                url: o.closest("form").prop("action"),
                data: new FormData(o.closest("form")[0]),
                contentType: !1,
                processData: !1,
                success: t => {
                    o.removeClass("button-loading"), "undefined" != typeof refreshRecaptcha && refreshRecaptcha(), t.error ? a(t.message) : (window.botbleCookieNewsletter.newsletterWithCookies(30), o.closest("form").find("input[type=email]").val(""), (a => {
                        e(".newsletter-success-message").html(a).show()
                    })(t.message), setTimeout(() => {
                        o.closest(".modal-body").find('button[data-dismiss="modal"]').trigger("click")
                    }, 2e3))
                },
                error: s => {
                    "undefined" != typeof refreshRecaptcha && refreshRecaptcha(), o.removeClass("button-loading"), (s => {
                        void 0 !== s.errors && s.errors.length ? t(s.errors) : void 0 !== s.responseJSON ? void 0 !== s.responseJSON.errors ? 422 === s.status && t(s.responseJSON.errors) : void 0 !== s.responseJSON.message ? a(s.responseJSON.message) : e.each(s.responseJSON, (t, s) => {
                            e.each(s, (e, t) => {
                                a(t)
                            })
                        }) : a(s.statusText)
                    })(s)
                }
            })
        })
    }), e(document).ready(function() {
        e(document).on("change", ".switch-currency", function() {
            e(this).closest("form").submit()
        }), e(document).on("change", ".product-filter-item", function() {
            e(this).closest("form").submit()
        }), e(document).on("click", ".js-add-favorite-button", function(a) {
            a.preventDefault();
            let t = e(this);
            t.addClass("button-loading"), e.ajax({
                url: t.prop("href"),
                method: "POST",
                success: a => {
                    if (a.error) return t.removeClass("button-loading"), window.showAlert("alert-danger", a.message), !1;
                    window.showAlert("alert-success", a.message), e(".btn-wishlist span").text(a.data.count), t.removeClass("button-loading").removeClass("js-add-favorite-button").addClass("js-remove-favorite-button active")
                },
                error: () => {
                    t.removeClass("button-loading")
                }
            })
        }), e(document).on("click", ".js-remove-favorite-button", function(a) {
            a.preventDefault();
            let t = e(this);
            t.addClass("button-loading"), e.ajax({
                url: t.prop("href"),
                method: "DELETE",
                success: a => {
                    if (a.error) return t.removeClass("button-loading"), window.showAlert("alert-danger", a.message), !1;
                    window.showAlert("alert-success", a.message), e(".btn-wishlist span").text(a.data.count), t.closest("tr").remove(), t.removeClass("button-loading").removeClass("js-remove-favorite-button active").addClass("js-add-favorite-button")
                },
                error: () => {
                    t.removeClass("button-loading")
                }
            })
        }), e(document).on("click", ".add-to-cart-button", function(a) {
            a.preventDefault();
            let t = e(this);
            t.prop("disabled", !0).addClass("button-loading"), e.ajax({
                url: t.prop("href"),
                method: "POST",
                data: {
                    id: t.data("id")
                },
                dataType: "json",
                success: a => {
                    if (t.prop("disabled", !1).removeClass("button-loading").addClass("active"), a.error) return window.showAlert("alert-danger", a.message), !1;
                    window.showAlert("alert-success", a.message), e.ajax({
                        url: "/ajax/cart",
                        method: "GET",
                        success: a => {
                            a.error || (e(".cart_box").html(a.data.html), e(".btn-shopping-cart span").text(a.data.count))
                        }
                    })
                },
                error: () => {
                    t.prop("disabled", !1).removeClass("button-loading")
                }
            })
        }), e(document).on("click", ".remove-cart-button", function(a) {
            a.preventDefault(), e(".confirm-remove-item-cart").data("url", e(this).prop("href")), e("#remove-item-modal").modal("show")
        }), e(document).on("click", ".confirm-remove-item-cart", function(a) {
            a.preventDefault();
            let t = e(this);
            t.prop("disabled", !0).addClass("button-loading"), e.ajax({
                url: t.data("url"),
                method: "GET",
                success: a => {
                    if (t.prop("disabled", !1).removeClass("button-loading"), a.error) return !1;
                    t.closest(".modal").modal("hide"), e(".form--shopping-cart").length && e(".form--shopping-cart").load(window.location.href + " .form--shopping-cart > *"), e.ajax({
                        url: "/ajax/cart",
                        method: "GET",
                        success: a => {
                            a.error || (e(".cart_box").html(a.data.html), e(".btn-shopping-cart span").text(a.data.count))
                        }
                    })
                },
                error: () => {
                    t.prop("disabled", !1).removeClass("button-loading")
                }
            })
        }), window.onBeforeChangeSwatches = function() {
            e(".add-to-cart-form button[type=submit]").prop("disabled", !0).addClass("btn-disabled")
        }, window.onChangeSwatchesSuccess = function(a) {
            if (e(".add-to-cart-form .error-message").hide(), e(".add-to-cart-form .success-message").hide(), a.error) e(".add-to-cart-form button[type=submit]").prop("disabled", !0).addClass("btn-disabled"), e(".number-items-available").html('<span class="text-danger">(0 products available)</span>').show(), e("#hidden-product-id").val("");
            else {
                e(".add-to-cart-form").find(".error-message").hide(), e(".product_price .product-sale-price-text").text(a.data.display_sale_price), a.data.sale_price !== a.data.price ? (e(".product_price .product-price-text").text(a.data.display_price).show(), e(".product_price .on_sale .on_sale_percentage_text").text(a.data.sale_percentage).show(), e(".product_price .show").hide()) : (e(".product_price .product-price-text").text(a.data.sale_percentage).hide(), e(".product_price .on_sale .on_sale_percentage_text").text(a.data.sale_percentage).hide(), e(".product_price .on_sale").hide()), e("#hidden-product-id").val(a.data.id), e(".add-to-cart-form button[type=submit]").prop("disabled", !1).removeClass("btn-disabled"), a.data.with_storehouse_management && a.data.quantity ? e(".number-items-available").html('<span class="text-success">(' + a.data.quantity + " products available)</span>").show() : e(".number-items-available").html('<span class="text-success">(> 10 products available)</span>').show();
                let t = "";
                a.data.image_with_sizes.thumb.forEach(function(e, s) {
                    t += '<div class="item"><a href="#" class="product_gallery_item ' + (0 === s ? "active" : "") + '" data-image="' + a.data.image_with_sizes.origin[s] + '" data-zoom-image="' + a.data.image_with_sizes.origin[s] + '"><img src="' + e + '" alt="image"/></a></div>'
                });
                let s = e(".slick_slider");
                s.slick("unslick"), s.html(t), s.slick({
                    rtl: "rtl" === e("body").prop("dir"),
                    arrows: s.data("arrows"),
                    dots: s.data("dots"),
                    infinite: s.data("infinite"),
                    centerMode: s.data("center-mode"),
                    vertical: s.data("vertical"),
                    fade: s.data("fade"),
                    cssEase: s.data("css-ease"),
                    autoplay: s.data("autoplay"),
                    verticalSwiping: s.data("vertical-swiping"),
                    autoplaySpeed: s.data("autoplay-speed"),
                    speed: s.data("speed"),
                    pauseOnHover: s.data("pause-on-hover"),
                    draggable: s.data("draggable"),
                    slidesToShow: s.data("slides-to-show"),
                    slidesToScroll: s.data("slides-to-scroll"),
                    asNavFor: s.data("as-nav-for"),
                    focusOnSelect: s.data("focus-on-select"),
                    responsive: s.data("responsive")
                }), e(window).trigger("resize");
                let o = e("#product_img");
                o.prop("src", a.data.image_with_sizes.origin[0]).data("zoom-image", a.data.image_with_sizes.origin[0]);
                let r = !1;
                (r = !r) ? o.length > 0 && o.elevateZoom({
                    cursor: "crosshair",
                    easing: !0,
                    gallery: "pr_item_gallery",
                    zoomType: "inner",
                    galleryActiveClass: "active"
                }): (e.removeData(o, "elevateZoom"), e(".zoomContainer:last-child").remove())
            }
        };
        let a = function(a, s) {
                if (void 0 === a.errors || _.isArray(a.errors))
                    if (void 0 !== a.responseJSON)
                        if (void 0 !== a.responseJSON.errors && 422 === a.status) t(a.responseJSON.errors, s);
                        else if (void 0 !== a.responseJSON.message) e(s).find(".error-message").html(a.responseJSON.message).show();
                        else {
                            let t = "";
                            e.each(a.responseJSON, (a, s) => {
                                e.each(s, (e, a) => {
                                    t += a + "<br />"
                                })
                            }), e(s).find(".error-message").html(t).show()
                        } else e(s).find(".error-message").html(a.statusText).show();
                else t(a.errors, s)
            },
            t = function(a, t) {
                let s = "";
                e.each(a, (e, a) => {
                    s += a + "<br />"
                }), e(t).find(".success-message").html("").hide(), e(t).find(".error-message").html("").hide(), e(t).find(".error-message").html(s).show()
            };
        e(document).on("click", ".add-to-cart-form button[type=submit]", function(t) {
            t.preventDefault(), t.stopPropagation();
            let s = e(this);
            e("#hidden-product-id").val() ? (s.prop("disabled", !0).addClass("btn-disabled").addClass("button-loading"), s.closest("form").find(".error-message").hide(), s.closest("form").find(".success-message").hide(), e.ajax({
                type: "POST",
                cache: !1,
                url: s.closest("form").prop("action"),
                data: new FormData(s.closest("form")[0]),
                contentType: !1,
                processData: !1,
                success: a => {
                    if (s.prop("disabled", !1).removeClass("btn-disabled").removeClass("button-loading"), a.error) return s.closest("form").find(".error-message").html(a.message).show(), !1;
                    s.closest("form").find(".success-message").html(a.message).show(), e.ajax({
                        url: "/ajax/cart",
                        method: "GET",
                        success: function(a) {
                            a.error || (e(".cart_box").html(a.data.html), e(".btn-shopping-cart span").text(a.data.count))
                        }
                    })
                },
                error: e => {
                    s.prop("disabled", !1).removeClass("btn-disabled").removeClass("button-loading"), a(e, s.closest("form"))
                }
            })) : s.prop("disabled", !0).addClass("btn-disabled")
        }), e(document).on("change", ".submit-form-on-change", function() {
            e(this).closest("form").submit()
        }), e(document).on("click", ".form-review-product button[type=submit]", function(t) {
            t.preventDefault(), t.stopPropagation(), e(this).prop("disabled", !0).addClass("btn-disabled").addClass("button-loading"), e.ajax({
                type: "POST",
                cache: !1,
                url: e(this).closest("form").prop("action"),
                data: new FormData(e(this).closest("form")[0]),
                contentType: !1,
                processData: !1,
                success: a => {
                    e(this).closest("form").find(".success-message").html("").hide(), e(this).closest("form").find(".error-message").html("").hide(), a.error ? (e(this).closest("form").find(".error-message").html(a.message).show(), setTimeout(function() {
                        e(this).closest("form").find(".error-message").html("").hide()
                    }, 5e3)) : (e(this).closest("form").find("select").val(0), e(this).closest("form").find("textarea").val(""), e(this).closest("form").find(".success-message").html(a.message).show(), e.ajax({
                        url: "/ajax/reviews/" + e(this).closest("form").find("input[name=product_id]").val(),
                        method: "GET",
                        success: function(a) {
                            a.error || (e("#list-reviews").html(a.data.html), e(document).find("select.rating").each(function() {
                                let a = "true" === e(this).attr("data-read-only");
                                e(this).barrating({
                                    theme: "fontawesome-stars",
                                    readonly: a,
                                    emptyValue: "0"
                                })
                            }))
                        }
                    }), setTimeout(function() {
                        e(this).closest("form").find(".success-message").html("").hide()
                    }, 5e3)), e(this).prop("disabled", !1).removeClass("btn-disabled").removeClass("button-loading")
                },
                error: t => {
                    e(this).prop("disabled", !1).removeClass("btn-disabled").removeClass("button-loading"), a(t, e(this).closest("form"))
                }
            })
        })
    })
}(jQuery),
    function(e) {
        "use strict";
        e(window).on("load", function() {
            setTimeout(function() {
                e(".preloader").delay(700).fadeOut(700).addClass("loaded")
            }, 800)
        }), e(".background_bg").each(function() {
            var a = e(this).attr("data-img-src");
            void 0 !== a && !1 !== a && e(this).css("background-image", "url(" + a + ")")
        }), e(function() {
            function a(a, t) {
                a.each(function() {
                    var a = e(this),
                        s = a.attr("data-animation"),
                        o = a.attr("data-animation-delay");
                    a.css({
                        "-webkit-animation-delay": o,
                        "-moz-animation-delay": o,
                        "animation-delay": o,
                        opacity: 0
                    }), (t || a).waypoint(function() {
                        a.addClass("animated").css("opacity", "1"), a.addClass("animated").addClass(s)
                    }, {
                        triggerOnce: !0,
                        offset: "90%"
                    })
                })
            }
            a(e(".animation")), a(e(".staggered-animation"), e(".staggered-animation-wrap"))
        }), e(window).on("scroll", function() {
            e(window).scrollTop() >= 150 ? e("header.fixed-top").addClass("nav-fixed") : e("header.fixed-top").removeClass("nav-fixed")
        }), e(document).on("ready", function() {
            e(".dropdown-menu a.dropdown-toggler").on("click", function() {
                return e(this).next().hasClass("show") || e(this).parents(".dropdown-menu").first().find(".show").removeClass("show"), e(this).next(".dropdown-menu").toggleClass("show"), e(this).parent("li").toggleClass("show"), e(this).parents("li.nav-item.dropdown.show").on("hidden.bs.dropdown", function() {
                    e(".dropdown-menu .show").removeClass("show")
                }), !1
            })
        });
        var a = e(".header_wrap"),
            t = a.find(".navbar-collapse ul li a.page-scroll");
        e.each(t, function() {
            e(this).on("click", function() {
                a.find(".navbar-collapse").collapse("hide"), e("header").removeClass("active")
            })
        }), e(".navbar-toggler").on("click", function() {
            e("header").toggleClass("active"), e(".search-overlay").hasClass("open") && (e(".search-overlay").removeClass("open"), e(".search_trigger").removeClass("open"))
        }), e(document).on("ready", function() {
            !e(".header_wrap").hasClass("fixed-top") || e(".header_wrap").hasClass("transparent_header") || e(".header_wrap").hasClass("no-sticky") || e(".header_wrap").before('<div class="header_sticky_bar d-none"></div>')
        }), e(window).on("scroll", function() {
            e(window).scrollTop() >= 150 ? (e(".header_sticky_bar").removeClass("d-none"), e("header.no-sticky").removeClass("nav-fixed")) : e(".header_sticky_bar").addClass("d-none")
        });
        var s = function() {
            var a = e(".header_wrap").height();
            e(".header_sticky_bar").css({
                height: a
            })
        };
        e(window).on("load", function() {
            s()
        }), e(window).on("resize", function() {
            s()
        }), e(".sidetoggle").on("click", function() {
            e(this).addClass("open"), e("body").addClass("sidetoggle_active"), e(".sidebar_menu").addClass("active"), e("body").append('<div id="header-overlay" class="header-overlay"></div>')
        }), e(document).on("click", "#header-overlay, .sidemenu_close", function() {
            return e(".sidetoggle").removeClass("open"), e("body").removeClass("sidetoggle_active"), e(".sidebar_menu").removeClass("active"), e("#header-overlay").fadeOut("3000", function() {
                e("#header-overlay").remove()
            }), !1
        }), e(".categories_btn").on("click", function() {
            e(".side_navbar_toggler").attr("aria-expanded", "false"), e("#navbarSidetoggle").removeClass("show")
        }), e(".side_navbar_toggler").on("click", function() {
            e(".categories_btn").attr("aria-expanded", "false"), e("#navCatContent").removeClass("show")
        }), e(".pr_search_trigger").on("click", function() {
            e(this).toggleClass("show"), e(".product_search_form").toggleClass("show")
        });
        var o = !0;
        e("html").on("click", function() {
            o && (e(".categories_btn").addClass("collapsed"), e(".categories_btn,.side_navbar_toggler").attr("aria-expanded", "false"), e("#navCatContent,#navbarSidetoggle").removeClass("show")), o = !0
        }), e(".categories_btn,#navCatContent,#navbarSidetoggle .navbar-nav,.side_navbar_toggler").on("click", function() {
            o = !1
        });
        var r = e(".top-header").innerHeight(),
            i = e(".header_wrap").innerHeight() - r - 20;
        e('a.page-scroll[href*="#"]:not([href="#"])').on("click", function() {
            if (e("a.page-scroll.active").removeClass("active"), e(this).closest(".page-scroll").addClass("active"), location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") && location.hostname === this.hostname) {
                var a = e(this.hash),
                    t = e(this).data("speed") || 800;
                (a = a.length ? a : e("[name=" + this.hash.slice(1) + "]")).length && (event.preventDefault(), e("html, body").animate({
                    scrollTop: a.offset().top - i
                }, t))
            }
        }), e(window).on("scroll", function() {
            var a, t = e(".header_wrap").find("a.page-scroll"),
                s = e(".header_wrap").innerHeight() + 20,
                o = t.map(function() {
                    var a = e(e(this).attr("href"));
                    if (a.length) return a
                }),
                r = e(this).scrollTop() + s,
                i = o.map(function() {
                    if (e(this).offset().top < r) return this
                }),
                n = (i = i[i.length - 1]) && i.length ? i[0].id : "";
            a !== n && (a = n, t.closest(".page-scroll").removeClass("active").end().filter("[href='#" + n + "']").closest(".page-scroll").addClass("active"))
        }), e(".more_slide_open").slideUp(), e(".more_categories").on("click", function() {
            e(this).toggleClass("show"), e(".more_slide_open").slideToggle()
        }), e(".close-search").on("click", function() {
            e(".search_wrap,.search_overlay").removeClass("open"), e("body").removeClass("search_open")
        });
        var n = !0;

        function l() {
            e(".carousel_slider").each(function() {
                var a = e(this);
                a.owlCarousel({
                    rtl: "rtl" === e("body").prop("dir"),
                    dots: a.data("dots"),
                    loop: a.data("loop"),
                    items: a.data("items"),
                    margin: a.data("margin"),
                    mouseDrag: a.data("mouse-drag"),
                    touchDrag: a.data("touch-drag"),
                    autoHeight: a.data("autoheight"),
                    center: a.data("center"),
                    nav: a.data("nav"),
                    rewind: a.data("rewind"),
                    navText: ['<i class="ion-ios-arrow-left"></i>', '<i class="ion-ios-arrow-right"></i>'],
                    autoplay: a.data("autoplay"),
                    animateIn: a.data("animate-in"),
                    animateOut: a.data("animate-out"),
                    autoplayTimeout: a.data("autoplay-timeout"),
                    smartSpeed: a.data("smart-speed"),
                    responsive: a.data("responsive")
                })
            })
        }

        function d() {
            e(".slick_slider").each(function() {
                var a = e(this);
                a.slick({
                    rtl: "rtl" === e("body").prop("dir"),
                    arrows: a.data("arrows"),
                    dots: a.data("dots"),
                    infinite: a.data("infinite"),
                    centerMode: a.data("center-mode"),
                    vertical: a.data("vertical"),
                    fade: a.data("fade"),
                    cssEase: a.data("css-ease"),
                    autoplay: a.data("autoplay"),
                    verticalSwiping: a.data("vertical-swiping"),
                    autoplaySpeed: a.data("autoplay-speed"),
                    speed: a.data("speed"),
                    pauseOnHover: a.data("pause-on-hover"),
                    draggable: a.data("draggable"),
                    slidesToShow: a.data("slides-to-show"),
                    slidesToScroll: a.data("slides-to-scroll"),
                    asNavFor: a.data("as-nav-for"),
                    focusOnSelect: a.data("focus-on-select"),
                    responsive: a.data("responsive")
                })
            })
        }
        e(".search_wrap").after('<div class="search_overlay"></div>'), e(".search_trigger").on("click", function() {
            e(".search_wrap,.search_overlay").toggleClass("open"), e("body").toggleClass("search_open"), n = !1, e(".navbar-collapse").hasClass("show") && (e(".navbar-collapse").removeClass("show"), e(".navbar-toggler").addClass("collapsed"), e(".navbar-toggler").attr("aria-expanded", !1))
        }), e(".search_wrap form").on("click", function() {
            n = !1
        }), e("html").on("click", function() {
            n && (e("body").removeClass("open"), e(".search_wrap,.search_overlay").removeClass("open"), e("body").removeClass("search_open")), n = !0
        }), e(window).on("scroll", function() {
            e(this).scrollTop() > 150 ? e(".scrollup").fadeIn() : e(".scrollup").fadeOut()
        }), e(".scrollup").on("click", function(a) {
            return a.preventDefault(), e("html, body").animate({
                scrollTop: 0
            }, 600), !1
        }), e(window).on("load", function() {
            var a = e(".grid_container");
            if (a.length) {
                a.length > 0 && a.imagesLoaded(function() {
                    a.hasClass("masonry") ? a.isotope({
                        itemSelector: ".grid_item",
                        percentPosition: !0,
                        layoutMode: "masonry",
                        masonry: {
                            columnWidth: ".grid-sizer"
                        }
                    }) : a.isotope({
                        itemSelector: ".grid_item",
                        percentPosition: !0,
                        layoutMode: "fitRows"
                    })
                }), e(document).on("click", ".grid_filter > li > a", function() {
                    e(".grid_filter > li > a").removeClass("current"), e(this).addClass("current");
                    var t = e(this).data("filter");
                    return a.hasClass("masonry") ? a.isotope({
                        itemSelector: ".grid_item",
                        layoutMode: "masonry",
                        masonry: {
                            columnWidth: ".grid_item"
                        },
                        filter: t
                    }) : a.isotope({
                        itemSelector: ".grid_item",
                        layoutMode: "fitRows",
                        filter: t
                    }), !1
                }), e(".portfolio_filter").on("change", function() {
                    a.isotope({
                        filter: this.value
                    })
                }), e(window).on("resize", function() {
                    setTimeout(function() {
                        a.find(".grid_item").removeClass("animation").removeClass("animated"), a.isotope("layout")
                    }, 300)
                })
            }
        }), e(".link_container").each(function() {
            e(this).magnificPopup({
                delegate: ".image_popup",
                type: "image",
                mainClass: "mfp-zoom-in",
                removalDelay: 500,
                gallery: {
                    enabled: !0
                }
            })
        }), e(document).ready(function() {
            l(), d()
        }), e("#submitButton").on("click", function(a) {
            a.preventDefault();
            var t = e("form").serialize();
            e.ajax({
                type: "POST",
                dataType: "json",
                url: "contact.php",
                data: t,
                success: function(a) {
                    "error" === a.type ? (e("#alert-msg").removeClass("alert, alert-success"), e("#alert-msg").addClass("alert, alert-danger")) : (e("#alert-msg").addClass("alert, alert-success"), e("#alert-msg").removeClass("alert, alert-danger"), e("#first-name").val("Enter Name"), e("#email").val("Enter Email"), e("#phone").val("Enter Phone Number"), e("#subject").val("Enter Subject"), e("#description").val("Enter Message")), e("#alert-msg").html(a.msg), e("#alert-msg").show()
                },
                error: function(e, a) {
                    alert(a)
                }
            })
        }), e(".content-popup").magnificPopup({
            type: "inline",
            preloader: !0,
            mainClass: "mfp-zoom-in"
        }), e(".image_gallery").each(function() {
            e(this).magnificPopup({
                delegate: "a",
                type: "image",
                gallery: {
                    enabled: !0
                }
            })
        }), e(".popup-ajax").magnificPopup({
            type: "ajax",
            callbacks: {
                ajaxContentAdded: function() {
                    l(), d()
                }
            }
        }), e(".video_popup, .iframe_popup").magnificPopup({
            type: "iframe",
            removalDelay: 160,
            mainClass: "mfp-zoom-in",
            preloader: !1,
            fixedContentPos: !1
        }), e("select").length && e.each(e("select"), function(a, t) {
            var s = e(t);
            "" === s.val() && s.addClass("first_null"), s.val() || s.addClass("not_chosen"), s.on("change", function() {
                s.val() ? s.removeClass("not_chosen") : s.addClass("not_chosen")
            })
        }), e(".fit-videos").length > 0 && e(".fit-videos").fitVids({
            customSelector: "iframe[src^='https://w.soundcloud.com']"
        }), e(".custome_select").length > 0 && e(document).on("ready", function() {
            e(".custome_select").msDropdown()
        }), e(".countdown_time").each(function() {
            var a = e(this).data("time");
            e(this).countdown(a, function(a) {
                e(this).html(a.strftime('<div class="countdown_box"><div class="countdown-wrap"><span class="countdown days">%D </span><span class="cd_text">Days</span></div></div><div class="countdown_box"><div class="countdown-wrap"><span class="countdown hours">%H</span><span class="cd_text">Hours</span></div></div><div class="countdown_box"><div class="countdown-wrap"><span class="countdown minutes">%M</span><span class="cd_text">Minutes</span></div></div><div class="countdown_box"><div class="countdown-wrap"><span class="countdown seconds">%S</span><span class="cd_text">Seconds</span></div></div>'))
            })
        }), e(document).on("click", ".shorting_icon", function() {
            e(this).hasClass("grid") ? (e(".shop_container").removeClass("list").addClass("grid"), e(this).addClass("active").siblings().removeClass("active")) : e(this).hasClass("list") && (e(".shop_container").removeClass("grid").addClass("list"), e(this).addClass("active").siblings().removeClass("active")), e(".shop_container").append('<div class="loading_pr"><div class="mfp-preloader"></div></div>'), setTimeout(function() {
                e(".loading_pr").remove()
            }, 500)
        }), e(function() {
            e('[data-toggle="tooltip"]').tooltip({
                trigger: "hover"
            })
        }), e(function() {
            e('[data-toggle="popover"]').popover()
        }), e(".product_color_switch span").each(function() {
            var a = e(this).attr("data-color");
            e(this).css("background-color", a)
        }), e(".product_color_switch span,.product_size_switch span").on("click", function() {
            e(this).siblings(this).removeClass("active").end().addClass("active")
        });
        e.magnificPopup.defaults.callbacks = {
            open: function() {
                e("body").addClass("zoom_image")
            },
            close: function() {
                setTimeout(function() {
                    e("body").removeClass("zoom_image").removeClass("zoom_gallery_image"), e(".zoomContainer:last-child").remove(), e(".zoomContainer").slice(1).remove()
                }, 100)
            }
        };
        var c = e("#pr_item_gallery");
        c.magnificPopup({
            delegate: "a",
            type: "image",
            gallery: {
                enabled: !0
            },
            callbacks: {
                elementParse: function(e) {
                    e.src = e.el.attr("data-zoom-image")
                }
            }
        }), e(".product_img_zoom").on("click", function() {
            var a = e("#pr_item_gallery a").attr("data-zoom-image");
            e("body").addClass("zoom_gallery_image"), e("#pr_item_gallery .item").each(function() {
                if (a == e(this).find(".product_gallery_item").attr("data-zoom-image")) return c.magnificPopup("open", e(this).index())
            })
        }), e(".plus").on("click", function() {
            e(this).prev().val() && e(this).prev().val(+e(this).prev().val() + 1)
        }), e(".minus").on("click", function() {
            e(this).next().val() > 1 && e(this).next().val() > 1 && e(this).next().val(+e(this).next().val() - 1)
        }), e(document).ready(function() {
            function a(e, a, t, s) {
                let o = isFinite(+e) ? +e : 0,
                    r = isFinite(+a) ? Math.abs(a) : 0,
                    i = void 0 === s ? "," : s,
                    n = void 0 === t ? "." : t,
                    l = (r ? function(e, a) {
                        let t = Math.pow(10, a);
                        return Math.round(e * t) / t
                    }(o, r) : Math.round(o)).toString().split(".");
                return l[0].length > 3 && (l[0] = l[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, i)), (l[1] || "").length < r && (l[1] = l[1] || "", l[1] += new Array(r - l[1].length + 1).join("0")), l.join(n)
            }
            var t = e("#price_filter");
            if (t.length) {
                var s = t.data("min-value"),
                    o = t.data("max-value"),
                    r = t.data("price-sign"),
                    i = parseFloat(e("div[data-current-exchange-rate]").data("current-exchange-rate")),
                    n = e("div[data-is-prefix-symbol]").data("is-prefix-symbol");
                t.slider({
                    isRTL: "rtl" === e("body").prop("dir"),
                    range: !0,
                    min: t.data("min"),
                    max: t.data("max"),
                    values: [s, o],
                    slide: function(t, s) {
                        var o = a(s.values[0] * i),
                            l = a(s.values[1] * i);
                        "1" == n ? (o = r + o, l = r + l) : (o += r, l += r), e("#flt_price").html(o + " - " + l), e("#price_first").val(s.values[0]), e("#price_second").val(s.values[1])
                    },
                    stop: function() {
                        e("#price_filter").closest("form").submit()
                    }
                });
                var l = a(t.slider("values", 0) * i),
                    d = a(t.slider("values", 1) * i);
                "1" == n ? (l = r + l, d = r + d) : (l += r, d += r), e("#flt_price").html(l + " - " + d)
            }
        }), e(document).ready(function() {
            e(".star_rating span").on("click", function() {
                for (var a = parseFloat(e(this).data("value"), 10), t = e(this).parent().children(".star_rating span"), s = 0; s < t.length; s++) e(t[s]).removeClass("selected");
                for (s = 0; s < a; s++) e(t[s]).addClass("selected");
                e(this).closest("form").find("input[name=star]").val(a)
            })
        }), e(document).ready(function() {
            var a;
            a = e("#product_img"), !!1 ? e(a).length > 0 && e(a).elevateZoom({
                cursor: "crosshair",
                easing: !0,
                gallery: "pr_item_gallery",
                zoomType: "inner",
                galleryActiveClass: "active"
            }) : (e.removeData(a, "elevateZoom"), e(".zoomContainer:last-child").remove())
        })
    }(jQuery);
