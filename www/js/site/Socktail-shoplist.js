jQuery(function($) {
	var code = null;
   

	function loadPage(url, skipSaveHistory){
		var $win     = $(window),
			$stream  = $('#content ol.stream'),
			$lis     = $stream.find('>li'),
			scTop    = $win.scrollTop(),
			stTop    = $stream.offset().top,
			winH     = $win.innerHeight(),
			headerH  = $('#header-new').height(),
			useCSS3  = Modernizr.csstransitions,
			firstTop = -1,
			maxDelay = 0,
			begin    = Date.now();

		if(useCSS3){
			$stream.addClass('use-css3').removeClass('fadein');

			$lis.each(function(i,v){
				if(!inViewport(v)) return;
				if(firstTop < 0) firstTop = v.offsetTop;

				var delay = Math.round(Math.sqrt(Math.pow(v.offsetTop - firstTop, 2)+Math.pow(v.offsetLeft, 2)));

				v.className += ' anim';
				setTimeout(function(){ v.className += ' fadeout'; }, delay+10);

				if(delay > maxDelay) maxDelay = delay;
			});
		}

		if(!skipSaveHistory && window.history && history.pushState){
			history.pushState({url:url}, document.title, url);
		}
		location.args = $.parseString(location.search.substr(1));
						
		$.ajax({
			type : 'GET',
			url  : url,
			dataType : 'html',
			success  : function(html){
				$('.price-range').selectBox('value', location.args.p || '-1');
				$('.relationship').selectBox('value', location.args.rel || '');
				$('.color-filter').selectBox('value', location.args.c || '');
				$('.sort-by-price').selectBox('value', location.args.sort_by_price || '');
				$('.se-gender').selectBox('value', location.args.sg || '');
				$('.re-gender').selectBox('value', location.args.rg || '');
				$('.filter-age').val(location.args.ra || '').keyup();
				$('.search-string').val(location.args.q || '').keyup();
                if(location.args.is){
                    $('#immediateShipping').closest('label').addClass('on')
                }
                else{
                    $('#immediateShipping').closest('label').removeClass('on')
                }


				var $html = $($.trim(html)),
				    $more = $('.pagination > a'),
				    $new_more = $html.find('.pagination > a'),
					$cate_sel = $('.shop-select.sub-category'),
				    $new_cate_sel = $html.find('.shop-select.sub-category');

				$('ul.breadcrumbs').html( $html.find('ul.breadcrumbs').html() );
				$cate_sel.html( $new_cate_sel.html() ).selectBox('destroy').selectBox();
				
				if($new_cate_sel.attr('edge')){
					$cate_sel.attr('edge', 'true');
					$('ul.sub-category-selectBox-dropdown-menu > li').removeClass('subcategory');
				} else {
					$cate_sel.removeAttr('edge', '');
					$('ul.sub-category-selectBox-dropdown-menu > li:not(:first-child)').addClass('subcategory');
				}

				if($html.find('#content > ol.stream').text() == ''){
					$stream.html('<ol class="stream"><li style="width: 100%;"><p class="noproducts">No more products available</p></li></ol>');
				}else {
					$stream.html( $html.find('#content > ol.stream').html());
				}
				if($new_more.length) $('.pagination').append($new_more);
				$more.remove();

				(function(){
					if(useCSS3 && (Date.now() - begin < maxDelay+300)){
						return setTimeout(arguments.callee, 50);
					}

					$stream.addClass('fadein').html( $html.find('#content > ol.stream').html() );
					
					if(useCSS3){
						$win.scrollTop(scTop);
						scTop = $win.scrollTop();
						stTop = $stream.offset().top;
						
						firstTop = -1;
						$stream.find('>li').each(function(i,v){
							if(!inViewport(v)) return;
							if(firstTop < 0) firstTop = v.offsetTop;
							
							var delay = Math.round(Math.sqrt(Math.pow(v.offsetTop - firstTop, 2)+Math.pow(v.offsetLeft, 2)));
							
							v.className += ' anim';
							setTimeout(function(){ v.className += ' fadein'; }, delay+10);
							
							if(delay > maxDelay) maxDelay = delay;
						});

						setTimeout(function(){ $stream.removeClass('use-css3 fadein').find('li.anim').removeClass('anim fadein'); }, maxDelay+300);
					}

					// reset infiniteshow
					$.infiniteshow({itemSelector:'#content .stream > li'});
					$win.trigger('scroll');
				})();
			}
			
		});

		function inViewport(el){
			return (stTop + el.offsetTop + el.offsetHeight > scTop + headerH) && (stTop + el.offsetTop < scTop + winH);
		};
	};
	

});
    
	window.addEventListener("DOMContentLoaded", function() {
	var categary = window.location.pathname.split("/");
	if(categary[2] != undefined){
			for(i=2;i<=categary.lenght;i++){
				$("#" + categary[i]).click();
			}
	}

    }, false);
	 $(window).bind("load", function() {
	var categary = window.location.pathname.split("/");
	if(categary[2] != undefined){
			for(i=2;i<=categary.lenght;i++){
				$("#" + categary[i]).click();
			}
	}

	});

	
	
    
    
