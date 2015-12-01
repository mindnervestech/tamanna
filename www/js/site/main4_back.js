// jquery cookie
jQuery.cookie = {
	'get' : function(name){
		var regex = new RegExp('(^|[ ;])'+name+'\\s*=\\s*([^\\s;]+)');
		return regex.test(document.cookie)?unescape(RegExp.$2):null;
	},
	'set' : function(name, value, days){
		var expire = new Date();
		expire.setDate(expire.getDate() + (days||0));
		cookie_str = name+'='+escape(value)+(days?'':';expires='+expire);
		if (name =='lang') cookie_str +='; path=/';
		document.cookie = cookie_str;
	}
};

// parse query string - equivalent to parse_string php function
jQuery.parseString = function(str){
	var args = {};
	str = str.split(/&/g);
	for(var i=0;i<str.length;i++){
		if(/^([^=]+)(?:=(.*))?$/.test(str[i])) args[RegExp.$1] = decodeURIComponent(RegExp.$2);
	}
	return args;
};
location.args = jQuery.parseString(location.search.substr(1));

function require_login(next){
	next = $(location).attr('href');
	next = next.replace(baseURL,'');
	
	location.href = baseURL+'login'+(next?'?next='+encodeURIComponent(next):'');

	return false;
}

function scrollToElement(elem, top) {
	var pos = elem.offset().top;
	if (top != undefined) pos -= top;
    $('html, body').animate({scrollTop: pos + 'px'}, 'fast');
}

/**
 * Fancy UI
 */
var Fancy = {
    // Init function
    init: function() {
        Fancy.validation();
        Fancy.usernameSyn();
        Fancy.changePass();
        Fancy.filter();
        Fancy.fieldFocus();
    },
    /**
    * Validation
    */
    validation: function() {
		var $form = $('.sign #content form');
        if (!$form.length || !$form.validate) return;

        $form.validate({
            rules: {
                password: "required",
                username: "required",
                name: "required"
            },
            messages: {
                email: "Hmm, that doesn't look like a valid email address."
            }
        });
    },


    /* Username */
    usernameSyn : function(){
        var obj = $('input#username');
        if (obj.length){
            obj.keyup(function(){
                obj.next('.username').children('strong').html($('input#username').val().replace(/&/g, "&amp;").replace(/>/g, "&gt;").replace(/</g, "&lt;").replace(/"/g, "&quot;"));
            })
        }
    },

    /**
     * Setting - change password
     */
    changePass: function() {
        $('#change-password').find('.pass-trigger').click( function() {
            $(this).hide();
            $(this).next('ul').animate({
                height: 100
            }, 400 );
            $(this).parent('#change-password').addClass('snp-expanded');
            return false;
        })
    },

    /**
     * Fancy filter
     */
     filter: function() {
        var filter = $('#filter');
        var em = filter.find('h3 em');

        filter.click(function() {
            $(this).toggleClass("expanded");
        });

        filter.find('a').click(function(e) {
            em.html($(this).text());
            e.preventDefault();
        });
     },



	fieldFocus: function () {
			var sfEls = document.getElementsByTagName("INPUT");
			for (var i=0; i<sfEls.length; i++) {
				if(sfEls[i].type != 'text') continue;
				sfEls[i].onfocus=function() {
					$(this).addClass('sffocus').parent().addClass("hastext");
				}
				sfEls[i].onblur=function() {
					this.className=this.className.replace(new RegExp(" sffocus\\b"), "");
				}

			}
	},

    fixStreamLinking: function () {
	    $("#content .fig-image").click(function() {
		    window.location = $(this).parents("a").attr("href");
	    });
    },
   

}

/**
 * Fancy popups default setting
 */
Fancy.Popup = {

    /**
     * Default options
     */
    options: {
            open: function(event, ui) {
                $(".ui-dialog-titlebar-close").hide();
                $(".ui-dialog-content.ui-widget-content").css({
                    width: '356px'
                });
            },
            autoOpen: false,
            closeOnEscape: false,
            draggable: false,
            closeText: 'Cancel'
    },

    /**
     * Other setting
     */
    setup: function(popup,fixed) {
        // Close by clicking on Cancel
        popup.find('.button.cancel').click(function(){
            $(".tipsy").hide();
            popup.dialog('close');
            return false;
        });

		// Make it draggable
		if (fixed) {
		} else {
			popup.draggable({ "handle": 'h3' });
		}
    }
}

// template
jQuery.fn.template = function(args) {
	if(!args) args = {};
	var html = jQuery.trim(this.html()).replace(/##([a-zA-Z0-9_]+)##/g, function(whole,name){
		return args[name] || '';
	});
	return jQuery(html);
//	return html;
};

// filter
$('#filter').each(function() {
	var filter = $(this);
	filter.find('h3')
	.parent().find('a').click(function() {
		filter.toggleClass("expanded").find('em').text($(this).text());
		location.href = $(this).attr('href');
	    return false;
	});
});

function show_overlay_on_timeline() {
	$('#content')
		.delegate(
			'.figure-product',
			{
				mouseover : function(){
					var $this = $(this), $timeline = $this.find('.timeline');
					if (!$timeline.length) return;

					var $img = $this.find('img'), pos = $img.position(), w = $img.width(), h = $img.height();
                    if (w>640) w=640;
					$timeline
						.filter(':hidden').css('opacity',0).end()
						.show()
						.stop()
						.css({width:(w-54)+'px',height:(h-12)+'px',top:pos.top+'px',left:pos.left+'px'})
						.fadeTo(200,1);

					if (h < 110) $timeline.find('.btn-share').hide();
				},
				mouseleave : function(event){
					var $timeline = $(this).find('.timeline').stop().fadeTo(100,0,function(){$timeline.hide()});
				}
			}
		);
}

show_overlay_on_timeline();

// CSRF
(function($){
	function getCookie(name) {
		var cookies = document.cookie.split(';');
		for (var i=0,c=cookies.length; i < c; i++) {
			var cookie = $.trim(cookies[i]);
			// Does this cookie string begin with the name we want?
			if (cookie.substring(0, name.length + 1) == (name + '=')) {
				return decodeURIComponent(cookie.substring(name.length + 1));
			}
		}
		return null;
	}
	function sameOrigin(url) {
		// url could be relative or scheme relative or absolute
		var host = location.host; // host + port
		var protocol = location.protocol;
		var sr_origin = '//' + host;
		var origin = protocol + sr_origin;
		// Allow absolute or scheme relative URLs to same origin
		return (url == origin || url.slice(0, origin.length + 1) == origin + '/') ||
			(url == sr_origin || url.slice(0, sr_origin.length + 1) == sr_origin + '/') ||
			// or any other URL that isn't scheme relative or absolute i.e relative.
			!(/^(\/\/|https?:).*/.test(url));
	}
	$.ajaxPrefilter(function(options, originalOptions, jqXHR){
		if(options.type.toUpperCase() == 'POST' && sameOrigin(options.url)){
			var v = getCookie('csrftoken');
			if(v && v.length){
				if(!options.headers) options.headers = {};
				options.headers['X-CSRFToken'] = v;
			}
			// prevent cache to avoid iOS6 POST bug
			options.url += ((options.url.indexOf('?') > 0)?'&':'?')+'_='+(new Date).getTime();
		}
	});
})(jQuery);


// Infiniteshow
(function($){
	var options;
	var defaults = {
		dataKey : '',
		loaderSelector : '#infscr-loading', // an element to be displayed while calling data via ajax.
		itemSelector : '#content .inside-content .figure-row',
		nextSelector   : 'a.btn-more', // elements which head for next data.
		streamSelector : '.stream',
		prepare   : 4000, // indicates how many it should prepare (in pixel)
		prefetch  : false, // whether or not prefetch next page
		newtimeline : false, // is new timeline
		dataType  : 'html', // the type of ajax data.
		success   : function(data){}, // a function to be called when the request succeeds.
		error     : function(){ }, // a function to be called if the request fails.
		comeplete : function(xhr, st){} // a function to be called when the request finishes (after success and error callbacks are executed).
	};

	$.infiniteshow = function(opt) {
		options = $.extend({}, defaults, opt);

		var $win = $(window),
		    $doc = $(document),
		    ih   = $win.innerHeight(),
			$url = $(options.nextSelector).hide(),
			$str = $(options.streamSelector),
			loc  = $str.attr('loc'),
			url  = $url.attr('href'),
			bar  = $('div.pagination'),
			ttl  = 5 * 60 * 1000,
			calling = false;
			prefetching = false;
			ignorePrefecth = false;
			lastFetchedUrl = null;			

		var keys = {
			timestamp : 'fancy.'+options.dataKey+'.timestamp.'+loc,
			stream  : 'fancy.'+options.dataKey+'.stream.'+loc,
			latest  : 'fancy.'+options.dataKey+'.latest.'+loc,
			nextURL : 'fancy.'+options.dataKey+'.nexturl.'+loc,
			prefetch : 'fancy.prefetch.stream'
		};

		(function(){
			var data      = $.jStorage.get(keys.stream, ''),
				latest    = $.jStorage.get(keys.latest, ''),
				nextURL   = $.jStorage.get(keys.nextURL, ''),
				timestamp = $.jStorage.get(keys.timestamp, 0);

			$.jStorage.deleteKey(keys.prefetch);
			if(!data || !latest || !nextURL || (+new Date - timestamp > ttl)){
				for(var name in keys) $.jStorage.deleteKey(keys[name]);
				return;
			}			

			$url.attr('href', url=nextURL);
			$str.html(data).attr('ts',latest);

			if(options.prefetch) prefetch(nextURL);

			// get fancyd state only for latest 100 items
			var tids = [], items = {};
			$(options.itemSelector).slice(-100).each(function(){
				var $btn = $(this).find('.button.fancy,.button.fancyd'), tid = $btn.attr('tid');
				tids.push( tid );
				items[tid] = $btn;
			});
			$.ajax({
				type : 'POST',
					url  : '/user_fancyd_things.json',
				data : {object_ids : tids.join(',')},
				dataType : 'json',
				success  : function(json){
					var fancyd = {}, $btn;
					for(var i=0,c=json.length; i < c; i++){
						fancyd[ json[i].object_id ] = json[i].id;
					}

					for(var k in items){
						if(fancyd[k]){
							$btn = items[k].find('.button.fancy');
							if($btn.length) $btn.toggleClass('fancy fancyd').attr('rtid', fancyd[k]).contents().get(-1).nodeValue = gettext(likedTXT);
						} else {
							$btn = items[k].find('.button.fancyd');
							if($btn.length) $btn.toggleClass('fancy fancyd').removeAttr('rtid').contents().get(-1).nodeValue = gettext(likeTXT);
						}
					}
				}
			});
		})();

		function docHeight() {
			var d = document;
			return Math.max(d.body.scrollHeight, d.documentElement.scrollHeight);
		};

		function prefetch(url){
			prefetching = true;
			if(!url || typeof url == 'object') url = $url.attr('href');
			if(url==lastFetchedUrl){
				$.jStorage.deleteKey(keys.prefetch);
				prefetching = false;
				return;
			}
			lastFetchedUrl = url;
            /*if(typeof url != 'string'){
                lastFetchedUrl = '';
                return; 
            }*/
			$.ajax({
				url : url,
				dataType : options.dataType,
				success : function(data, st, xhr) {
					if(!ignorePrefecth)
						$.jStorage.set(keys.prefetch,data,{TTL:ttl});
					ignorePrefecth = false;
					prefetching = false;
				},
				error : function(xhr, st, err) {
					$.jStorage.deleteKey(keys.prefetch);
					ignorePrefecth = false;
					prefetching = false;
				}
			});
		}

		function onScroll() {

			url = $url.attr('href');
			if (calling || !url || options.disabled) return;

			calling = true;

			var rest = docHeight() - $doc.scrollTop();
			if (rest > options.prepare){
				calling = false;
				return;
			}

			var $loader = $(options.loaderSelector).show();

			function appendThings(data){
                if (options.disabled) {
                    $.jStorage.deleteKey(keys.prefetch);
                    return;
                }
				var $sandbox = $('<div>'),
				    $contentBox = $(options.itemSelector).parent(),
					$next, $rows;
//				$sandbox[0].innerHTML = data.replace(/^[\s\S]+<body.+?>|<((?:no)?script|header|nav)[\s\S]+?<\/\1>|<\/body>[\s\S]+$/ig, '');
				$sandbox[0].innerHTML = data;
				$next = $sandbox.find(options.nextSelector);
//				$rows = $sandbox.find(options.itemSelector).parent().html();
				$rows = $sandbox.find(options.itemSelector).parent().html();
				
				$contentBox.append($rows);
				if ($next.length) {
					url = $next.attr('href');
					$url.attr({
						'href' : $next.attr('href'),
						'title'   : $next.attr('title')
					});
					if(options.prefetch) prefetch($next.attr('href'));
				} else {
					url = '';
					$url.attr({
						'href' : '',
						'title'   : ''
					});
				}
				$('ol.stream').trigger('itemloaded');
				if(!options.newtimeline)
					$win.trigger('savestream.infiniteshow');

				// Triggers scroll event again to get more data if the page doesn't have enough data still.
				onScroll();

                if (options.post_callback != null) {
                    options.post_callback($rows);
                }
				$('<style></style>').appendTo($(document.body)).remove();
			}

			if( options.prefetch && !prefetching && (data=$.jStorage.get(keys.prefetch)) ){		
				$.jStorage.deleteKey(keys.prefetch);		
				appendThings(data);
				calling = false;
				$loader.hide();
			}else{
				if(prefetching) {
					calling = false;
					setTimeout(onScroll,300);
					return;
				}
				$.jStorage.deleteKey(keys.prefetch);
					$.ajax({
						url : url,
						dataType : options.dataType,
						success : function(data, st, xhr) {
							appendThings(data);
						},
						error : function(xhr, st, err) {
							url = '';
						},
						complete : function(){
							calling = false;
							$loader.hide();
						}
					});
			}
		};

		$win.off('resize.infiniteshow').on('resize.infiniteshow', function(){ ih = $win.innerHeight(); onScroll(); });
		$win.off('scroll.infiniteshow').on('scroll.infiniteshow', onScroll);
		$win.off('savestream.infiniteshow').on('savestream.infiniteshow', function(){
			loc = $str.attr('loc');
			if(!$str.length || !options.dataKey) return;

			var keys = {
				timestamp : 'fancy.'+options.dataKey+'.timestamp.'+loc,
				stream  : 'fancy.'+options.dataKey+'.stream.'+loc,
				latest  : 'fancy.'+options.dataKey+'.latest.'+loc,
				nextURL : 'fancy.'+options.dataKey+'.nexturl.'+loc
			};

			var data = $str.html().replace(/>\s+</g,'><');
			$.jStorage.set(keys.timestamp, +new Date, {TTL:ttl});
			$.jStorage.set(keys.stream, data, {TTL:ttl});
			$.jStorage.set(keys.latest, $str.attr('ts'), {TTL:ttl});
			$.jStorage.set(keys.nextURL, url, {TTL:ttl});
		});
		$win.off('prefetch.infiniteshow').on('prefetch.infiniteshow', prefetch);

		onScroll();
	};

	$.infiniteshow.option = function(name, value) {
		if (typeof(value) == 'undefined') return options[name];
		options[name] = value;

		if (name == 'disabled' && !value) onScroll();
	};
})(jQuery);

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

jQuery(function($){
	// common popup script
	var $container = $('#popup_container'), prev_dialog=null, duration=300, distance=100, container_h;
	var $win = $(window), $body = $('body');

	$container
		.on('click', function(event){
			if(event.target === this && prev_dialog) {
				if ($container.hasClass('create_po')==true) {
					var ans=confirm("You haven't finished PO yet. Do you want to leave without finishing? Are you sure you want to close this popup?") 
					if(ans ==true) {event.preventDefault();prev_dialog.close();}
				}
				else {
					event.preventDefault();
					prev_dialog.close();
				}
			}
		})
		.delegate('.ly-close,.btn-close,.btn-cancel', 'click', function(event){
			if ($container.hasClass('create_po')==true) {
				var ans=confirm("You haven't finished PO yet. Do you want to leave without finishing? Are you sure you want to close this popup?") 
				if(ans ==true) {
					event.preventDefault();
					if(prev_dialog) prev_dialog.close();
				}
			}else{
				event.preventDefault();
				if(prev_dialog) prev_dialog.close();
			}
		});

	// ESC to close a popup
	$body.on('keyup.popup', function(event){
		if(event.keyCode == 27 && prev_dialog) prev_dialog.close();
	});

	$.dialog = function(popup_name){
		var $popup = $container.find('>.'+popup_name);
		return {
			name : popup_name,
			$obj : $popup,
			loading : function() {
				var $c = $container.addClass(popup_name).show();
				setTimeout(function(){ $c.css('opacity',1); },1);
				this.$obj.hide();
				prev_dialog = this;
				$container.data('lastest_popup_name', popup_name);
				$container.find('.loader').show();
				return this;
			},   
			open : function(){
				var $c,h,mt,sc=$win.scrollTop();
				$('body').addClass('fixed');
				if(!container_h) container_h = $container.height();
				if(prev_dialog) prev_dialog.close(true);
				if($win.innerHeight() < $body[0].scrollHeight) {
					$body.css('overflow-y','scroll');
				}
				$container.find('.loader').hide();
				$c = $container.addClass(popup_name).show().data('scroll-top',sc);

				this.center().$obj.trigger('open').show();

				if($c.length) {
					if(Modernizr.csstransitions && !$popup.hasClass('no-slide')){
						mt = this.center(true);
						ml = $(window).width()-$popup.width();
						$popup.removeClass('animated').css({marginTop:(mt+distance)*2+'px',marginLeft:ml/2+'px',opacity:0});
						setTimeout(function(){ $popup.addClass('animated') }, 1);
						setTimeout(function(){ $popup.css({marginTop:mt+'px',opacity:1}) }, 10);
					}
					setTimeout(function(){ $c.css('opacity',1); },1);

					$('#container-wrapper > .container').css('top',-sc+'px');
					$win.scrollTop(0); // workaround for mac chrome
				}

				prev_dialog = this;
				$container.data('lastest_popup_name', popup_name);

				return this;
			},
			close : function(keep_container){
				if(!this.showing() || !this.can_close()) return;
                                $container.find('.loader').hide();
				$c = $container.eq(keep_container?1:0).end();
				$('body').removeClass('fixed');
				$body.css('overflow-y','');

				if(keep_container) {
					$container.removeClass(popup_name);
				} else {
					// restore scroll position
					$('#container-wrapper > .container').css('top',0);
					$win.scrollTop($c.data('scroll-top'));

					if(Modernizr.csstransitions) {
						$container.css('opacity', 0);
						setTimeout(function(){ $container.removeClass(popup_name).hide() },duration+100);
					} else {
						$container.removeClass(popup_name).hide();
					}
				}

				$popup.trigger('close').hide();
				prev_dialog = null;
				return this;
			},
			center : function(return_value){
				var mt = Math.max(Math.floor((container_h-this.$obj.outerHeight())/2)-20,5);
				if(return_value) return mt;

				this.$obj.css('margin-top', mt+'px');
				return this;
			},
			showing : function(){
				return $container.is(':visible') && $container.hasClass(popup_name);
			},
			can_close : function(){ return true }
		};
	};

	// window
	var resize_timer = null;
	$win.on(
		'resize',
		function(){
			clearTimeout(resize_timer);
			resize_timer = setTimeout(function(){
				container_h = $win.innerHeight();
				if(prev_dialog) prev_dialog.center();
			}, 100);
		}
	);

	// {{{ dialog for uploading files to add to Fancy
	(function(){
		var dlg_drop=$.dialog('drop-to-upload'), dlg_add=$.dialog('add-fancy'), $_drag_objs=$();

		if(!dlg_add.$obj.length || !dlg_drop.$obj.length) return;

		// 'Add' navigation menu
		$('.mn-add').click(function(event){
			event.preventDefault();
			myevent = $(event.target); 
			dlg_add.open();
		});

		// 'Add' navigation menu
		$('.mn-add-web').click(function(event){
			event.preventDefault();
			myevent = $(event.target); 
			dlg_add.open();
		});

		// 'Add' navigation menu
		$('.mn-add-upload').click(function(event){
			event.preventDefault();
			myevent = $(event.target); 
			dlg_add.open();
		});

		// add fancy dialog
		dlg_add.$obj
			.append('<iframe name="iframe_img_upload" frameborder="0" />') // we should use script to add iframe to workaround firefox
			.on({
				open : function(){
				
					var Class_stepTo = myevent.attr("class");
			     
				       	if(Class_stepTo == 'mn-add'){
				       		var stepTo = 'step1';
				       	}
				       	if(Class_stepTo == 'mn-add-web'){
				       		var stepTo = 'step2';
				       	}
				       	if(Class_stepTo == 'mn-add-upload'){
				       		var stepTo = 'step2-upload';
				       	}

					var $this = $(this).trigger('tab',stepTo);

					// load lists and categories
					if(!$this.data('lists_loaded')){
						$.ajax({
							type : 'get',
							url  : '/categories_lists.json?mbox=true',
							success : function(json){
								if(!json || !json.response) return;

								var i,c,r=json.response,cate,list,html='';

								// categories
								for(i=0,c=r.categories.length; i<c; i++){
									cate  = r.categories[i];
									html += '<option value="'+cate.key+'">'+cate.name.escape_html()+'</option>';
								}
								dlg_add.$obj.find('select.categories_').append(html);

								// lists
								html='';
								for(i=0,c=r.lists.length; i<c; i++){
									list  = r.lists[i];
									html += '<option value="'+list.id+'">'+list.title.escape_html()+'</option>';
								}
								dlg_add.$obj.find('select.lists_').append(html);

								// mbox
								if(r.mbox) dlg_add.$obj.find('.step1 ul.case li a.mbox_').attr('target','_blank').attr('href','mailto:'+r.mbox);

								$this.data('lists_loaded',true);
							}
						});
					}
				},
				tab  : function(event,tab_name){
					var $this = $(this);
					$this
						.attr('class', $this.attr('class').replace(/\bstep\d+(-\w+)?/g,tab_name))
						.find('input:text').val('').end()
						.find('select').each(function(){ this.selectedIndex = 0; }).end()
						.find('form').trigger('reset').end()
						.find('button:submit').disable(false).end();

					dlg_add.center();
				}
			})
			.find('>.step .btns-area a.cancel')
				.click(function(event){
					event.preventDefault();
					if($(this).hasClass('disabled')) return;
					dlg_add.$obj.trigger('tab','step1');
				})
			.end()
			.find('button.btn-add-note')
				.click(function(event){
					event.preventDefault();
					$(this).hide().next('input:text').show();
				})
			.end()
			.find('>.step.step0-error .btn-blue-embo').click(function(){ dlg_add.close() }).end()
			.find('>.step.step1')
				.find('ul.case li a')
					.filter('.mbox_').tipsy({gravity:'se',fade:true,offset:-10}).end()
					.click(function(event){
						var href = $(this).attr('href');

						if(href.substr(0,1) != '#') return;

						event.preventDefault();
						if(href.length > 1) dlg_add.$obj.trigger('tab',href.substr(1));
					})
				.end()
			.end()
			// Fetch images from web
			.find('>.step.step2')
				.find('input.url_').keydown(function(event){ if(event.which==13){event.preventDefault();$(this).closest('.step').find('.btn-blue-embo-fetch').click()} }).end()
				.find('.btn-blue-embo-fetch')
					.click(function(){
						var $btn=$(this),$step=$btn.closest('.step'),$pg,$ind,url;

						url = $step.find('input.url_').val().trim().replace(/^https?:\/\//i,'');
						if(!url.length) return alert(gettext('Please enter a website address.'));

						// hide buttons and show progress bar
						$step.find('.btns-area').hide().end().find('.progress').show().end();
						$pg  = $step.find('.progress-bar');
						$ind = $pg.find('em').width(0).animate({'width':'70%'},1500);

						function check(images, callback){
							var fn=[], list=[], cur=80, step=30/images.length;
							

							function load(src){
								var def = $.Deferred(), img = new Image();
								img.onload = function(){
									cur += step;
									if(cur > 100) cur = 100;
									$ind.stop().animate({'width':cur+'%'},100);

									if(this.width > 199 || this.height > 199) list.push(this);
									def.resolve(this);
								};
								img.onerror = function(){ def.reject(this) };
								img.src = src;
								return def;
							};

							for(var i=0,c=images.length; i < c; i++) fn[i] = load(images[i]);

							$.when.apply($,fn).always(function(){
								if(list.length){
									dlg_add.$obj.trigger('tab','step3');
									$step.siblings('.step3').trigger('set.images',[list]);
									$('#fancy_add-link').val('http://'+url);
								}else{
									alert(gettext("Oops! Couldn't find any good images for the page."));
									dlg_add.$obj.trigger('tab','step2');
								}
							});
						};

						if(/\.(jpe?g|png|gif)$/i.test(url)) return check(['http://'+url]);

						// fetching images
						$.ajax({
							type : 'get',
							url  : baseURL+'site/product/extract_image_urls?url='+url,
							dataType : 'json',
							success  : function(json){
								if(!json) return;
								if(json.response){
									check(json.response);
								} else if(json.error && json.error.message){
									alert(json.error.message);
								}
							},
							complete : function(){
								$step.find('.btns-area').show().end().find('.progress').hide().end();
							}
						});
					})
				.end()
			.end()
			// Upload local images
			.find('>.step.step2-upload')
				.find('form')
					.on({
						upload_begin : function(event){
							$(this)
								.find('>.btns-area').hide().end()
								.find('>.progress').show().end();
						},
						upload_complete : function(event,json){
							var $this = $(this), $step3_upload;

							$this.trigger('reset');

							if(!json || typeof(json.status_code) == 'undefined') return;
							if(json.status_code == 1){
								$step3 = $this.closest('.popup').find('>.step3');
								if(json.image && json.image.url){
									$step3.trigger('set.uploaded_image', [json.image]);
									dlg_add.$obj.trigger('tab','step3');
								} else {
									alert(gettext('Something went wrong. Please upload again.'));
								}
							}else if(json.status_code == 0){
								if(json.message) alert(json.message);
							}
						},
						reset : function(){
							$(this)
								.find('>.btns-area').show().end()
								.find('>.progress').hide().find('em').width(0);
						},
						submit : function(event,filelist){
							var $this=$(this),$step=$this.closest('.step'),$indicator,file_form=this.elements['file'],file,progress_id,filename,extension;

							if(!filelist) filelist = file_form.files || (file_form.value ? [{name:file_form.value}] : []);
							if(filelist && filelist.length) file = filelist[0];

							if(!file){
								alert(gettext('Please select a file to upload'));
								return false;
							}

							if(!/([^\\\/]+\.(jpe?g|png|gif))$/i.test(file.name||file.filename)){
								alert(gettext('The image must be in one of the following formats: .jpeg, .jpg, .gif or .png.'));
								return false;
							}

							filename  = RegExp.$1;
							extension = RegExp.$2;

							$indicator = $this.find('.progress-bar em').css('width','0.5%');

							$this.trigger('upload_begin');

							function onprogress(cur,len){
								var prog = Math.max(Math.min(cur/len*100,100),0).toFixed(1);
								$indicator.stop().animate({'width':prog+'%'},500);
							};

 							if(!window.FileReader || !window.XMLHttpRequest) {
								var null_counter = 0, completed = false;

								progress_id = parseInt(Math.random()*10000);
								document.cookie = 'X-Progress-ID='+progress_id+'; path=/';
								window._upload_image_callback = function(json){ completed = true; $this.trigger('upload_complete',json); };

								function get_progress(){
									$.ajax({
										type : 'get',
										url  : '/get_upload_progress.json',
										data : {'X-Progress-ID':progress_id},
										dataType : 'json',
										success  : function(json){
											if(!json) return;
											if(json.uploaded + 1000 >= json.length) json.uploaded = json.length;
											onprogress(json.uploaded, json.length);
										},
										complete : function(xhr){
											if(completed || null_counter > 10) return;
											if(xhr.responseText == 'null') null_counter++;
											setTimeout(get_progress, 500);
										}
									});
								};
								setTimeout(get_progress, 300);
								return true;
 							}

							// Here is ajax file upload
							var reader = new FileReader(), xhr = new XMLHttpRequest();
							xhr.upload.addEventListener('progress', function(e){ onprogress(e.loaded, e.total)}, false);
							xhr.onreadystatechange = function(e){
								if(xhr.readyState !== 4) return;
								if(xhr.status === 200){
									// success
									var data = xhr.responseText, json;
									try {
										if(window.JSON) json = window.JSON.parse(data);
									} catch(e){
										try { json = new Function('return '+data)(); } catch(ee){ json = null };
									}

									$this.trigger('upload_complete', json);
								}
							};
							xhr.open('POST', baseURL+'site/product/upload_product_image?filename='+filename, true);
							xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
							xhr.setRequestHeader('X-Filename', filename);
						//	xhr.send(file);
						
							var formData = new FormData();
							formData.append("thefile", file);
							xhr.send(formData);
							return false;
						}
					})
				.end()
			.end()
			.find('>.step.step3')
				.on({
					'set.uploaded_image' : function(event,image_info){
						var $this=$(this), title;

						title = $this.closest('.popup').find('.step.step2-upload p.ltit').text();

						$this
							.data('req_url', baseURL+'site/product/add_new_thing')
							.data('img_name', image_info.name)
							.data('fields', 'name link category list_ids note')
							.find('.ltit').text(title).end()
							.find('.controls').hide().end()
							//.find('#fancy_add-photo_url').val(image_info.name).end()
							.find('img.photo').attr('src', image_info.url).end()
							.find('.size').width('100%').html(image_info.width+' &times; '+image_info.height).end();
					},
					'set.images' : function(event,images){
						var $this=$(this), title;
						if(!$.isArray(images)) images = [images];

						title = $this.closest('.popup').find('.step.step2 p.ltit').text();

						$this
							.data('req_url', baseURL+'site/product/add_new_thing')
							.data('fields', 'name link category list_ids note photo_url')
							.data('index', 0)
							.data('images', images)
							.find('.ltit').text(title).end()
							.find('.controls .size').text('').end()
							.trigger('set.index',0);

							if(images.length > 1) {
								$this.find('.controls').show();
							} else {
								$this.find('.controls').hide();
							}
					},
					'set.index' : function(event,idx){
						var $this=$(this),images=$this.data('images'),img;
						if(!images || idx > images.length-1 || idx < 0) return;

						$this.data('index',idx)
							.find('#fancy_add-photo_url').val(images[idx].src).end()
							.find('.photo').attr('src', images[idx].src).end()
							.find('.size').html(images[idx].width+' &times; '+images[idx].height).end()
							.find('.cur_').text((idx+1)+' of '+images.length).end()
							.find('.prev').disable(idx < 1).end()
							.find('.next').disable(idx > images.length-2).end();
					},
					next : function(event){
						var $this=$(this),idx=$this.data('index')||0;
						if(typeof idx != 'number') idx = parseInt(idx);
						$this.trigger('set.index', idx+1);
					},
					prev : function(event){
						var $this=$(this),idx=$this.data('index')||0;
						if(typeof idx != 'number') idx = parseInt(idx);
						$this.trigger('set.index', idx-1);
					}
				})
				.find('.prev').click(function(){ $(this).closest('.step').trigger('prev') }).end()
				.find('.next').click(function(){ $(this).closest('.step').trigger('next') }).end()
				.find('.btn-blue-embo-add')
					.click(function(){
						var $btn=$(this), $step=$btn.closest('.step'), fields, req_url, key, datatype, val, params={via:'web'};

						req_url  = $step.data('req_url');
						fields   = $step.data('fields').split(' ');
//						datatype = req_url.match(/\.(json|xml)$/)[1];
						datatype = 'json';

						for(var i=0,c=fields.length; i < c; i++){
							key = fields[i];
							val = $step.find('#fancy_add-'+key).val();
							params[key] = val;
						}

						if(!params['name']) return alert(gettext('Please enter title'));
						if(!params['category']) return alert(gettext('Please select category'));
						if(params['photo_url'] && params['link']) params['tag_url'] = params['link'];
						params['image'] = $step.data('img_name');
						$btn.disable().addClass('loading');

						function json_handler(json){
							if(!json) return;
							if(json.status_code == 1){
								location.href = json.thing_url;
							} else if (json.status_code == 0 && json.message){
								alert(json.message);
							}
						};

						function xml_handler(xml){
							var $xml = $(xml), $st = $xml.find('status_code');
							if(!$st.length) return;
							if($st.text() == '1'){
								location.href = $xml.find('thing_url').text();
							} else if ($st.text() == '0' && $xml.find('message').length){
								alert($xml.find('message').text());
							}
						};

						$.ajax({
							type : 'post',
							url  : req_url,
							data : params,
							dataType : datatype,
							success  : datatype=='xml'?xml_handler:json_handler,
							complete : function(){
								$btn.disable(false).removeClass('loading');
							}
						});
					})
				.end()
			.end();

		// when drag files over document, show "drop to upload" message
		$(window).on({
			dragenter : function(event){
				var ev, dt;

				event.preventDefault();

				if(($_drag_objs=$_drag_objs.add(event.target)).length > 1 || !(ev=event.originalEvent) || !(dt=ev.dataTransfer)) return;
				if(dt.types.indexOf ? dt.types.indexOf('Files') == -1 : !dt.types.contains('application/x-moz-file')) return;
				if($container.is(':visible') && !dlg_add.showing()) return;

				dlg_drop.open();
			},
			dragleave : function(event){
				var ev, dt;

				event.preventDefault();

				if(($_drag_objs=$_drag_objs.not(event.target)).length || !(ev=event.originalEvent) || !(dt=ev.dataTransfer)) return;
				if(!dlg_drop.showing()) return;

				dlg_drop.close();
			}
		});
		$container.bind({
			dragover : function(event){ event.preventDefault() },
			drop : function(event){
				var ev, dt, images=[];

				event.preventDefault();
				if(!(ev=event.originalEvent) || !(dt=ev.dataTransfer) || !dt.files || !dt.files.length) return;

				$_drag_objs = $();

				for(var i=0,c=dt.files.length; i < c; i++) {
					if(/\.(jpe?g|gif|png)$/i.test(dt.files[i].name)) images.push(dt.files[i]);
				}

				if(!images.length) {
					dlg_add.open().$obj.trigger('tab','step0-error');
					return;
				}

				dlg_add.open().$obj.trigger('tab','step2-upload').find('form').trigger('submit',[images]);
			}
		});
	})();
	// }}}
	if ($.browser.msie && parseInt($.browser.version, 10) < 9) {
		$('body').addClass('ie');
	}
});

jQuery(function($){
    var checkClickId = function(hash) {
        var q = hash.indexOf("?");
        var smarttrk_ad = false;
        var click_id = false;
        if (q >= 0) {
            var kv = hash.substr(q+1).split("&");
            var cid = "";
            for (var i = 0; i < kv.length; ++i) {
                var p = kv[i].split("=");
                if (p[0] == "ClickID" && p[1].length > 0) {
                    click_id = true;
                    cid = p[1];
                }
                else if (p[0] == 'ref' && p[1] == 'da') {
                    smarttrk_ad = true;
                }
            }

            if (click_id == true) {
                var expire = new Date();
                var time = expire.getTime();
                time += 1800 * 1000;
                expire.setTime(time);
                if (smarttrk_ad == true) {
                    document.cookie = 'ck_da_clickid' + '='+ cid +'; path=/; expires='+expire.toUTCString();
                } else {
                    document.cookie = 'ck_secco_clickid' + '='+ cid +'; path=/; expires='+expire.toUTCString();
                }
            }
            return;
        }
    }
    checkClickId(location.hash);
    checkClickId(location.search);
});