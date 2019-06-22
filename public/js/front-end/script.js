$(window).on("load", function () {
  $('.preloader').fadeOut('slow');
});

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

new WOW().init();

$(function () {
  moment.locale('th');
  $('#datetime').html(moment().format('LLLL'));
})

jQuery(window).scroll(function(){
  if (jQuery(this).scrollTop() > 300) {
    jQuery('.scroll-to-top').fadeIn();
  } else {
    jQuery('.scroll-to-top').fadeOut();
  }
});

jQuery('.scroll-to-top').click(function(){
  jQuery('html, body').animate({scrollTop : 0},800);
  return false;
});

$(function () {
  $('[data-toggle="popover"]').popover()
})