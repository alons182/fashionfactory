
$(function () {
	
	 var html      = $('html'),
		 body      = $('body'),
		 main      = $('.main'),
		 loading      = $('.loading-container'),
		 menu      = $('.menu'),
		 btnMovil  = $('#btn_mobile'),
		 btnSearch     = $('.search'),
		 section_left     = $('.section-left'),
		 main_image = $('div').hasClass('main-image')
		 page = false,
		 $easyzoom = '',
		 api = '';

		loading.show();
	 $(window).load(function() {
		    body.removeClass('loading');
			body.addClass('loaded');
			loading.hide();
			main.css({
				opacity:1
			});

			if(main.children('div').first().hasClass('page'))
			{
				page =  true;
				imageUrl = $('.section-bg').data('bg');
				body.css('background-image', 'url(' + imageUrl + ')' );
			}

			
			$easyzoom = $('.easyzoom').easyZoom();
	 		api = $easyzoom.data('easyZoom');
			
			
			resizes();

			
		 
		});
	 		
	
		// NAV MOBILE
		btnMovil.click(function(e){
			e.preventDefault();
			
			html.toggleClass('open-menu');
		   
		});

		btnSearch.click(function(e){
			e.preventDefault();

			html.toggleClass('open-search');
		   
		});

		
		$('.carousel').contentcarousel({
			wheel : 3,
			nav   : 3
		});
	    $('.related-products').contentcarousel();
		 
		setTimeout(function(){
	        $('.flash-message').fadeOut();
	    }, 3000);


		
	   
		$(window).resize(resizes); 

		  

		function resizes()
		 {
			
			var width_section = 0;

			if($(window).width() < 768){
				if(api)
					api.teardown();
				$('.easyzoom a').on('click', function(event) {event.preventDefault();}); 
			}else
			{
				$easyzoom = $('.easyzoom').easyZoom();
	 		    api = $easyzoom.data('easyZoom');
			}
				

			if($(window).width() < 980){
				width_section = 0;
			}else{
				width_section = section_left.width();
				
			}
			 if($(window).width() > 1200 && page){
				//debugger
				width_section = section_left.width() + 300;
			 }
			  if($(window).width() > 1366 && page){

				width_section = section_left.width() + 500;
			 }

			height_dispo = getWindowHeight();
			width_dispo = getWindowWidth() - (width_section);
		   
			$('.main').width(width_dispo);
			$('.carousel').height(height_dispo);
		    $('.map-location').width(width_dispo).height(height_dispo);

		    
			
			$('.category_item').find('.category-image').height(height_dispo);
			$('.productdetails').find('.main-image').height(height_dispo);

			ResizeImageContainer($('.category-image'));
			
			if(main_image == true)
				ResizeImageContainer($('.main-image'));
		  
		  
		 }

		 //PORTAFOLIO CATEGOIRES
		 

	   /* var cat_width = 400;
		var w_height = $(window).height();
			$('.parent_category').css({
				width:cat_width + 'px',
				height:w_height+'px'
			});*/

			$('.inner-element').each(function(){
				var top_pos = ($(this).height() - 100)/2;
				$(this).find('.category-view').css({
				   top: top_pos +'px'
				});
			});

			//ResizeImageContainer($('.parent_category'));



		var resizeTimer = null;
		$(window).bind('load resize', function() {
			if (resizeTimer) clearTimeout(resizeTimer);
			resizeTimer = setTimeout("portafolio_init("+"300)", 100);
		});
		var $container = $('.portafolio');
		$container.find('.element').css({opacity: 0});
		$container.imagesLoaded( function(){
			$container.find('.element').css({opacity: 1});
			$container.isotope({
				itemSelector : '.element',
				layoutMode: 'masonry'
				/*sortBy: 'order',
				sortAscending: true,
				getSortData: {
					order: function($elem){
						var _order = $elem.hasClass('element') ?
							$elem.attr('data-order'):
							$elem.find('.order').text();
						return parseInt(_order);
					}
				}*/

			});
			portafolio_init('300');
		});


		//GALLERY IMG CLICK

		$('.additional-images').find('img').on('click',function(){
			
			//console.log($(this).attr('src'));
			$('.main-image').find('a').attr('href', $(this).data('src')).find('img').attr('src', $(this).data('src'));
			
			api.swap($(this).data('src'), $(this).data('src'))
			
			//resizes();
			if(main_image == true)
				ResizeImageContainer($('.main-image'));
			
		});



	
});


 function portafolio_init(defaultwidth){
			var contentWidth    = $('.portafolio').width();
			var columnWidth     = defaultwidth;
			var curColCount     = 0;
			var maxColCount     = 0;
			var newColCount     = 0;
			var newColWidth     = 0;
			var featureColWidth = 0;

			curColCount = Math.floor(contentWidth / columnWidth);

			maxColCount = curColCount + 1;
			if((maxColCount - (contentWidth / columnWidth)) > ((contentWidth / columnWidth) - curColCount)){
				newColCount     = curColCount;
			}
			else{
				newColCount = maxColCount;
			}

			newColWidth = contentWidth;
			featureColWidth = contentWidth;


			if(newColCount > 1){
				newColWidth =Math.floor(contentWidth / newColCount);
				featureColWidth = newColWidth * 2;
			}

			$('.element').width(newColWidth);

			$('.image-feature').width(featureColWidth);
			var $container = $('.portafolio');
			$container.imagesLoaded(function(){
				$container.isotope({
					masonry:{
						columnWidth: newColWidth
					}
				});

			});
			ResizeImageContainer($('.category-image'));
			ResizeImageContainer($('.product-image'));
		}
	
 function ResizeImageContainer(obj){


			var widthStage;
			var heightStage ;
			var widthImage;
			var heightImage;
			obj.each(function (i,el){
				
				
				heightStage = jQuery(this).height();

				widthStage = jQuery (this).width();

				var img_url = jQuery(this).find('img').attr('src');

				var image = new Image();
				image.src = img_url;

		
				image.onload = function() {
		         //  console.log(image.naturalWidth);
		          // console.log(image.naturalHeight);
		//            alert(image.naturalWidth);
				}

				widthImage = image.naturalWidth;
				heightImage = image.naturalHeight;

		//        alert(widthImage);

				var dataImg   =   resizeImage(widthImage, heightImage, widthStage, heightStage);
				//alert(tzimg.top,tzimg.left);
				jQuery(this).find('img').css ({ top: dataImg.top, left: dataImg.left, width: dataImg.width, height: dataImg.height });
			});

		}

		function resizeImage  (widthImage, heightImage, widthStage, heightStage) {

			
			//alert(heightStage + "_"+heightImage);
			//alert(widthImage +'-'+ heightImage+'-'+ widthStage+'-'+ heightStage);
			var escImageX = widthStage / widthImage;

			var escImageY = heightStage / heightImage;

		//    console.log(widthStage +'-----'+ heightStage);
		//    console.log(widthImage +'---'+ heightImage);

			//alert(escImageX + "_"+escImageY);

			var escalaImage = (escImageX > escImageY) ? escImageX : escImageY;

			

			var widthV = widthImage * escalaImage;

			var heightV = heightImage * escalaImage;

			var posImageY = 0;

			var posImageX = 0;

			

			if (heightV > heightStage) {

				posImageY = (heightStage - heightV) / 2;

			}



			if (widthV > widthStage) {

				posImageX = (widthStage - widthV) / 2;

			}

			

			return { top: posImageY, left: posImageX, width: widthV, height: heightV };

		};


function getScrollerWidth() {
	var scr = null;
	var inn = null;
	var wNoScroll = 0;
	var wScroll = 0;

	// Outer scrolling div
	scr = document.createElement('div');
	scr.style.position = 'absolute';
	scr.style.top = '-1000px';
	scr.style.left = '-1000px';
	scr.style.width = '100px';
	scr.style.height = '50px';
	// Start with no scrollbar
	scr.style.overflow = 'hidden';

	// Inner content div
	inn = document.createElement('div');
	inn.style.width = '100%';
	inn.style.height = '200px';

	// Put the inner div in the scrolling div
	scr.appendChild(inn);
	// Append the scrolling div to the doc
	document.body.appendChild(scr);

	// Width of the inner div sans scrollbar
	wNoScroll = inn.offsetWidth;
	// Add the scrollbar
	scr.style.overflow = 'auto';
	// Width of the inner div width scrollbar
	wScroll = inn.offsetWidth;

	// Remove the scrolling div from the doc
	document.body.removeChild(
		document.body.lastChild);

	// Pixel width of the scroller
	return (wNoScroll - wScroll);
}

function getWindowHeight() {
	var windowHeight=0;
	if (typeof(window.innerHeight)=='number') {
		windowHeight=window.innerHeight;
	} else {
		if (document.documentElement && document.documentElement.clientHeight) {
			windowHeight = document.documentElement.clientHeight;
		} else {
			if (document.body && document.body.clientHeight) {
				windowHeight=document.body.clientHeight;
			}
		}
	}
	return windowHeight;
}

function getWindowWidth() {
	var windowWidth=0;
	if (typeof(window.innerWidth)=='number') {
		windowWidth=window.innerWidth;
	} else {
		if (document.documentElement && document.documentElement.clientWidth) {
			windowWidth = document.documentElement.clientWidth;
		} else {
			if (document.body && document.body.clientWidth) {
				windowWidth=document.body.clientWidth;
			}
		}
	}
	return windowWidth;
}

