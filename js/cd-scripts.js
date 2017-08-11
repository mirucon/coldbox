jQuery(function($) {

	/*   Back To Top
	/* -------------------------------------------------- */
	$(window).on( 'load scroll', function() {
		if ( $(this).scrollTop() > 100 ) {
			$('a#back-to-top').fadeIn(600);
		} else {
			$('a#back-to-top').fadeOut(600);
			setTimeout(function() {
				$('a#back-to-top').removeClass('clicked');
			}, 400);
		}
	});
	$('a#back-to-top').click( function() {
		$('html, body').animate({ scrollTop:0 }, 'slow');
		$('a#back-to-top').addClass('clicked');
		return false;
	});
	$(window).on('load scroll', function() {
		scrollHeight = $(document).height();
		scrollPosition = $(window).height() + $(window).scrollTop();
		btnHeight = $('a#back-to-top').innerHeight() / 2;
		footHeight = $('.footer').innerHeight();
		if ( scrollHeight - scrollPosition < footHeight) {
			$('#back-to-top').css({'bottom': footHeight});
			$('a#back-to-top').addClass('abs');
		} else {
			$('#back-to-top').css({'bottom': ''});
			$('a#back-to-top').removeClass('abs');
		}
	});


	/*   Smooth Scroll
	/* -------------------------------------------------- */
	$('a[href*="#"]').not('.noscroll').not('a[href^="#comment-list"]').not('a[href^="#ping-list"]').click( function() {
		var href = $(this).prop('href'); // Get property of the link
		var hrefPageUrl = href.split('#')[0];
		var currentUrl = location.href;
		var currentUrl = currentUrl.split('#')[0];
		if ( hrefPageUrl == currentUrl ) { // If the link goes to current page
			href = href.split('#');
			href = href.pop();
			href = '#' + href;
			var target = $( href == '#' || href == '' ? 'html' : href ); // Get where it goes
			var position = target.offset().top; // Get the offset value
			if ( window.matchMedia('(min-width: 767px)').matches ) {
				if ( $('#wpadminbar').css('position') == 'fixed' ) { // When logged in
					position -= $('#wpadminbar').outerHeight();
				}
				if ( $('#header').css('position') == 'fixed' ) { // When header is sticked
					position -= $('#header').height();
				}
				if ( $('body').hasClass('header-column') ) {
					position += $('.site-info').innerHeight();
				}
			}
			$('body, html').animate({ scrollTop: position }, 300 ); // Smooth Scroll
			return false;
		}
	});


	/*   Sticky Header
	/* -------------------------------------------------- */
	if ( $('body').hasClass('sticky-header') ) {

		$(window).on( 'load scroll resize', function() {
			var header = $('#header');
			var siteInfoHgt = $('.site-info').outerHeight();

			if ( window.matchMedia('(min-width: 767px)').matches ) {
				var scrollTop = $(window).scrollTop();
			} else {
				var scrollTop = 0;
			}

			// When header row is set
			if ( $('body').hasClass('header-row') ) {
				if ( scrollTop > 0 ) { // On scroll
					header.addClass('sticky');
					$('body').css({paddingTop: header.height() });
				} else { // Not on scroll
					header.removeClass('sticky');
					$('body').css({paddingTop: ''});
				}
			}

			// When header column is set
			else if ( $('body').hasClass('header-column') ) {
				// Adjust search toggle behavior for the sticky header
				if ( $('body').hasClass('header-menu-enabled') ) { // If header menu is set
					if ( window.matchMedia('(min-width: 767px)').matches ) { // On PC view
						if ( scrollTop > 0 ) { // On scroll
							$('.search-toggle').css({top: siteInfoHgt, height: $('#header-menu').height() });
							$('.header-searchbar').css({top: siteInfoHgt + $('#header-menu').height() / 1.3});
						} else { // Not on scroll
							$('.search-toggle').css({top: scrollTop, height: ''});
						}
					} else { // On mobile view
						$('.search-toggle').css({top: '', height: ''});
					}
				}
				// Sticky header
				if ( scrollTop > 0 + siteInfoHgt ) { // On scroll
					header.addClass('sticky');
					$('body').css({ paddingTop: $(header).height() });
					if ( $('body').hasClass('admin-bar') ) { // When logging in
						header.css({ top: -siteInfoHgt + $('#wpadminbar').innerHeight() });
					} else {
						header.css({ top: -siteInfoHgt });
					}
				} else { // Not on scroll
					// Remove sticky header
					header.removeClass('sticky');
					$('body').css({paddingTop: ''});
					header.css({top: ''});
				}
			}
		});

	}

	/*   Fix : Padding of the menu on mobile devices
	/* -------------------------------------------------- */
	$(window).on( 'load resize', function() {
		if ( $('body').hasClass('header-menu-enabled') && window.matchMedia('(max-width: 767px)').matches ) {
			var padding = $('.site-info').outerHeight();
			if ( $('body').hasClass('admin-bar') ) { padding +=  $('#wpadminbar').innerHeight(); }
			$('#header-nav').css({paddingTop: padding});
		} else {
			$('#header-nav').css({paddingTop: ''});
		}
	});


	/*   Toggle : Search Toggle
	/* -------------------------------------------------- */
	var count = 0;

	$('.search-toggle, .close-toggle').not('.search-form').click( function() {
		$(this).toggleClass('open');
		$('body').toggleClass('modal-search-open');
		setTimeout( function() {
			$('.modal-search-form .search-inner').focus();
		}, 400);
		count++;
		if ( count % 2 == 0 ) { $('body').addClass('modal-search-closed'); }
		if ( count % 2 == 1 ) { $('body').removeClass('modal-search-closed'); }
	});

	$(window).keyup( function(e){ // Close the window when pressing esc key
		if ( e.keyCode == 27 ) { $('body').removeClass('modal-search-open') }
	});


	/*   Toggle : Nav Menu Toggle
	/* -------------------------------------------------- */
	var count = 0;

	$('#header-menu').append('<span class="menu-overlay"></span>');
	$('.nav-toggle.header-menu').click( function() {
		$(this).toggleClass('open');
		count++;
		if ( count % 2 == 0 ) { $('body').addClass('header-menu-closed'); }
		if ( count % 2 == 1 ) { $('body').removeClass('header-menu-closed'); }
	});

	$('.menu-overlay').click( function() {
		$('.nav-toggle.header-menu').removeClass('open');
		$('.nav-toggle.header-menu').addClass('closed');
		$('body').addClass('header-menu-closed');
	})


	/*   Multipage Link : Underline Animate
	/* -------------------------------------------------- */
	if ( $('ul.page-numbers').length ) {
		$('ul.page-numbers').append('<span class="action-bar"></span>');
		$('ul.page-numbers .current').css({borderBottom: 0});
		$('ul.page-numbers .action-bar').css({
			width: $('ul.page-numbers .current').outerWidth(),
			left: $('ul.page-numbers .current').parent('li').position().left
		});
		$('ul.page-numbers li').hover(function() {
			$('ul.page-numbers .action-bar').stop().css({
				width: $(this).outerWidth(),
				left: $(this).position().left
			});
		}, function() {
			$('ul.page-numbers .action-bar').css({
				width: $('ul.page-numbers .current').outerWidth(),
				left: $('ul.page-numbers .current').parent('li').position().left
			});
		});
	}


	/*   Comments : Comment Tab
	/* -------------------------------------------------- */
	$('#ping-list').hide();
	$('.comment-tabmenu').append('<span class="action-bar"></span>');
	$('.comment-tabmenu .action-bar').css({ width: $('.tabitem:first-of-type').outerWidth() });
	$('.comment-tabmenu li').click(function() {
		$('.comment-tabmenu li').removeClass('active');
		$(this).addClass('active');
		$('#comments ol').hide();
		$($(this).children('a').attr('href')).fadeIn();
		$('.comment-tabmenu .action-bar').css({
			width: $(this).outerWidth(),
			left: $(this).position().left
		});
		return false;
	});

	/*   Recent Posts Widget : Adjust the date style
	/* -------------------------------------------------- */
	if ( $('.widget_recent_entries .post-date').length ) {
		$('.post-date').each(function(e) {
			if ( $(this).prev('a') ) {
				$(this).html($(this).html()+" ").prependTo($(this).prev('a'));
			}
		});
	}

});