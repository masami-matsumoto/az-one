$(function() {
	$('#tabs a[href^="#archives"]').click(function(){
		$("#tabs .panel").hide();
		$(this.hash).fadeIn();
		$ ("a").removeClass("active");
		$ (this).addClass("active");
		return false;
	});
	//わざと1つ目を表示させておくことができます
	$('#tabs a[href^="#archives"]:eq(0)').trigger('click');
	var commonServiceList = $('#common_service_list ul').height() + 20;
	$('#common_service_list p').css('height' ,commonServiceList);
  $('.f_titleSp').click(function(){
		$(this).children('span').toggleClass('listActive');
		$(this).next('ul').slideToggle();
	});
	var tickerHeight = $('.ticker ul li').height();
	$('.ticker').css('height' ,tickerHeight);
	$('#plusBtn').click(function(){
		$(this).next('ul').addClass('serviceModal');
		$('.serviceModalList').tile(2);
	});
	$('#serviceModalCloseBtn').click(function(){
		$('#common_service_list ul').removeClass('serviceModal');
	});
	
	//ハンバーガーメニュー
	$('#hamburgerBtn').on('click', function() {
		$(this).toggleClass('open');
		var openclose = $(this).hasClass('open') ? 'Close' : 'Open';
		$(this).attr("title", openclose + ' Menu');
		$('#nav_spNav').slideToggle();
	});
	//ハンバーガーメニュー
	$('#hamburgerBtnSp').on('click', function() {
		$(this).toggleClass('open');
		var openclose = $(this).hasClass('open') ? 'Close' : 'Open';
		$(this).attr("title", openclose + ' Menu');
		$('#nav_spNavSp').slideToggle();
	});
});

