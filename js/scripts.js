jQuery(function($) {

  /*   Back To Top
  /* -------------------------------------------------- */
  $(window).on('load scroll', function() {
    if ( $(this).scrollTop() > 100 ) {
      $('a#back-to-top').fadeIn(600);
    } else {
      $('a#back-to-top').fadeOut(600);
      setTimeout(function() {
        $('a#back-to-top').removeClass('clicked');
      }, 400);
    }
  });
  $('a#back-to-top').click(function() {
    $('html, body').animate({ scrollTop:0 }, 'slow');
    $('a#back-to-top').addClass('clicked');
    return false;
  });
  $(window).on('load scroll', function() {
    scrollHeight = $(document).height();
    scrollPosition = $(window).height() + $(window).scrollTop();
    btnHeight = $('a#back-to-top').innerHeight() / 2;
    footHeight = $('#footer').innerHeight();
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
  $('a[href*=#]').not('.noscroll').not('a[href^="#comment-list"]').not('a[href^="#ping-list"]').click(function() {
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
      if ( $('#wpadminbar').css('position') == 'fixed' ) { // When logged in
        position -= $('#wpadminbar').outerHeight();
      }
      if ( $('#header').css('position') == 'fixed' ) { // When header is sticked
        position -= $('#header').height();
      }
      $('body, html').animate({scrollTop:position}, 400); // Smooth Scroll
      return false;
    }
  });


  /*   Sticky Header
  /* -------------------------------------------------- */
  $(window).on('load scroll resize', function() {
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


  /*   Toggle : Nav Menu Toggle
  /* -------------------------------------------------- */
  $('.nav-toggle.header-menu, #header-menu').click(function() {
    $('.nav-toggle.header-menu').toggleClass('open');
  });


  /*   Toggle : Search Toggle
  /* -------------------------------------------------- */
  $('.search-toggle').click(function() {
    $(this).toggleClass('open');
    $('.header-searchbar').stop().fadeToggle(300);
    setTimeout(function(){
      $('.header-searchbar .search-inner').focus();
    }, 400);
  });


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


  /*   Header Menu : Undeline Animate
  /* -------------------------------------------------- */
  $('#header-nav > li').hover(function() {
    $('#header-nav .action-bar').css({
      width: $(this).outerWidth(),
      left: $(this).position().left,
      backgroundColor: ''
    });
    if ( $(this).hasClass('menu-item-has-children') ) {
      $('#header-nav .action-bar').css({ width: '200px' });
    }
  },
  function() {
    $('#header-nav .action-bar').css({ backgroundColor: 'transparent' });
  });


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

  /*   Fix : delete shadows from images
  /* -------------------------------------------------- */
  $(function() {
    $('.entry img').parent('a').css({'box-shadow':'none'});
  });


});
