// top menu bar
jQuery(function($){
	var $nav = $('#navigation-test'), $cur = null, cur_len = 0;

	$nav
		.on(
			{
				mouseover : function(){ $(this).addClass('hover'); },
				mouseout  : function(){ $(this).removeClass('hover'); }
			},
			'li.gnb, .menu-contain-gift li'
		)
		.find('li > a').each(function(){
			var $this = $(this), path = $this.attr('href');

			if(path == '/' || path == '#') return;
			if(location.pathname.indexOf(path) == 0 && path.length > cur_len){
				$cur = $this;
				cur_len =  path.length;
			}
		});
		if($cur) $cur.addClass('current');

	// browse menu
	(function(item_w){
		$('.menu-contain-things')
			.show()
			.find('>ul>li')
				.each(function(){ item_w = Math.max(item_w, this.offsetWidth) })
				.width(item_w)
				.parent().width(item_w * 2).end()
			.end()
			.css('display','');
	})(0);

	// live support layer open when live support opened at previous page
	try {
		if( $.jStorage.get('live_support') == 'on' ){
			open_chat( $.jStorage.get('live_support_minimum') );
		}
	} catch(e){};

	// search form
	(function(){
		var $search_form = $nav.find('form.search'),
		    $textbox = $search_form.find('#search-query'),
			$suggest = $search_form.find('.feed-search'),
		    $loading = $search_form.find('.loading'),
		    $things  = $search_form.find('ul.thing'),
			$users   = $search_form.find('ul.user'),
		    $tpl_thing   = $('#tpl-search-suggestions-things').remove(),
		    $tpl_user    = $('#tpl-search-suggestions-users').remove(),
			prev_keyword = $.trim($textbox.val()), timer = null,
			keys = {
				13 : 'ENTER',
				27 : 'ESC',
				38 : 'UP',
				40 : 'DOWN'
			};

		$search_form.on('submit', function(){
			var v = $.trim($textbox.val());
			if(!v) return false;
		});

		$textbox
			// highlight submit button when the textbox is focused.
			.on({
				focus : function(){ $nav.find('.search .btn-submit').addClass('focus') },
				blur  : function(){ $nav.find('.search .btn-submit').removeClass('focus') }
			})
			// search things and users as user types
			.on({
				keyup : function(event){
					var kw = $.trim($textbox.val());

					if(keys[event.which]) return;
					if(!kw.length) return $suggest.hide();
					if(kw.length && kw != prev_keyword) {
						prev_keyword = kw;

						$things.hide();
						$users.hide();
						$loading.show();
						$suggest.show();

						clearTimeout(timer);
						timer = setTimeout(function(){ find(kw) }, 500);
					}
				},
				keydown : function(event){
					var k = keys[event.which];

					if($suggest.is(':hidden') || !k) return;

					event.preventDefault();

					var $items = $suggest.find('a'), $selected = $items.filter('.hover'), idx;

					if(k == 'ESC') return $suggest.hide();
					if(k == 'ENTER') {
						if($selected.length) {
							window.location.href = $suggest.find('a.hover').attr('href');
						} else {
							$search_form.submit();
						}
						return;
					}

					if(!$selected.length) {
						$selected = $items.eq(0).mouseover();
						return;
					}

					idx = $items.index($selected);

					if(k == 'UP' && idx > 0) return $items.eq(idx-1).mouseover();
					if(k == 'DOWN' && idx < $items.length-1) return $items.eq(idx+1).mouseover();
				}
			});

		$suggest.delegate('a', 'mouseover', function(){ $suggest.find('a.hover').removeClass('hover'); $(this).addClass('hover'); });

		function find(word){
			$suggest.show();
//			$search_form.find('a.more').attr('href', baseURL+'shopby/all?q='+encodeURIComponent(word));
			$.ajax({
				type : 'GET',
				url  : baseURL+'site/searchShop/search_suggestions',
				data : {q:word},
				dataType : 'json',
				success  : function(json){
					$suggest.html(json.things).show();
				}
			});
		};

		function highlight(str, substr){
			var regex = new RegExp('('+encodeURIComponent(substr.replace(/ /g,'-')).replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, '\\$&')+')', 'i');
			return str.replace(regex, '<strong>'+substr+'</strong>');
		};

		$(document).click(function(){ if($suggest.is(':visible')) $suggest.hide() });
	})();
});