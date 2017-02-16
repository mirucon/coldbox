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
      $('#back-to-top').css({'bottom':  ''});
      $('a#back-to-top').removeClass('abs');
    }
  });


  /*   Smooth Scroll
  /* -------------------------------------------------- */
  $('a[href*=#]').not('.noscroll').not('a[href^="#comment-list"]').not('a[href^="#ping-list"]').click(function() {
    var href = $(this).prop('href');
    var hrefPageUrl = href.split('#')[0];
    var currentUrl = location.href;
    var currentUrl = currentUrl.split('#')[0];
    if ( hrefPageUrl == currentUrl ) {
      href = href.split('#');
      href = href.pop();
      href = '#' + href;
      var target = $( href == '#' || href == '' ? 'html' : href );
      var position = target.offset().top;
      if ( $('body').hasClass('topmenu-sticky') && $('#topmenu').css('position') === 'fixed' ) {
        position -= $('#topmenu').innerHeight();
      }
      if ( $('#wpadminbar').css('position') == 'fixed' ) {
        position -= $('#wpadminbar').outerHeight();
      }
      $('body,html').animate({scrollTop:position}, 400);
      console.log ( '%cSmooth Scroll ' + 'Go To ' + position, 'color:#39c' );
      return false;
    }
  });


  /*   Sticky Header
  /* -------------------------------------------------- */
  $(window).on('load scroll resize', function() {
    var header = $('#header');
    var offset = header.offset();
    var headerHgt = header.height();
    var siteInfo = $('.site-info');
    var siteInfoHgt = $('.site-info').outerHeight();
    var siteInfoHgtRev = -siteInfoHgt;

    if ( window.matchMedia('(min-width: 767px)').matches ) {
      var scrollTop = $(window).scrollTop();
    } else {
      var scrollTop = 0;
    }

    if ( $('body').hasClass('header-row') ) {
      if ( scrollTop > 0 ) {
        header.addClass('sticky');
        $('body').css({paddingTop: headerHgt});
      } else {
        header.removeClass('sticky');
        $('body').css({paddingTop: ''});
      }
    }

     else if ( $('body').hasClass('header-column') ) {
      if ( $('body').hasClass('header-menu-enabled') ) {
        if ( scrollTop >= 0 && scrollTop < siteInfoHgt ) {
          $('.search-toggle').css({top: scrollTop});
          if ( window.matchMedia('(min-width: 767px)').matches ) {
            $('.header-search').css({top: scrollTop + 48});
          }
        } else {
          $('.search-toggle').css({top: siteInfoHgt, position: ''});
          $('.header-search').css({top: ''});
        }
      }
      if ( scrollTop > 0 + siteInfoHgt ) {
        header.addClass('sticky');
        $('body').css({ paddingTop: headerHgt });
        if ( $('body').hasClass('admin-bar') ) {
          var adminHeight = $('#wpadminbar').innerHeight();
          header.css({top: siteInfoHgtRev + adminHeight});
        } else { header.css({ top: siteInfoHgtRev }); }
      } else {
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
    $('.header-search').stop().fadeToggle(300);
    setTimeout(function(){
      $('.header-search .search-inner').focus();
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


});
