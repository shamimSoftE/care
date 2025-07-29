$(function () {
  'use strict';

  // Menu fix
  var navtop = $('.main_menu').offset().top;
  $(window).scroll(function () {

    var navscroll = $(this).scrollTop();

    if (navscroll > navtop) {
      $('.main_menu').addClass('fix_nav');
    } 
    else {
      $('.main_menu').removeClass('fix_nav');
    }
  });

  // Bact to Top
  $('.backtotop').click(function () {

    $('html,body').animate({
      scrollTop: 0,
    }, 3000);

  });

  // Popup

  $('.pop_close').on('click', function () {
      $('.pop_up').fadeOut();
  });

  $(window).scroll(function () {

    var scrolltop = $(this).scrollTop();

    if (scrolltop > 200) {

      $('.backtotop').addClass('fix_backtotop');

      $('.backtotop').fadeIn('fix_backtotop');

    } else {

      $('.backtotop').removeClass('fix_backtotop');

      $('.backtotop').fadeOut('fix_backtotop');

    }
  });

  // venobox
  $('.venobox').venobox();

  // Slick Slider
  $('.slider_content').slick({
    dots: false,
    infinite: false,
    speed: 300,
    arrows: false,
    autoplay: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: false,
          dots: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  $('.customer-review-slider').slick({
    dots: true,
    infinite: false,
    speed: 300,
    arrows: true,
    autoplay: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    nextArrow: '<i class="fas fa-chevron-right nxt_arr"></i>',
    prevArrow: '<i class="fas fa-chevron-left pre_arr"></i>',
    responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: false,
          dots: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  $('.blog-slider').slick({
    dots: false,
    infinite: true,
    speed: 300,
    arrows: true,
    autoplay: true,
    slidesToShow: 4,
    slidesToScroll: 4,
    nextArrow: '<i class="fas fa-chevron-right nxt_arr"></i>',
    prevArrow: '<i class="fas fa-chevron-left pre_arr"></i>',
    responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: false,
          dots: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  // CounterUp
  $('.countup_fun').counterUp({
    delay: 10,
    time: 1000
  });




});