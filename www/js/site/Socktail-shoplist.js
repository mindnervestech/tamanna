jQuery(function($) {
	var code = null;
	$.infiniteshow({itemSelector:'#can_change_layout'});


	function loadPage(url, skipSaveHistory){
		var $win     = $(window),
			$stream  = $('#can_change_layout'),
			$lis     = $stream.find('>div.category_isotope_item'),
			scTop    = $win.scrollTop(),
			stTop    = $stream.offset().top,
			winH     = $win.innerHeight(),
			headerH  = $('#header-new').height(),
			useCSS3  = Modernizr.csstransitions,
			firstTop = -1,
			maxDelay = 0,
			begin    = Date.now();

		if(!skipSaveHistory && window.history && history.pushState){
			history.pushState({url:url}, document.title, url);
		}
		location.args = $.parseString(location.search.substr(1));
						
		$.ajax({
			type : 'GET',
			url  : url,
			dataType : 'html',
			success  : function(html){
				/*$('.price-range').selectBox('value', location.args.p || '-1');
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
				*/

				var $html = $($.trim(html)),
				    $more = $('.pagination > a'),
				    $new_more = $html.find('.pagination > a');
					//$cate_sel = $('.shop-select.sub-category'),
				    //$new_cate_sel = $html.find('.shop-select.sub-category');

				//$('ul.breadcrumbs').html( $html.find('ul.breadcrumbs').html() );
				$('div.breadcrumbs').html( $html.find('div.breadcrumbs').html() );
				/*$cate_sel.html( $new_cate_sel.html() ).selectBox('destroy').selectBox();
				
				if($new_cate_sel.attr('edge')){
					$cate_sel.attr('edge', 'true');
					$('ul.sub-category-selectBox-dropdown-menu > li').removeClass('subcategory');
				} else {
					$cate_sel.removeAttr('edge', '');
					$('ul.sub-category-selectBox-dropdown-menu > li:not(:first-child)').addClass('subcategory');
				}*/

				if($html.find('#can_change_layout')[0].children.length == 0){
					$stream.html('<p class="noproducts">No more products available</p>');
				}else {
					//$stream.html( $html.find('#can_change_layout').html());
					debugger;
					var $rows = $html.find('#can_change_layout')[0].children;
					$stream.html("");
					var temp,i;					
					while($rows.length != 0){
						i = 0;
						temp = $rows[i];
						$stream.isotope( 'insert', temp);
					}
				}
				setTimeout(function() {  
					$("#can_change_layout").find('.tooltip_container').tooltip('.tooltip');
				}, 2000);
				
				if($new_more.length) $('.pagination').append($new_more);
				$more.remove();
				
				//dynamially added tooltip initilization


				(function(){
					// reset infiniteshow
					$.infiniteshow({itemSelector:'#can_change_layout'});
					$win.trigger('scroll');
				})();
			}
			
		});

		function inViewport(el){
			return (stTop + el.offsetTop + el.offsetHeight > scTop + headerH) && (stTop + el.offsetTop < scTop + winH);
		};
	};
;
	$(window).on('popstate', function(event){
		var e = event.originalEvent;
		if(!e || !e.state) return;

		loadPage(event.originalEvent.state.url, true);
	});

	if(window.history && history.pushState){
		history.pushState({url:location.href}, document.title, location.href);
	}
	
	//swapnil code 
	
	//category button click on page load
	$(window).bind("load", function() {
		var categary = window.location.pathname.split("/");
		if(categary[2] != undefined){
				for(i=2; i <= categary.length; i++){
					if(categary[i] != undefined){
						$("#" + categary[i]).click();
						if($("#_" + categary[i] + "_")){
							$("#_" + categary[i] + "_").addClass("d_inline_b fw_bold scheme_color bg_grey_light_2 new_removeClass");
						}
						if($("#__" + categary[i] + "_")){
							$("#__" + categary[i] + "_").addClass("d_inline_b fw_bold scheme_color bg_grey_light_2 new_removeClass");
						}
					}
				}
		}
	});	
	
	$('.color-filter').change(function(){
		var color = $(this).attr("color"), 
			url = location.pathname, 
			args = $.extend({}, location.args), 
			query;

		if(color != ""){
			args.c = color;
		} else {
			delete args.c;
		}

		if(query = $.param(args)) url += '?'+query;

		loadPage(url);
	});
	
	$('.sub-category').click(function(){
		var $this = $(this), 
			url = $(this).attr("link"); 
			//text = $this.find('>option').eq(this.selectedIndex).text(),
			//issibling = $this.find('>option').eq(this.selectedIndex).hasClass('sibling');
		if(url) loadPage(url);
		
        /*if (issibling)
		    $('ul.breadcrumbs').find('.last').remove();
		$('ul.breadcrumbs').append('<li class="last">/ <a href="'+url+'">'+text+'</a></li>');*/
		return false;
	});
	
	$('.search-button-click').click(function(){
			var q = $.trim($("#searchbox").val()), 
				url = location.pathname, 
				args = $.extend({}, location.args),
				query;
			event.preventDefault();
			if(q) {
				args.q = q;
			} else {
				delete args.q;
			}

			if(query = $.param(args)) url += '?'+query;

			loadPage(url);
	});
	
	$('.sort-by-price').change(function(){
		var sort_by_price = this.value, url = location.pathname, args = $.extend({}, location.args), query;

		if(sort_by_price){
			args.sort_by_price = sort_by_price;
		} else {
			delete args.sort_by_price;
		}

		if(query = $.param(args)) url += '?'+query;

		loadPage(url);
	});
	
	$('#sort_By_Price_Range').click(function(event){
		debugger;
		event.preventDefault();
		var minRange = $("#sliderPriceMin").val();
		var maxRange = $("#sliderPriceMax").val();
		if(minRange != "" && maxRange!=""){

			var priceRange = minRange + "-" + maxRange, 
				url = location.pathname, 
				args = $.extend({}, location.args), 
				query;
				
				if(priceRange != ""){
					if(priceRange != '-1'){
						args.p = priceRange;
					} else {
						delete args.p;
					}
					if(query = $.param(args)) url += '?'+query;
					loadPage(url);
				}	
		}
	});

	$('.search-string')
		.hotkey('ENTER', function(event){
			var q = $.trim(this.value), url = location.pathname, args = $.extend({}, location.args), query;

			event.preventDefault();

			if(q) {
				args.q = q;
			} else {
				delete args.q;
			}

			if(query = $.param(args)) url += '?'+query;

			loadPage(url);
		})
		.keyup(function(){
			var hasVal = !!$.trim(this.value);
			$(this).parent()
				.find('.del-val').css({opacity:hasVal?1:0}).end()
				.find('.label').css({opacity:hasVal?0:1});
	}).keyup();
	
});
