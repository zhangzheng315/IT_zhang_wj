$(function(){
$('.hh-d dl').bind('mouseenter', function () {
	$(this).addClass('on').siblings().removeClass('on');
});
$('.mbanner-c-b em').click(function () {
	$(".mbanner-c-b-tbox").fadeIn(200);
});
$('.mbanner-c-b-close').click(function () {
	$(".mbanner-c-b-tbox").fadeOut(200);
});
});

var tabsSwiper = new Swiper('.swiper-hhbb',{
    speed:500,
	on: {
    slideChangeTransitionStart: function(){
      $(".hh-baula .on").removeClass('on')
      $(".hh-baula li").eq(tabsSwiper.activeIndex).addClass('on')  
    },
  },
      navigation: {
        nextEl: '.swiper-hhbb-next',
        prevEl: '.swiper-hhbb-prev',
      },
  })
  $(".hh-baula li").on('click',function(e){
    e.preventDefault()
    $(".hh-baula .on").removeClass('on')
    $(this).addClass('on')
    tabsSwiper.slideTo( $(this).index() )
  })
  $(".hh-baula li").click(function(e){
    e.preventDefault()
  })
  
    var swiper2 = new Swiper('.swiper-hhfb', {
      pagination: {
        el: '.swiper-paghhfb',
	    clickable: true,
		renderBullet: function (index, className) {
          return '<span class="' + className + '">0' + (index + 1) + '</span>';
        },
      },
	  speed:1000,
      navigation: {
        nextEl: '.swiper-hhfb-next',
        prevEl: '.swiper-hhfb-prev',
      }
    });
