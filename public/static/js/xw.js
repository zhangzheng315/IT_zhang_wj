    $(function(){

        $('.banner-carousel').owlCarousel({
            items: 1,
            autoPlay: 3000,
            itemsMobile : [479, 1],
            itemsTablet : [768, 1],
            itemsDesktopSmall : [979, 1],
            itemsDesktop : [1199, 1]
        });

        $('.wbanner-carousel').owlCarousel({
            items: 1,
            autoPlay: 3000,
            pagination : false,
            itemsMobile : [479, 1],
            itemsTablet : [768, 1],
            itemsDesktopSmall : [979, 1],
            itemsDesktop : [1199, 1]
        });


		$('.case-carousel').owlCarousel({
			items: 4,
			autoPlay: false,
			pagination : false,
			itemsMobile : [479, 2],
			itemsTablet : [768, 3],
			itemsDesktopSmall : [979, 4],
			itemsDesktop : [1199, 4],
			navigation: true,
			navigationText:['','']
		});

        $('.partner-carousel').owlCarousel({
            items: 6,
            autoPlay: 3000,
            pagination : false,
            itemsMobile : [479, 3],
            itemsTablet : [768, 4],
            itemsDesktopSmall : [979, 5],
            itemsDesktop : [1199, 6]
        });


	});


    $(function(){

		$('.nav-wrap .nav-ul .navlist').hover(function() {
			$(this).find('.listh1').addClass('on');
			$(this).find('.list2-ul').css('display', 'block'); 
		}, function() {
			$(this).find('.listh1').removeClass('on');
			$(this).find('.list2-ul').css('display', 'none'); 
		});
		 $('.list2-ul .list').hover(function() {
		 	$(this).find('.listh2').addClass('on');
		 	$(this).find('.list3-ul').css('display', 'block');
		 }, function() {
		 	$(this).find('.listh2').removeClass('on');
		 	$(this).find('.list3-ul').css('display', 'none');
		 });

		$(".header-wrap .menu").click(function(){
		  $(".menulist").slideToggle();
		});

		$(".header-wrap .searchbox .searchicon").click(function(){
			$('.header-wrap .searchbox .sbox').toggle();
		});


	    $(".content-wrap .contentbox .ltside .link-wrap .list").click(function(){
			if($(this).hasClass('on1')){
				$(this).removeClass('on1').addClass('on');
			}else{
				$(this).removeClass('on').addClass('on1');
			}
			$(this).next(".contentbox .list2").slideToggle(500);
		});

		$(".hotpro-wrap .ltside .link-wrap .list").click(function(){
			if($(this).hasClass('on1')){
				$(this).removeClass('on1').addClass('on');
			}else{
				$(this).removeClass('on').addClass('on1');
			}
			$(this).next(".hotpro-wrap .list2").slideToggle(500);
		});


	    $(".tit-show").click(function () {
	        $(this).next("div").slideToggle("slow").siblings(".div1:visible").slideUp("slow");
	    });

	    $(".div2").click(function () {
	        $(this).next("div").slideToggle("slow").siblings(".div3:visible").slideUp("slow");
	    });

		$('.video-wrap .video-con .tabhd .thdlist a:first').addClass('active');
		$('.video-wrap .video-con .tabhd .thdlist').click(function () {
			$(this).find('a').addClass('active');
			$(this).siblings().find('a').removeClass('active');
			var index = $(this).index();
			$('.video-wrap .video-con .tabbd .tbdlist').eq(index).show().siblings().hide();
            $('.video-wrap .video-con .tabbd .tbdlist').eq(index).find('.videoboxxx').trigger('play').siblings().find('.videoboxxx').trigger('pause');;
		});


        $('.news-wrap .tabhd .thdlist a:first').addClass('active');
        $('.news-wrap .tabhd .thdlist').hover(function () {
            $(this).find('a').addClass('active');
            $(this).siblings().find('a').removeClass('active');
            var index = $(this).index();
            $('.news-wrap .tabbd .tbdlist').eq(index).show().siblings().hide();
        });

		jQuery(".txtMarquee-top").slide({mainCell:".bd ul",autoPlay:true,effect:"topMarquee",vis:3,interTime:50});

        jQuery(".partner-wrap .picMarquee-left").slide({mainCell:".bd ul",autoPlay:500,effect:"leftMarquee",vis:6,interTime:20});

		$(".backbtn a").click(function () {
			var speed=1000;//滑动的速度
			$('body,html').animate({ scrollTop: 0 }, speed);
			return false;
		});


		//焦点图功能，用到SuperSlide插件
        jQuery(".w3cFocus").slide({ mainCell:".bd ul", effect:"left", delayTime:100, autoPlay:4000,interTime:2000,mouseOverStop:false, pageStateCell:".pageState" });

        jQuery(".picMarquee-top").slide({mainCell:".bd ul",autoPlay:true,effect:"topMarquee",vis:3,interTime:50});

		//按钮位移函数
		function moveBtn(){
			var prev=jQuery(".w3cFocus .prev");
			var next=jQuery(".w3cFocus .next");

			/*var body_w = document.body.clientWidth;
			var side_w = (body_w - 960) / 2 -50;

			if(body_w < 1080)
			{
				prev.animate({"left":30, "opacity":1});
				next.animate({"right":30, "opacity":1});
			}
			else
			{
				prev.animate({"left":side_w, "opacity":1});
				next.animate({"right":side_w, "opacity":1});
			}*/
		}
		moveBtn();

		//拉伸浏览器时触发，为了适应不同浏览设备
		jQuery(window).resize(function(){moveBtn();});

        $(".maximg img").css({
            "max-width": "100%"
        });

        $(".talert-con .tabbox").click(function(){
            if($(this).find('a').hasClass('on1')){
                $(this).find('a').removeClass('on1').addClass('on');
            }else{
                $(this).find('a').removeClass('on').addClass('on1');
            }
            $(this).find('.tbdlist').slideToggle(500);
        });







	});

$(function(){

	function aaa (){
		var imgs = $(".imgs").width();
		$(".imgs").css({"height":imgs *.45+"px","line-height":imgs*.45+"px"})
	};
	aaa();
	$(window).resize(function(){
		aaa();
	});



	function eee (){
		var imgs = $(".imgss").width();
		$(".imgss").css({"height":imgs *.65+"px","line-height":imgs *.65+"px"})
	};
	eee();
	$(window).resize(function(){
		eee();
	});

	function ccc (){
		var imgs = $(".cimg").width();
		$(".cimg").css({"height":imgs *.7+"px","line-height":imgs *.7+"px"})
	};
	ccc();
	$(window).resize(function(){
		ccc();
	});


})