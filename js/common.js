$(document).ready(function(){



// common
var ww_org = $(window).width();
var wh_org = $(window).height();
var ww = $(window).width();
var wh = $(window).height();
var dw = $(document).width();
var dh = $(document).height();
var headerH = $('header').height();
var scrollY = $(window).scrollTop();



// spメニューのカレント表示
if($('article#message').length){
	$('.gnav .message').addClass('current');
} else if($('article#identity').length){
	$('.gnav .identity').addClass('current');
} else if($('article#overview').length){
	$('.gnav .overview').addClass('current');
} else if($('article#asset').length){
	$('.gnav .asset').addClass('current');
} else if($('article#reason').length){
	$('.gnav .reason').addClass('current');
} else if($('article#information').length){
	$('.gnav .information').addClass('current');
} else if($('article#contact').length){
	$('.gnav .contact').addClass('current');
}



// 画像ポップアップ
$('[data-fancybox]').fancybox({
	toolbar: true,
	buttons : [
		'close'
	],
	iframe : {
		css : {
			width : '900px'
		}
	}
});




// anchor
$('a[href^="#"].anchor').on('click', function(){
	ww = $(window).width();
	headerH = $('header').height();
	var speed = 800;
	var href= $(this).attr('href');
	var target = $(href == '#' || href == '' ? 'html' : href);
	if(ww<=960){
		var position = target.offset().top - headerH - (ww*0.03);
	}else{
		var position = target.offset().top - headerH -20;
	}
	$('body,html').animate({scrollTop:position}, speed, 'easeInQuart');
	return false;
});



// pagetop
function btnPagetop(){
	if($(window).scrollTop() > 100) {
		$('.btn_pagetop').stop().fadeIn();
	} else {
		$('.btn_pagetop').stop().fadeOut();
	}
}
btnPagetop();



// spmenu
$('header .btn_nav a').click(function() {
	$('header nav.gnav').slideToggle(400);
	$('header .btn_nav a .icon').toggleClass('close');
	return false;
});
$('header nav.gnav a').click(function() {
	ww = $(window).width();
	if (ww <= 640) {
		$('header nav.gnav').css({'display':'none'});
	}
	$('header .btn_nav a .icon').removeClass('close');
});
$('header h1 a').click(function() {
	ww = $(window).width();
	if (ww <= 640) {
		$('header nav.gnav').css({'display':'none'});
	}
	$('header .btn_nav a .icon').removeClass('close');
});
function navVisibly() {
	ww = $(window).width();
	if (ww > 960){
		$('header .btn_nav').css({'display':'none'});
		$('header .btn_nav a .icon').removeClass('close');
		$('header nav.gnav').css({'display':'block'});
	} else {
		$('header .btn_nav').css({'display':'block'});
		$('header .btn_nav a .icon').removeClass('close');
		$('header nav.gnav').css({'display':'none'});
	}
}



// invew
$('.hoge').on('inview', function(event, isInView){
	if(isInView){
		$('.hoge').each(function(i){
			$(this).delay(i * 300).queue(function(next) {
				$(this).addClass('hoge');
				next();
			});
		});
	} else {
	}
});



// tableの見出し固定
if($('.stickytable').length){
	$('.stickytable').tableHeadFixer({'left' : 1, 'head' : false});
}



// 展覧会スケジュール開閉ボタン
$(document).on({
	'click': function(){
		$(this).parent().parent().children('.text').css({'display':'block'});
		$(this).toggleClass('btn_close');
		$(this).toggleClass('btn_open');
		return false;
	}
}, 'a.btn_open');
$(document).on({
	'click': function(){
		$(this).parent().parent().children('.text').css({'display':'none'});
		$(this).toggleClass('btn_close');
		$(this).toggleClass('btn_open');
		return false;
	}
}, 'a.btn_close');



// 英語ページサイドメニュー開閉ボタン
$(document).on({
	'click': function(){
		ww = $(window).width();
		if (ww <= 960){
			$(this).siblings('ol').slideToggle();
			$(this).toggleClass('close');
			$(this).toggleClass('open');
			return false;
		}
	}
}, 'body#english #contents #subcolumn #sidemenu a.open');
$(document).on({
	'click': function(){
		ww = $(window).width();
		if (ww <= 960){
			$(this).siblings('ol').slideToggle();
			$(this).toggleClass('close');
			$(this).toggleClass('open');
			return false;
		}
	}
}, 'body#english #contents #subcolumn #sidemenu a.close');



// 展覧会詳細開ボタン
$(document).on({
	'click': function(){
		$(this).parent().hide();
		$(this).parent().next().fadeIn();
		return false;
	}
}, 'body#exhibition .exhibition_btn a');



jQuery.event.add(window,'load',function() {
	// URLに?id=hogeをつけてリンク後アンカーでスクロール
	var url = $(location).attr('href');
	if (url.indexOf("?id=") == -1) {
	}else{
		ww = $(window).width();
		headerH = $('header').height();
		var url_sp = url.split("?id=");
		var hash = '#' + url_sp[url_sp.length - 1];
		var target = $(hash);
		if(ww<=960){
			var position = target.offset().top - headerH - (ww*0.03);
		}else{
			var position = target.offset().top - headerH -20;
		}
		$('body,html').animate({scrollTop:position}, 800, 'easeInQuart');
	}
});



$(window).resize(function() {

	navVisibly();

});


var $scrollTimer = false;
$(window).scroll(function(){
	btnPagetop();
	scrolly = $(window).scrollTop();
	if ($scrollTimer !== false) {
		clearTimeout($scrollTimer);
	}
	$scrollTimer = setTimeout(function() {
	}, 50);
});



// swiper
var swiper_home = new Swiper('.swiper-container', {
	slidesPerView: 2,
	slidesPerGroup: 2,
	spaceBetween: 10,
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},
});



});