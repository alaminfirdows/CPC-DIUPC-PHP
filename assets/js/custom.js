if($('.menu').length){
  // grab the initial top offset of the navigation 
  var stickyNavTop = $('.menu').offset().top;
  // our function that decides weather the navigation bar should have "fixed" css position or not.
  var stickyNav = function(){
    var scrollTop = $(window).scrollTop(); // our current vertical position from the top
    // if we've scrolled more than the navigation, change its position to fixed to stick to top,
    // otherwise change it back to relative
    if (scrollTop > stickyNavTop) { 
        $('.menu').addClass('sticky');
        $('.top_menu_wrap').css({
        'margin-top': '61px'
});
    } else {
        $('.menu').removeClass('sticky');
        $('.top_menu_wrap').css({
        'margin-top': '0px'
});
    }
  };
  stickyNav();
  // and run it again every time you scroll
  $(window).scroll(function() {
      stickyNav();
  });
}

/*--------Mobile Menu Script--------*/
$('#mobile_menu').on('click', function() {
    if ($(window).width() <= 991) {
        $('.navigation>ul').slideToggle('normal');
    }
});

if ($(window).width() >= 991) {
  $('.navigation>ul').css({
    'display': 'block'
});
}

/*--------Mobile Menu Script--------*/
$('#mobile_more').on('click', function() {
    if ($(window).width() <= 991) {
        $('.top_menu_wrap').slideToggle('normal');
    }
});

/* Internal Scroll */

$(document).on('click', '.menu-item', function(event) {
  event.preventDefault();
  var target = $(this).attr("href");
  var url = target.substr(target.indexOf("#"));

  $('html, body').animate({
      scrollTop: $( url ).offset().top - 59
  }, 1000);
});
/*-----------------------------------------------------------------------------------*/
/* Internal Scroll */
$(document).ready(function(){
    $("#old_team_show").click(function(){
        $("#old_team").toggle(700);
    });
});
/*-----------------------------------------------------------------------------------*/