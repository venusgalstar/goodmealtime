// JavaScript Document
(function($)
{
    "use strict";
    if($('.js-example-basic-single').length > 0)
    {
        $('.js-example-basic-single').select2({width:"100%"});
    }
    if($('.js-example-tokenizer').length > 0)
    {
        $('.js-example-tokenizer').select2({tags: true,tokenSeparators: [',', ' ']});
    }
    if ($('.fr-hero-logo').length > 0) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    }
	$( ".real-static-page .blog-detial-main-area p" ).last().css( "margin-bottom", "0" );
    if ($('.or_specific_page').length > 0) {$('.js-example-tokenizer').select2({tags: true, tokenSeparators: [',', ' ']});}
    if ($('.foodota-shop-detail .variations').length > 0) {$('select').select2({tags: true,tokenSeparators: [',', ' ']});}
    if ($('.bla-1').length > 0) {$("a.bla-1").YouTubePopUp();}
    if ($('.bla-2').length > 0) {$("a.bla-2").YouTubePopUp();}
    if ($('.order-box').length > 0) {
        var flip = 0;
        $("#myelement").on('click', function(){
            $(".order-box").toggle(flip++ % 2 === 0);
        });
    }
    if ($('.vendor-detail').length > 0) {
        $('.vendor-detail').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            nav: false,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1400: {
                    items: 1
                }
            }
        });
    }


    if ($('.sale-product').length > 0) {
        $('.sale-product').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    }
    if ($('.top-sale-product').length > 0) {
        $('.top-sale-product').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: false,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });

    }
    if ($('.product-res').length > 0) {
        $('.product-res').owlCarousel({
            loop: true,
            margin: 10,
            autoplay: false,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                },
                1200: {
                    items: 5
                }
            }
        });

    }
    if ($('.food-cats').length > 0) {
        $('.food-cats').owlCarousel({

            loop: ($(".food-cats .item").length > 4) ? true : false,
            margin: 10,
            autoplay: false,
            nav: true,
            responsive: {
                0: {
                    items: 2
                },
                500: {
                    items: 3
                },
                700: {
                    items: 4
                },
                1000: {
                    items: 3
                }
            }
        });
    }
    if ($('.food-cat').length > 0) {
        $('.food-cat').owlCarousel({
            loop: true,
            margin: 0,
            autoplay: true,
            nav: true,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 3
                },
                900: {
                    items: 4
                },
                1200: {
                    items: 6
                },
                1300: {
                    items: 7
                }
            }
        });
    }
    if ($('.cat').length > 0) {
        $('.cat').owlCarousel({
            loop: true,
            margin: 20,
            autoplay: true,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                900: {
                    items: 4
                },
                1200: {
                    items: 6
                }
            }
        });
    }
    if ($('.testimonial-slider').length > 0) {
        $('.testimonial-slider').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        })
    }
    if ($('.short-restaurants').length > 0) {
        $('.short-restaurants').owlCarousel({
            loop: true,
            margin: 20,
            autoplay: true,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });
    }
    if ($('.fc-slider').length > 0) {
        $('.fc-slider').owlCarousel({
            loop: true,
            margin: 20,
            autoplay: false,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                900: {
                    items: 3
                },
                1200: {
                    items: 3
                }
            }
        });
    }
    if ($('.banner-slider').length > 0) {
        $('.banner-slider').owlCarousel({
            loop: true,
            margin: 20,
            autoplay: true,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    }
    if ($('.prop-types-carsol').length) {
        $('.prop-types-carsol').owlCarousel({
            dots: false,
            loop: true,
            margin: 30,
            nav: true,
            smartSpeed: 1200,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
                0: {
                    items: 1,
                    center: false
                },
                480: {
                    items: 1,
                    center: false
                },
                520: {
                    items: 2,
                    center: false
                },
                600: {
                    items: 2,
                    center: false
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 5
                }
            }
        });
    }
    if ($('.prop-types-carsol2').length) {
        $('.prop-types-carsol2').owlCarousel({
            dots: false,
            loop: true,
            margin: 30,
            nav: true,
            smartSpeed: 1200,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
                0: {
                    items: 1,
                    center: false
                },
                480: {
                    items: 1,
                    center: false
                },
                520: {
                    items: 2,
                    center: false
                },
                600: {
                    items: 2,
                    center: false
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                },
                1200: {
                    items: 5
                }
            }
        });
    }
    //single product js start here
    if ($('.tab-pill-carousel').length > 0) {
        $('.tab-pill-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 1
                },
                768: {
                    items: 1
                },
                992: {
                    items: 2
                },
                1200: {
                    items: 3
                },
                1400: {
                    items: 3
                }
            }
        });
    }
    if ($('.slider1').length > 0) {
        $('.slider1').owlCarousel({
            loop: true,
            thumbs: true,
            nav: false,
            items: 3,
            smartSpeed: 1200,
            responsiveClass: true,
            autoplay: true,
            autoplayHoverPause: true,
            slideSpeed: 8000,
            paginationSpeed: 6000,
            thumbsPrerendered: true,
            autoplayTimeout: 6000,
            responsive: {
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                768: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    }

    if ($('.fodo-top-banner,.services-products,.super-deals,.special-offer-deal,.product-menu,.popular-deals-tabs').length > 0) {

        var lFollowX = 0,
            lFollowY = 0,
            x = 0,
            y = 0,
            friction = 1 / 30;

        function moveBackground() {
            x += (lFollowX - x) * friction;
            y += (lFollowY - y) * friction;

            //  translate = 'translateX(' + x + 'px, ' + y + 'px)';
            var translate = 'translateX(' + x + 'px) translateY(' + y + 'px)';

            $('.mouse-move-animate').css({
                '-webit-transform': translate,
                '-moz-transform': translate,
                'transform': translate
            });

            window.requestAnimationFrame(moveBackground);
        }

        $(window).on('mousemove click', function (e) {

            var isHovered = $('.animate-this:hover').length > 0;
            console.log(isHovered);

            //if(!$(e.target).hasClass('animate-this')) {
            if (!isHovered) {
                var lMouseX = Math.max(-100, Math.min(100, $(window).width() / 2 - e.clientX)),
                    lMouseY = Math.max(-100, Math.min(100, $(window).height() / 2 - e.clientY));

                lFollowX = (20 * lMouseX) / 100;
                lFollowY = (10 * lMouseY) / 100;
            }
        });

        moveBackground();
        /* my animation*/
        $(document).ready(function(){
            const chik_pice = document.querySelector(".chicken-piece");
            chik_pice.classList.add('animate__animated', 'animate__slideInLeft');
            $(".chicken-piece").css("opacity", "1");
            const mint_pice = document.querySelector(".mint-piece");
            mint_pice.classList.add('animate__animated', 'animate__slideInLeft');
            $(".mint-piece").css("opacity", "1");
            const top_banner_meta = document.querySelector(".fodo-top-banner .banner-txt-meta");
            top_banner_meta.classList.add('animate__animated', 'animate__fadeInUp');
            $(".fodo-top-banner .banner-txt-meta").css("opacity", "1");
            const botm_meta_heading = document.querySelector(".top-banner-meta .botm-meta h3");
            botm_meta_heading.classList.add('animate__animated', 'animate__bounceInLeft');
            const botm_meta_heading_del = document.querySelector(".top-banner-meta .botm-meta h3 del");
            botm_meta_heading_del.classList.add('animate__animated', 'animate__rollIn');
            const cloud_position_img = document.querySelector(".cloud-img-position img");
            cloud_position_img.classList.add('animate__animated', 'animate__fadeInLeft');
            const fodo_top_banner_img = document.querySelector(".banner-img .pizza-img");
            fodo_top_banner_img.classList.add('animate__animated', 'animate__jello');
            $(".banner-img .pizza-img").css("opacity", "1");
        });
        $(document).ready(function(){
            $(window).scroll(function() {
                var positiontop = $(document).scrollTop();
                console.log(positiontop);
                if ((positiontop > 550) && (positiontop < 900)) {
                    const services_product_img_left = document.querySelector(".services-products .product-img .left-img");
                    services_product_img_left.classList.add('animate__animated', 'animate__fadeInLeft');
                    $(".services-products .product-img .left-img").css("opacity", "1");
                    const services_product_img_center = document.querySelector(".services-products .product-img .center-img");
                    services_product_img_center.classList.add('animate__animated', 'animate__fadeInUp');
                    $(".services-products .product-img .center-img").css("opacity", "1");
                    const services_product_img_right = document.querySelector(".services-products .product-img .right-img");
                    services_product_img_right.classList.add('animate__animated', 'animate__fadeInRight');
                    $(".services-products .product-img .right-img").css("opacity", "1");
                }
                if ((positiontop > 2051) && (positiontop < 2991)) {
                    const special_offer_tomato_img = document.querySelector(".special-offer-deal .special-offer-img .tomato");
                    special_offer_tomato_img.classList.add('animate__animated', 'animate__fadeIn');
                    $(".special-offer-deal .special-offer-img .tomato").css("opacity", "1");
                    const special_offer_save_upto = document.querySelector(".special-offer-deal .special-offer-img .save-upto");
                    special_offer_save_upto.classList.add('animate__animated', 'animate__fadeInLeft');
                    $(".special-offer-deal .special-offer-img .save-upto").css("opacity", "1");
                    const special_offer_mashroom_img = document.querySelector(".special-offer-deal .top-banner-meta .mashroom");
                    special_offer_mashroom_img.classList.add('animate__animated', 'animate__fadeInUp');
                    $(".special-offer-deal .top-banner-meta .mashroom").css("opacity", "1");
                    $(".special-offer-deal .top-banner-meta").css("opacity", "1");
                    const special_offer_deal_meta = document.querySelector(".special-offer-deal .banner-txt-meta");
                    special_offer_deal_meta.classList.add('animate__animated', 'animate__fadeInRight');
                    $(".special-offer-deal .banner-txt-meta").css("opacity", "1");
                    const special_offer_botm_heading = document.querySelector(".special-offer-deal .banner-txt-meta .botm-meta  h3");
                    special_offer_botm_heading.classList.add('animate__animated', 'animate__bounceInLeft');
                    const special_offer_botm_heading_del = document.querySelector(".special-offer-deal .banner-txt-meta .botm-meta h3 del");
                    special_offer_botm_heading_del.classList.add('animate__animated', 'animate__rollIn');
                    const special_offer_burger_img = document.querySelector(".special-offer-deal .special-offer-img img");
                    special_offer_burger_img.classList.add('animate__animated', 'animate__rubberBand');
                    $(".special-offer-deal .special-offer-img img").css("opacity", "1");
                }
                if ((positiontop > 2687) && (positiontop < 3287)) {
                    const product_menu_grid_card_img_1 = document.querySelector(".product-menu .menu-grid .menu-card .img-1");
                    product_menu_grid_card_img_1.classList.add('animate__animated', 'animate__fadeInUp');
                    $(".product-menu .menu-grid .menu-card .img-1").css("opacity", "1");
                    const product_menu_grid_card_img_2 = document.querySelector(".product-menu .menu-grid .menu-card .img-2");
                    product_menu_grid_card_img_2.classList.add('animate__animated', 'animate__fadeInUp');
                    $(".product-menu .menu-grid .menu-card .img-2").css("opacity", "1");
                    const product_menu_grid_card_img_3 = document.querySelector(".product-menu .menu-grid .menu-card .img-3");
                    product_menu_grid_card_img_3.classList.add('animate__animated', 'animate__fadeInUp');
                    $(".product-menu .menu-grid .menu-card .img-3").css("opacity", "1");
                }
                if ((positiontop > 3087) && (positiontop < 3787)) {
                    const product_menu_grid_card_img_4 = document.querySelector(".product-menu .menu-grid .menu-card .img-4");
                    product_menu_grid_card_img_4.classList.add('animate__animated', 'animate__fadeInUp');
                    $(".product-menu .menu-grid .menu-card .img-4").css("opacity", "1");
                    const product_menu_grid_card_img_5 = document.querySelector(".product-menu .menu-grid .menu-card .img-5");
                    product_menu_grid_card_img_5.classList.add('animate__animated', 'animate__fadeInUp');
                    $(".product-menu .menu-grid .menu-card .img-5").css("opacity", "1");
                    const product_menu_grid_card_img_6 = document.querySelector(".product-menu .menu-grid .menu-card .img-6");
                    product_menu_grid_card_img_6.classList.add('animate__animated', 'animate__fadeInUp');
                    $(".product-menu .menu-grid .menu-card .img-6").css("opacity", "1");
                }
            });
        });

    }
    //single product js close here

    if ($('.count').length > 0) {
        $('.count').each(function () {
            "use strict";
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 4000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    }
    if ($('.doc-stuff').length > 0) {
        $('.doc-stuff').each(function () {
            "use strict";
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 8000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    }
    if ($('.fr-logo-details').length > 0) {
        $("#a").on('click', function(){
            $(".fr-logo-details").fadeToggle(1000);
        });
    }
    if ($('.fr-logo-details2').length > 0) {
        $("#b").on('click', function(){
            $(".fr-logo-details2").fadeToggle(1000);
        });
    }
    if ($('.fr-logo-details3').length > 0) {
        $("#c").on('click', function(){
            $(".fr-logo-details3").fadeToggle(1000);
        });
    }
    if ($(".preloader-site").length) {
        $(window).on('load', function () {
            $('.preloader-site').fadeOut();
        });
    }
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 300) {
            $('.scroll-top').fadeIn(300);
        } else {
            $('.scroll-top').fadeOut(300);
        }
    });
    $('.scroll-top').on('click', function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    });
    $('[data-toggle="tooltip"]').tooltip();
    $('.wp-block-archives-dropdown select, .wp-block-categories select, .blog-sidebar .widget select, .woocommerce-ordering .orderby').select2({
        width: '100%',
        theme: "classic",
    });
    var $container = $('.grid');
    $container.imagesLoaded(function () {
        $container.masonry({
            itemSelector: '.grid-item',
            percentPosition: true,
            layoutMode: 'masonry',
            transitionDuration: '0.7s',
        });
    });
    $('p:empty').remove();
    $("#forgot").on("click", function () {
        $(".sign-in").hide();
        $(".for-got").show("slide", {direction: "right"}, 1000);
    });
    $("#signup").on("click", function () {
        $(".sign-in").hide();
        $(".sign-up").show("slide", {direction: "right"}, 1000);
    });
    $("#signin").on("click", function () {
        $(".sign-up").hide();
        $(".sign-in").show("slide", {direction: "right"}, 1000);
    });
    $("#sign-back").on("click", function () {
        $(".for-got").hide();
        $(".sign-up").show("slide", {direction: "right"}, 1000);
    });
    if(typeof(foodota_strings) !== 'undefined' && foodota_strings !== null)
    {
        var user_current_lat = (localStorage.getItem("current_lat"));
        var user_current_long = (localStorage.getItem("current_long"));
        var user_current_place = (localStorage.getItem("current_place"));

        var toest_title_confirm = foodota_strings.toestor_title_confirm;
        var toest_confirm_mssage = foodota_strings.toestor_confirm_msssage;
        var toest_confirm_yes_button = foodota_strings.toestor_yes_confirm_button;
        var toest_confirm_no_button = foodota_strings.toestor_no_confirm_button;
        var toest_success_delete = foodota_strings.toestor_delete;
        var toest_success_update = foodota_strings.toestor_update;
        var toest_error = foodota_strings.toestor_error;
        var toest_opps = foodota_strings.toestor_opps;
        var toest_login_reg_success = foodota_strings.toestor_reg_login_success;
        var toest_reg_success = foodota_strings.toestor_reg_success;
        var toest_user_already = foodota_strings.toestor_user_already;
        var toest_confirm_user_location = foodota_strings.toestor_user_confirm_current_location;
        var toest_no_restaurants = foodota_strings.toestor_no_restaurant_found;
        var toest_no_restaurants_founds = foodota_strings.toestor_no_restaurant;
        var toest_login_success = foodota_strings.toestor_login_success;
        var toest_account_not_verify = foodota_strings.toestor_account_not_verified;
        var toest_user_pwd_error = foodota_strings.toestor_user_pwd_wrong;
        var toest_restaurant_favorite = foodota_strings.toestor_success_favorite;
        var toest_restaurant_unfavorite = foodota_strings.toestor_remove_favorite;
        var toest_login_for_favorite = foodota_strings.toestor_Login_for_favorite;
        var toest_token_field_empty = foodota_strings.toestor_token_field_empty;
        var toest_token_invalid = foodota_strings.toestor_invalid_code_entered;
        var toest_token_success_applied = foodota_strings.toestor_token_success_applied;
        var toest_token_login_first = foodota_strings.toestor_token_need_login;
        var google_api_key_status= foodota_strings.google_map_key_value;
        var not_permission = foodota_strings.toestor_permission_denied;

        var demo_mode_msg= foodota_strings.toestor_demo_on;
        var cart_store_msg= foodota_strings.toestor_cart_check;
        var cart_updated = foodota_strings.toestor_cart_add_item;
        var user_current_lat = (localStorage.getItem("current_lat"));
        var user_current_long = (localStorage.getItem("current_long"));
        var user_current_place = (localStorage.getItem("current_place"));
        if(google_api_key_status==1) {
            if ($('.map-show').length > 0) {
                var map_lat;
                var map_long;
                var map_lat2;
                var map_long2;
                var current_loc;
                var map_loc;
                map_lat2 = $('#m_lat').val();
                map_long2 = $('#m_long').val();
                map_loc = $('#your_loc').val();
                setmap_fun(parseFloat(map_lat2), parseFloat(map_long2), map_loc);
                initialize();

                function initialize() {
                    var input = document.getElementById('maper');
                    if(input != null) {
                        var autocomplete = new google.maps.places.Autocomplete(input);
                        google.maps.event.addListener(autocomplete, 'place_changed', function () {
                            var place = autocomplete.getPlace();
                            current_loc = document.getElementById('your_loc').value = place.name;
                            map_lat = document.getElementById('m_lat').value = place.geometry.location.lat();
                            map_long = document.getElementById('m_long').value = place.geometry.location.lng();
                            setmap_fun(map_lat, map_long, current_loc);
                        });
                    }
                }

                function setmap_fun(lati, longi, locate) {
                    const foodLatLng = {lat: lati, lng: longi};
                    const map = new google.maps.Map(document.getElementById("mapshow"), {
                        center: foodLatLng,
                        zoom: 18,
                        mapTypeId: "roadmap",
                    });
                    map.setTilt(45);
                    new google.maps.Marker({
                        position: foodLatLng,
                        map,
                        title: locate,
                    });
                }
            }
        }

        // if ($('.fav-check').length > 0) {
        //     $(document).on('click', '.fa-heart', function () {
        //         $(this).toggleClass("favorite");
        //         var res_favorite = $(this).hasClass("favorite");
        //         var store_id = $(this).attr("data-id");
        //         $.post(foodota_strings.ajax_url, {
        //             action: 'restaurant_favorite',
        //             store_ids: store_id,
        //             res_fav: res_favorite
        //         }).done(function (response) {
        //             if (true === response.success) {
        //                 check_status_fav = '';
        //                 var check_status_fav = response.data.res_fav_status;
        //                 if (check_status_fav != '') {
        //                     Notiflix.Notify.Success(toest_restaurant_favorite);
        //                 } else if (check_status_fav == '') {
        //                     Notiflix.Notify.Success(toest_restaurant_unfavorite);
        //                 }
        //             } else {
        //                 Notiflix.Notify.Failure(toest_login_for_favorite);
        //             }
        //         });
        //     });
        // }
        if ($(".food_cat_filter").length > 0) {
            var favorite = [];
            var res_price = '';
            $('input[name="sport"]').click(function () {
                $.LoadingOverlay("show");
                if ($(this).prop("checked") == true) {
                    $.each($("input[name='sport']:checked"), function () {
                        favorite.push($(this).val());
                    })
                } else if ($(this).prop("checked") == false) {
                    var itemtoRemove = $(this).val();
                    favorite = jQuery.grep(favorite, function (value) {
                        return value != itemtoRemove;
                    });
                }
                var names = favorite;
                var uniq = names
                    .map((name) => {
                        return {count: 1, name: name}
                    })
                    .reduce((a, b) => {
                        a[b.name] = (a[b.name] || 0) + b.count
                        return a
                    }, {})

                var sorted = Object.keys(uniq).sort((a, b) => uniq[a] < uniq[b])
                res_price = $('input[name="radio1"]:checked').val();
                $(".dollar-custom").removeClass("dollar-active");
                $(this).addClass("dollar-active");
                $.post(foodota_strings.ajax_url, {
                    action: 'restaurant_cat_filters',
                    res_cat_filter: sorted,
                    rec_price_range: res_price,
                    nonce: foodota_strings.nonce
                }).done(function (response) {
                    $.LoadingOverlay("hide");
                    if (true === response.success) {
                        $('#restaurant-container').html(response.data.res_filter_data);
                        $('#number-res').html(response.data.res_filter_total);
                    } else {
                        Notiflix.Notify.Failure(toest_no_restaurants_founds);
                        $('#restaurant-container').html(response.data.res_filter_data);
                        $('#number-res').html(response.data.res_filter_total);
                    }
                });
            })
            $("#reloader-fun").click(function () {
                localStorage.clear();
                location.reload();
                $('#near-input').prop('checked', false);
                $("#delivery").prop('checked', false);
                $("#pickup").prop('checked', true);

            })
        }
        if ($(".cf-off-canvas").length > 0) {
            $(document).on("click",'.openNav',function() {
                $("#mySidenav").css("width", 360);
                $("#main-order").hide("slow");
            });
            $("#closeNav").click(function () {
                $("#mySidenav").css("width", 0);
                $("#main-order").show("slow");
            })
            $(".float-right").click(function () {
                $(".res-order-box").toggle(600);
            });
        }
        if ($(".menu-tabs-list").length > 0) {
            $(document).on('click', '.menu-tabs-list', function () {
                var make_id = $(this).data('term-id');
                $(".menu-tabs-list").removeClass("active");
                $(this).addClass("active");
                $(".menu-tabs-content").hide();
                $("div.menu-tabs-content[data-tab-content-id=" + make_id + "]").show();
            });
        }

        if(google_api_key_status==1) {
            if ($(".near-btn-ul").length > 0) {
                if (user_current_lat == null) {
                    $("#near-input").on('click', function () {
                        if($(this).is(':checked')) {
                            Notiflix.Confirm.Show(toest_title_confirm, toest_confirm_user_location, toest_confirm_yes_button, toest_confirm_no_button,
                                function () {
                                    if (navigator.geolocation) {
                                        var browserSupportFlag;
                                        browserSupportFlag = true;
                                        navigator.geolocation.getCurrentPosition(function (position) {
                                            var user_current_latitude = position.coords.latitude;
                                            var user_current_longitude = position.coords.longitude;
                                            localStorage.current_lat = user_current_latitude;
                                            localStorage.current_long = user_current_longitude;
                                            var loc_dilivery = 1;
                                            if($('#delivery').is(':checked')) {
                                                loc_dilivery =2;
                                            }
                                            $.post(foodota_strings.ajax_url, {
                                                action: 'restaurant_getby_location',
                                                nonce: foodota_strings.nonce,
                                                status_loc: loc_dilivery,
                                                user_current_lat: localStorage.current_lat,
                                                user_current_lng: localStorage.current_long
                                            }).done(function (response) {
                                                $('#restaurant-container').html(response.data.nearby_restaurants);
                                                $('#number-res').html(response.data.total_restaurants);
                                            })
                                        }, function () {
                                            alert("Geolocation Failed");
                                        });
                                    }
                                },
                                function () {
                                    Notiflix.Notify.Failure(not_permission);
                                    $('#near-input').prop('checked', false);
                                    localStorage.clear();
                                })
                        }
                        else{
                            localStorage.clear();
                        }
                    });

                } else {
                    $('#near-input').prop('checked', true);
                    get_restaurants();
                }

                $("#near-input").on('click', function () {
                    if ($(this).not(':checked')) {
                        get_restaurants();
                        localStorage.clear();
                    }
                })
            }

            $("#delivery").on('click', function () {
                if($(this).is(':checked')) {
                    $("#pickup").attr('checked', false);
                    var loc_dilivery = 3;
                            if($("#near-input").prop('checked') == true){
                                loc_dilivery =2;
                            }
                          if($("#near-input").prop('checked') == false){
                           loc_dilivery =3;
                            }
                                $.post(foodota_strings.ajax_url, {
                                    action: 'restaurant_getby_location',
                                    nonce: foodota_strings.nonce,
                                    status_loc: loc_dilivery,
                                    user_current_lat: localStorage.current_lat,
                                    user_current_lng: localStorage.current_long
                                }).done(function (response) {
                                    $('#restaurant-container').html(response.data.nearby_restaurants);
                                    $('#number-res').html(response.data.total_restaurants);
                                })
                }
            });

            $("#pickup").on('click', function () {
                if ($(this).is(':checked')) {
                    $("#pickup").attr('checked', false);
                    $('#near-input').prop('checked', false);
                    localStorage.clear();
                    location.reload();
                }
            })

            function get_restaurants() {
                var filter_by = $('input[name="radio1"]:checked').val();
                var loc_dilivery =1;
                if($('#delivery').is(':checked')) {
                    loc_dilivery =2;
                }
                $.post(foodota_strings.ajax_url, {
                    action: 'restaurant_getby_location',
                    nonce: foodota_strings.nonce,
                    status_loc:loc_dilivery,
                    user_current_lat: user_current_lat,
                    user_current_lng: user_current_long
                }).done(function (response) {
                    if (true === response.success) {
                        $('#restaurant-container').html(response.data.nearby_restaurants);
                        $('#number-res').html(response.data.total_restaurants);
                    } else {
                        Notiflix.Notify.Failure(toest_no_restaurants);
                    }
                })
            }
        }

        if ($(".product-quantity").length > 0) {
            //('.product-quantity').on('change', function(){
            $(document).on("change",'.product-quantity',function() {
                var product_id = $(this).val();
                $(this).parent().find("button.product-quantity-btn").attr('data-quantity', product_id);
                var quantity = $(this).parent().find("button.product-quantity-btn").data('quantity');
            });
        }
        $(document).on('change', '.quantity input', function () {
            var item_key = $(this).attr('name').replace(/cart\[([\w]+)\]\[qty\]/g, "$1");
            var item_quantity = $(this).val();
            var currentVal = parseFloat(item_quantity);
            $.ajax({
                type: 'POST',
                url: foodota_strings.ajax_url,
                data: {
                    action: 'update_item_from_cart',
                    item_key: item_key,
                    quantity: currentVal
                },
                success: function (response) {
                    $(".sidenav").LoadingOverlay("show");
                    $('.cart-count').html(response.data.res_filter_data);
                    $(".sidenav").LoadingOverlay("hide");
                }
            });

        });
        $(document).on('click', '.counter .text-danger', function () {
            var product_id = $(this).attr("data-product_id");
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: foodota_strings.ajax_url,
                data: {
                    action: "product_remove",
                    product_id: product_id
                }, success: function (response) {
                    $(".sidenav").LoadingOverlay("show");
                    $('.cart-count').html(response.data.res_filter_data);
                    $(".sidenav").LoadingOverlay("hide");
                }
            });
            return false;
        })
        $(document).ready(function () {
            $(document).on('submit', '.counter .woocommerce-cart-form', function (e) {
                e.preventDefault();
                var code = $('input#coupon_code').val();
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: foodota_strings.ajax_url,
                    data: {
                        action: "spyr_coupon_redeem_handler",
                        coupon_code: code
                    }, success: function (response) {
                        if (true === response.success) {
                            $(".sidenav").LoadingOverlay("show");
                            Notiflix.Notify.Success(toest_token_success_applied);
                            $('.cart-count').html(response.data.res_filter_data);
                            $(".sidenav").LoadingOverlay("hide");
                        } else {
                            if (response.data.result === "isempty") {
                                $(".sidenav").LoadingOverlay("show");
                                Notiflix.Notify.Failure(toest_token_field_empty);
                                $(".sidenav").LoadingOverlay("hide");
                            } else if (response.data.result === "isinvalid") {
                                $(".sidenav").LoadingOverlay("show");
                                Notiflix.Notify.Failure(toest_token_invalid);
                                $(".sidenav").LoadingOverlay("hide");
                            }
                        }
                    }
                });
                return false;
            });
        });
        if ($('.res-fl-center-container').length > 0) {
            $(document).on("click",'.menu-tabs-list',function() {
                var term_id = $(this).data("term-id");
                var store_ids = $(this).data("store-id");
                var level_ids = $(this).data("level-id");
                var have_child = $(this).data("child-id");
                var slider_container =   ".cat_slider_" + term_id;
                if(have_child==0){
                    $('.sub_cat_level_1').remove();
                    $('.sub_cat_level_2').remove();
                    $('.sub_cat_level_3').remove();
                    $('.sub_cat_level_4').remove();
                    return false;
                }
                $.LoadingOverlay("show");
                if (level_ids == 0) {
                        $('.sub_cat_level_1').remove();
                        $('.sub_cat_level_2').remove();
                        $('.sub_cat_level_3').remove();
                        $('.sub_cat_level_4').remove();
                    }
                    if (level_ids == 1) {
                        $('.sub_cat_level_2').remove();
                        $('.sub_cat_level_3').remove();
                        $('.sub_cat_level_4').remove();
                    }
                    if (level_ids == 2) {
                        $('.sub_cat_level_3').remove();
                        $('.sub_cat_level_4').remove();
                    }
                    if (level_ids == 3) {
                        $('.sub_cat_level_4').remove();
                    }
                    if ($(slider_container).length > 0) {
                        $(slider_container).remove();
                    }
                    if (term_id != null) {
                        $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: foodota_strings.ajax_url,
                            data: {
                                action: 'term_child_action',
                                term_ids: term_id,
                                store_ides: store_ids
                            },
                            success: function (response) {
                                $.LoadingOverlay("hide");
                                if (true === response.success) {
                                    $(".food-cats-child").append(response.data.childbuttom);
                                    $(".tab-child").html(response.data.tabhtml);
                                    if(level_ids==0){
                                        $(".tab-child").empty();
                                    }
                                    if (response.data.childbuttom != undefined && response.data.childbuttom != "") {
                                        var slider_container = ".cat_slider_" + term_id;
                                        if (slider_container.length > 0) {
                                            $(slider_container).owlCarousel({
                                                margin: 10,
                                                autoplay: false,
                                                nav: true,
                                                responsive: {
                                                    0: {
                                                        items: 2
                                                    },
                                                    500: {
                                                        items: 3
                                                    },
                                                    700: {
                                                        items: 4
                                                    },
                                                    1000: {
                                                        items: 3
                                                    }
                                                }
                                            })
                                        }

                                    }
                                    jQuery('.variations_form').each(function () {
                                        jQuery(this).wc_variation_form();

                                    });
                                    if (response.data.childstatus == null || response.data.childstatus == '') {
                                        Notiflix.Notify.Failure("Subcategories Not Found");

                                    }
                                }
                            }
                        })
                    }
            });
        }


        $(document).ready(function ($) {
                $(document).on("click",'.order-modal .single_add_to_cart_button',function(e) {
                e.preventDefault();
                var $thisbutton='';
                var $form='';
                $thisbutton = $(this),
                    $form = $thisbutton.closest('.order-modal form.cart');
                var my_val = $form.serialize();
                var data = {
                    action: 'ql_woocommerce_ajax_add_to_cart', my_val
                };
                $.ajax({
                    type: 'post',
                    url: foodota_strings.ajax_url,
                    data: data,
                    beforeSend: function (response) {
                        $thisbutton.removeClass('added').addClass('loading');
                    },
                    complete: function (response) {
                        $thisbutton.addClass('added').removeClass('loading');
                    },
                    success: function (response) {
                        if (response.error & response.product_url) {
                            window.location = response.product_url;
                            return;
                        } else {
                            $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                        }
                    },
                });
            });
        });

        if ($('input[name=recipe]').length > 0) {
            $('input[name=recipe]').keypress(function () {
                var spinner_html_ = '<span class="foodota-search-spinner"><i class="fa fa-spinner spin"></i></span>';
                if ($(this).after(spinner_html_)) {
                }
                $(this).after(spinner_html_);
            });
        }
        $('input[name=recipe]').typeahead({
            minLength: 1,
            delay: 250,
            scrollBar: true,
            autoSelect: true,
            fitToElement: true,
            highlight: false,
            hint: true,
            source: function (query, process) {
                return $.get(foodota_strings.ajax_url, {query: query, action: 'recipe_suggestions'}, function (data) {
                    $('.foodota-search-spinner').remove();
                    data = $.parseJSON(data);
                    return process(data);
                });
            }
        });
        if(google_api_key_status==1) {
            if ($('.location-search .recipe-search2').length > 0) {
                initialize();
                function initialize() {
                    var input = '';
                    input = document.getElementById('search2');
                    if(input !== null){
                       var autocomplete = new google.maps.places.Autocomplete(input);
                        google.maps.event.addListener(autocomplete, 'place_changed', function () {
                            var place = autocomplete.getPlace();
                            current_loc = place.name;
                            map_lat = place.geometry.location.lat();
                            map_long = place.geometry.location.lng();
                            var user_current_latitude = place.geometry.location.lat();
                            var user_current_longitude = place.geometry.location.lng();
                            localStorage.current_lat = user_current_latitude;
                            localStorage.current_long = user_current_longitude;
                        });
                    }


                }
            }
        }
        if(google_api_key_status==1) {
            if ($("#loc-icon").length > 0) {
                if (user_current_place == null) {
                    $("#loc-icon").click(function () {
                        Notiflix.Confirm.Show(toest_title_confirm, toest_confirm_user_location, toest_confirm_yes_button, toest_confirm_no_button,
                            function () {
                                if (navigator.geolocation) {

                                  var browserSupportFlag = true;
                                    navigator.geolocation.getCurrentPosition(function (position) {
                                        var user_current_latitude = position.coords.latitude;
                                        var user_current_longitude = position.coords.longitude;
                                        localStorage.current_lat = user_current_latitude;
                                        localStorage.current_long = user_current_longitude;
                                        displayLocation(user_current_latitude, user_current_longitude);
                                    }, function () {
                                        alert("Geolocation Failed");
                                    });
                                }
                            },
                            function () {
                                Notiflix.Notify.Failure(toest_opps);
                                $("#delivery").attr('checked', false);
                            })
                    })
                } else {
                    $("#delivery").attr('checked', 'checked');
                    document.getElementById('search2').value = user_current_place;
                    get_restaurants();
                }
            }
        }

        function displayLocation(latitude, longitude) {
                        if (google_api_key_status == 1) {
                            var geocoder;
                            geocoder = new google.maps.Geocoder();
                            var latlng = new google.maps.LatLng(latitude, longitude);
                            geocoder.geocode(
                                {'latLng': latlng},
                                function (results, status) {
                                    if (status == google.maps.GeocoderStatus.OK) {
                                        if (results[0]) {
                                            var add = results[0].formatted_address;
                                            localStorage.current_place = add;
                                            document.getElementById('search2').value = localStorage.current_place;
                                            var value = add.split(",");
                                           var count = value.length;
                                            var country = value[count - 1];
                                           var state = value[count - 2];
                                            var city = value[count - 3];
                                        } else {
                                            x.innerHTML = "address not found";
                                        }
                                    } else {
                                        x.innerHTML = "Geocoder failed due to: " + status;
                                    }
                                }
                            );
                    }
                  }
        if ($(".right-space").length > 0) {
            $('.header-form select').on('change', function(){
                $(this).closest('form').submit();
            });
        }
        function doBounce(element, times, distance, speed) {
            var i;
            for (i = 0; i < times; i++) {
                $(element.animate({marginLeft: '-=' + distance}, speed)
                    .animate({marginLeft: '+=' + distance}, speed));
            }
        }

        if ($(".res-pric-tble").length > 0) {
            $('.price-action').on('click', function(){
                $.LoadingOverlay("show");
                Notiflix.Notify.Failure(toest_token_login_first);
                $.LoadingOverlay("hide");

            });
        }

        if ($(".sidenav").length > 0) {
            $('.order-btn').on('click', function () {
                var product_id = $(this).data("product_id");
                var store_id = $(this).data("store_id");
                if (store_id != null) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: foodota_strings.ajax_url,
                        data: {
                            action: "cart_checker",
                            store_id: store_id,
                            product_id: product_id
                        }, success: function (response) {

                            if (true === response.success) {
                                $('.res-modal-content').modal('hide')
                                Notiflix.Notify.Failure(cart_store_msg);
                            } else {
                                Notiflix.Notify.Success(cart_updated);
                            }

                        }
                    });

                }
            });
        }
    }

        if ($(".res-fl-main-cat").length > 0) {
           $(document).on("click",'.read_more',function(e) {
               $(this).parent().css("display", "none");
               $(this).parents('.res-fl-main-cat').find('.long-des').show();
            })
            $(document).on("click",'.read_less',function(e) {
                $(this).parent().css("display", "none");
                $(this).parents('.res-fl-main-cat').find('.short-des').show();
            })
        }




        })(jQuery);
