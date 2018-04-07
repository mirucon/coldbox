'use strict';

/* eslint no-undef: 0, brace-style: 0. */
jQuery(function ($) {
  var $body = $('body');
  var $wpadminbar = $('#wpadminbar');
  var $header = $('#header');
  var $headerMenu = $('#header-nav');
  var $navToggle = $('.nav-toggle.header-menu');
  var $pageNumbers = $('ul.page-numbers');
  var $currentPageNumber = $('ul.page-numbers .current');
  var $searchToggle = $('.search-toggle');

  /*   Back To Top
  /* -------------------------------------------------- */
  $(window).on('load scroll', function () {
    if ($(this).scrollTop() > 100) {
      $('a#back-to-top').fadeIn(600);
    } else {
      $('a#back-to-top').fadeOut(600);
      setTimeout(function () {
        $('a#back-to-top').removeClass('clicked');
      }, 400);
    }
  });
  $('a#back-to-top').click(function () {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
    $('a#back-to-top').addClass('clicked');
    return false;
  });
  $(window).on('load scroll', function () {
    var scrollHeight = $(document).height();
    var scrollPosition = $(window).height() + $(window).scrollTop();
    var footHeight = $('.footer-bottom').innerHeight();
    if (scrollHeight - scrollPosition < footHeight) {
      $('#back-to-top').css({ 'bottom': footHeight });
      $('a#back-to-top').addClass('abs');
    } else {
      $('#back-to-top').css({ 'bottom': '' });
      $('a#back-to-top').removeClass('abs');
    }
  });

  /*   Smooth Scroll
  /* -------------------------------------------------- */
  $('a[href*="#"]').not('.noscroll').not('a[href^="#comment-list"]').not('a[href^="#ping-list"]').click(function () {
    var href = $(this).prop('href'); // Get property of the link
    var hrefPageUrl = href.split('#')[0];
    var currentUrl = location.href;
    currentUrl = currentUrl.split('#')[0];

    if (hrefPageUrl === currentUrl) {
      // If the link goes to current page
      href = '#' + href.split('#').pop();
      var target = $(href === '#' || href === '' ? 'html' : href); // Get where it goes
      var position = target.offset().top; // Get the offset value
      if (window.matchMedia('(min-width: 767px)').matches) {
        if ($wpadminbar.css('position') === 'fixed') {
          // When the admin bar is shown.
          position -= $wpadminbar.outerHeight();
        }
        if ($body.hasClass('sticky-header') && $body.hasClass('header-row')) {
          // When the header is sticky.
          position -= $header.height();
        } else if ($body.hasClass('sticky-header') && $body.hasClass('header-column')) {
          position -= $headerMenu.height();
        }
      }
      $('body, html').animate({ scrollTop: position }, 300); // Smooth Scroll
      return false;
    }
  });

  /*   Sticky Header
  /* -------------------------------------------------- */
  if ($body.hasClass('sticky-header')) {
    $(window).on('load scroll resize', function () {
      var siteInfoHgt = $('.site-info').outerHeight();
      var scrollTop = $(window).scrollTop();

      // Reset values on devices smaller than 768px.
      if (!window.matchMedia('(min-width: 767px)').matches) {
        $header.removeClass('sticky');
        $body.css({ paddingTop: '' });
        $header.css({ top: '' });
        $searchToggle.css({ top: '', height: '' });
      }

      // When header row is set
      if ($body.hasClass('header-row')) {
        // Abort on devices smaller than 768px.
        if (!window.matchMedia('(min-width: 767px)').matches) {
          return;
        }

        if (scrollTop > 0) {
          // On scroll
          $header.addClass('sticky');
          $body.css({ paddingTop: $header.height() });
        } else {
          // Not on scroll
          $header.removeClass('sticky');
          $body.css({ paddingTop: '' });
        }
      }

      // When header column is set
      else if ($body.hasClass('header-column')) {
          // Abort on devices smaller than 768px.
          if (!window.matchMedia('(min-width: 767px)').matches) {
            return;
          }

          // Adjust search toggle behavior for the sticky header
          if ($body.hasClass('header-menu-enabled')) {
            // If header menu is set
            if (scrollTop > 0) {
              // On scroll
              var headerMenuHeight = $('#header-menu').height();
              $searchToggle.css({ top: siteInfoHgt, height: headerMenuHeight });
              $('.header-searchbar').css({ top: siteInfoHgt + headerMenuHeight / 1.3 });
            } else {
              // Not on scroll
              $searchToggle.css({ top: scrollTop, height: '' });
            }
          }

          // Sticky header
          if (scrollTop > 0 + siteInfoHgt) {
            // On scroll
            $header.addClass('sticky');
            $body.css({ paddingTop: $header.height() });
            if ($body.hasClass('admin-bar')) {
              // When logging in
              $header.css({ top: -siteInfoHgt + $wpadminbar.innerHeight() });
            } else {
              $header.css({ top: -siteInfoHgt });
            }
          } else {
            // Not on scroll
            // Remove sticky header
            $header.removeClass('sticky');
            $body.css({ paddingTop: '' });
            $header.css({ top: '' });
          }
        }
    });
  }

  /*   Fix : Padding of the menu on mobile devices
  /* -------------------------------------------------- */
  $(window).on('load resize', function () {
    if ($body.hasClass('header-menu-enabled') && window.matchMedia('(max-width: 767px)').matches) {
      var padding = $('.site-info').outerHeight();
      if ($body.hasClass('admin-bar')) {
        padding += $wpadminbar.innerHeight();
      }
      $('#header-nav').css({ paddingTop: padding });
    } else {
      $('#header-nav').css({ paddingTop: '' });
    }
  });

  /*   Toggle : Search Toggle
  /* -------------------------------------------------- */
  var searchCount = 0;

  $('.search-toggle, .close-toggle').not('.search-form').click(function () {
    $(this).toggleClass('open');
    $body.toggleClass('modal-search-open');
    if ($body.hasClass('modal-search-open')) {
      setTimeout(function () {
        $('.modal-search-form .search-inner').focus();
      }, 290);
    }
    searchCount++;
    if (searchCount % 2 === 0) {
      $body.addClass('modal-search-closed');
    }
    if (searchCount % 2 === 1) {
      $body.removeClass('modal-search-closed');
    }
  });

  $(window).keyup(function (e) {
    // Close the window when pressing esc key
    if (e.keyCode === 27) {
      $body.removeClass('modal-search-open');
    }
  });

  /*   Toggle : Nav Menu Toggle
  /* -------------------------------------------------- */
  var navCount = 0;

  $('#header-menu').append('<span class="menu-overlay"></span>');
  $navToggle.click(function () {
    $(this).toggleClass('open');
    navCount++;
    if (navCount % 2 === 0) {
      $body.addClass('header-menu-closed');
    }
    if (navCount % 2 === 1) {
      $body.removeClass('header-menu-closed');
    }
  });

  $('.menu-overlay').click(function () {
    $navToggle.removeClass('open');
    $navToggle.addClass('closed');
    $body.addClass('header-menu-closed');
  });

  /*   Multipage Link : Underline Animate
  /* -------------------------------------------------- */
  if ($pageNumbers.length) {
    $pageNumbers.append('<span class="action-bar"></span>');
    $currentPageNumber.css({ borderBottom: 0 });
    $('ul.page-numbers .action-bar').css({
      width: $currentPageNumber.outerWidth(),
      left: $currentPageNumber.parent('li').position().left
    });
    $('ul.page-numbers li').hover(function () {
      $('ul.page-numbers .action-bar').stop().css({
        width: $(this).outerWidth(),
        left: $(this).position().left
      });
    }, function () {
      $('ul.page-numbers .action-bar').css({
        width: $currentPageNumber.outerWidth(),
        left: $currentPageNumber.parent('li').position().left
      });
    });
  }

  /*   Comments : Comment Tab
  /* -------------------------------------------------- */
  $('#ping-list').hide();
  $('.comment-tabmenu').append('<span class="action-bar"></span>');
  $('.comment-tabmenu .action-bar').css({ width: $('.tabitem:first-of-type').outerWidth() });
  $('.comment-tabmenu li').click(function () {
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
  if ($('.widget_recent_entries .post-date').length) {
    $('.post-date').each(function (e) {
      if ($(this).prev('a')) {
        $(this).html($(this).html() + ' ').prependTo($(this).prev('a'));
      }
    });
  }
});