'use strict';

document.addEventListener('DOMContentLoaded', function () {
  var body = document.body;
  var wpAdminBar = document.getElementById('wpadminbar');
  var header = document.getElementById('header');
  var headerMenu = document.getElementById('header-menu');
  var siteInfo = document.querySelector('#header .site-info');
  var searchToggle = document.querySelector('.header-inner .search-toggle');

  /*   Remove link shadows on images link
  /* -------------------------------------------------- */
  var images = document.querySelectorAll('.entry img');
  if (images) {
    var _iteratorNormalCompletion = true;
    var _didIteratorError = false;
    var _iteratorError = undefined;

    try {
      for (var _iterator = images[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
        var image = _step.value;

        var parent = image.parentNode;
        if (parent.tagName === 'A') {
          parent.style.boxShadow = 'none';
        }
      }
    } catch (err) {
      _didIteratorError = true;
      _iteratorError = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion && _iterator.return) {
          _iterator.return();
        }
      } finally {
        if (_didIteratorError) {
          throw _iteratorError;
        }
      }
    }
  }

  /*   Masonry responsive widgets
  /* -------------------------------------------------- */
  var sidebarInner = document.querySelector('#sidebar-s1 .sidebar-inner');
  var widgets = document.querySelectorAll('.widget');
  var masonryHandler = function masonryHandler() {
    if (window.matchMedia('(max-width: 980px) and (min-width: 641px)').matches || document.body.classList.contains('bottom-sidebar-s1')) {
      var msnry = new Masonry(sidebarInner, {
        itemSelector: '.widget',
        percentPosition: !0,
        isAnimated: !0
      });
      if (widgets) {
        var _iteratorNormalCompletion2 = true;
        var _didIteratorError2 = false;
        var _iteratorError2 = undefined;

        try {
          for (var _iterator2 = widgets[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
            var widget = _step2.value;

            widget.style.position = 'absolute';
          }
        } catch (err) {
          _didIteratorError2 = true;
          _iteratorError2 = err;
        } finally {
          try {
            if (!_iteratorNormalCompletion2 && _iterator2.return) {
              _iterator2.return();
            }
          } finally {
            if (_didIteratorError2) {
              throw _iteratorError2;
            }
          }
        }
      }
    } else {
      if (widgets) {
        var _iteratorNormalCompletion3 = true;
        var _didIteratorError3 = false;
        var _iteratorError3 = undefined;

        try {
          for (var _iterator3 = widgets[Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
            var _widget = _step3.value;

            _widget.style.position = '';
            _widget.style.top = '';
            _widget.style.left = '';
          }
        } catch (err) {
          _didIteratorError3 = true;
          _iteratorError3 = err;
        } finally {
          try {
            if (!_iteratorNormalCompletion3 && _iterator3.return) {
              _iterator3.return();
            }
          } finally {
            if (_didIteratorError3) {
              throw _iteratorError3;
            }
          }
        }
      }
    }
  };
  window.addEventListener('load', masonryHandler);
  window.addEventListener('resize', masonryHandler);

  /*   Back To Top
  /* -------------------------------------------------- */
  var backToTop = document.getElementById('back-to-top');

  var showBackToTop = function showBackToTop() {
    if (window.pageYOffset > 100) {
      backToTop.style.display = 'block';
      backToTop.classList.add('is-shown');
    } else {
      backToTop.style.display = 'none';
      backToTop.classList.remove('is-shown');
      setTimeout(function () {
        backToTop.classList.remove('clicked');
      }, 400);
    }
  };
  window.addEventListener('scroll', showBackToTop);

  var scrollToTop = function scrollToTop(event) {
    event.preventDefault();
    window.scroll({
      top: 0,
      behavior: 'smooth'
    });
    backToTop.classList.add('clicked');
  };
  backToTop.addEventListener('click', scrollToTop);

  var stickBackToTopOnFooter = function stickBackToTopOnFooter() {
    var scrollHeight = body.scrollHeight;
    var scrollPosition = window.pageYOffset + window.innerHeight;
    var footerHeight = document.getElementById('footer').clientHeight;
    if (scrollHeight - scrollPosition < footerHeight) {
      backToTop.style.bottom = footerHeight + 'px';
      backToTop.classList.add('abs');
    } else {
      backToTop.style.bottom = '';
      backToTop.classList.remove('abs');
    }
  };
  addEventListener('scroll', stickBackToTopOnFooter);

  /*   Smooth Scroll
  /* -------------------------------------------------- */
  var headerInner = document.querySelector('#header .header-inner');
  var links = document.querySelectorAll('a[href*="#"]:not(.noscroll)');

  var inPageLinkHandler = function inPageLinkHandler(event) {
    event.preventDefault();
    var href = event.target.getAttribute('href'); // Get href attr of the link
    var hrefPageUrl = href.split('#')[0];
    var currentUrl = location.href.split('#')[0];

    if (hrefPageUrl === currentUrl || hrefPageUrl === '') {
      // If the link goes on the same page, run smooth scroll
      href = href.split('#').pop();
      var target = void 0;
      if (href === '#' || href === '') {
        target = document.documentElement;
      } else {
        target = document.getElementById(href);
      }
      var rect = target.getBoundingClientRect();
      var targetPosition = window.pageYOffset + rect.top;
      if (window.matchMedia('(min-width: 767px)').matches) {
        if (body.classList.contains('admin-bar') && window.getComputedStyle(wpAdminBar).getPropertyValue('position') === 'fixed') {
          // When the admin bar is shown.
          targetPosition -= wpAdminBar.clientHeight;
        }
        if (body.classList.contains('sticky-header') && body.classList.contains('header-row')) {
          // When the header is sticky.
          targetPosition -= headerInner.clientHeight;
        } else if (body.classList.contains('sticky-header') && body.classList.contains('header-column') && body.classList.contains('header-menu-enabled')) {
          targetPosition -= headerMenu.clientHeight;
        }
      }
      window.scroll({
        top: targetPosition,
        behavior: 'smooth'
      });
    }
  };

  var _iteratorNormalCompletion4 = true;
  var _didIteratorError4 = false;
  var _iteratorError4 = undefined;

  try {
    for (var _iterator4 = links[Symbol.iterator](), _step4; !(_iteratorNormalCompletion4 = (_step4 = _iterator4.next()).done); _iteratorNormalCompletion4 = true) {
      var link = _step4.value;

      link.addEventListener('click', inPageLinkHandler);
    }

    /*   Sticky Header
    /* -------------------------------------------------- */
  } catch (err) {
    _didIteratorError4 = true;
    _iteratorError4 = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion4 && _iterator4.return) {
        _iterator4.return();
      }
    } finally {
      if (_didIteratorError4) {
        throw _iteratorError4;
      }
    }
  }

  if (body.classList.contains('sticky-header')) {
    var stickyHeaderHandler = function stickyHeaderHandler() {
      var siteInfoHgt = siteInfo.offsetHeight;
      var scrollTop = window.pageYOffset;

      // Reset values on devices smaller than 768px.
      if (!window.matchMedia('(min-width: 767px)').matches) {
        header.classList.remove('sticky');
        body.style.paddingTop = '';
        header.style.top = '';
        searchToggle.style.top = '';
        searchToggle.style.height = '';
      }

      // When header row is set
      if (body.classList.contains('header-row')) {
        // Do nothing on devices smaller than 768px.
        if (!window.matchMedia('(min-width: 767px)').matches) {
          return;
        }

        if (scrollTop > 0) {
          // On scroll
          header.classList.add('sticky');
          body.style.paddingTop = header.clientHeight + 'px';
        } else {
          // Not on scroll
          header.classList.remove('sticky');
          body.style.paddingTop = '';
        }
      }

      // When header column is set
      else if (body.classList.contains('header-column')) {
          // Abort on devices smaller than 768px.
          if (!window.matchMedia('(min-width: 767px)').matches) {
            return;
          }

          // Adjust search toggle behavior for the sticky header
          if (body.classList.contains('header-menu-enabled')) {
            if (scrollTop > 0) {
              // On scroll
              var headerMenuHgt = headerMenu.clientHeight;
              searchToggle.style.top = siteInfoHgt + 'px';
              searchToggle.style.height = headerMenuHgt + 'px';
            } else {
              // Not on scroll
              searchToggle.style.top = scrollTop;
              searchToggle.style.height = '';
            }
          }

          // Sticky header
          if (scrollTop > siteInfoHgt) {
            // On scroll
            header.classList.add('sticky');
            body.style.paddingTop = header.clientHeight + 'px';
            if (body.classList.contains('admin-bar')) {
              // When user is logged in
              header.style.top = -siteInfoHgt + wpAdminBar.clientHeight + 'px';
            } else {
              header.style.top = -siteInfoHgt + 'px';
            }
          } else {
            // Not on scroll - Remove sticky header
            header.classList.remove('sticky');
            body.style.paddingTop = '';
            header.style.top = '';
          }
        }
    };
    stickyHeaderHandler();
    window.addEventListener('resize', stickyHeaderHandler);
    window.addEventListener('scroll', stickyHeaderHandler);
  }

  /*   Fix : Padding of the menu on mobile devices
  /* -------------------------------------------------- */
  var getMenuPaddingTop = function getMenuPaddingTop() {
    var includesAdminBar = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;

    var height = siteInfo.offsetHeight;
    if (body.classList.contains('admin-bar') && includesAdminBar) {
      height += wpAdminBar.clientHeight;
    }
    return height;
  };

  var headerNav = document.getElementById('header-nav');

  var fixMobilePaddingOnMenu = function fixMobilePaddingOnMenu() {
    if (body.classList.contains('header-menu-enabled') && window.matchMedia('(max-width: 767px)').matches) {
      headerNav.style.paddingTop = getMenuPaddingTop() + 'px';
    } else {
      headerNav.style.paddingTop = '0';
    }
  };
  fixMobilePaddingOnMenu();
  window.addEventListener('resize', fixMobilePaddingOnMenu);

  /*   Toggle : Search Toggle
  /* -------------------------------------------------- */
  var toggleState = false;
  var closeToggle = document.querySelector('.modal-search-form .close-toggle');

  // Search toggle
  var searchToggleHandler = function searchToggleHandler() {
    toggleState = true;
    if (toggleState) {
      searchToggle.classList.add('open');
      body.classList.add('modal-search-open');
      body.classList.remove('modal-search-closed');

      if (body.classList.contains('modal-search-open')) {
        setTimeout(function () {
          document.querySelector('.modal-search-form .search-inner').focus();
        }, 290);
      }
    }
  };
  searchToggle.addEventListener('click', searchToggleHandler);

  // Close toggle
  var closeToggleHandler = function closeToggleHandler() {
    toggleState = false;
    if (!toggleState) {
      searchToggle.classList.remove('open');
      body.classList.remove('modal-search-open');
      body.classList.add('modal-search-closed');
    }
  };
  closeToggle.addEventListener('click', closeToggleHandler);

  document.onkeydown = function (event) {
    event = event || window.event;
    if (event.keyCode === 27) {
      toggleState = false;
      if (!toggleState) {
        searchToggle.classList.remove('open');
        body.classList.remove('modal-search-open');
        body.classList.add('modal-search-closed');
      }
    }
  };

  /*   Toggle : Nav Menu Toggle
  /* -------------------------------------------------- */
  var navCount = 0;
  var navToggle = document.querySelector('.nav-toggle.header-menu');

  var menuOverlay = document.createElement('div');
  menuOverlay.classList.add('menu-overlay');
  if (headerMenu) {
    headerMenu.insertBefore(menuOverlay, null);
  }

  var navToggleHandler = function navToggleHandler() {
    var top = 0;
    navCount++;
    if (navCount % 2 === 1) {
      navToggle.classList.add('open');
      body.classList.add('header-menu-closed');

      if (body.classList.contains('admin-bar')) {
        top += wpAdminBar.clientHeight;
      }
      navToggle.style.position = 'fixed';
      navToggle.style.top = top + 'px';
      navToggle.style.height = getMenuPaddingTop(false) + 'px';
    } else if (navCount % 2 === 0) {
      navToggle.classList.remove('open');
      body.classList.remove('header-menu-closed');

      navToggle.style.position = 'relative';
      navToggle.style.top = 'auto';
      navToggle.style.height = 'auto';
    }
  };
  navToggle.addEventListener('click', navToggleHandler);

  var menuOverlayHandler = function menuOverlayHandler() {
    navToggle.classList.remove('open');
    navToggle.classList.add('closed');
    body.classList.add('header-menu-closed');

    navToggle.style.position = 'relative';
    navToggle.style.top = 'auto';
    navToggle.style.height = 'auto';
  };
  menuOverlay.addEventListener('click', menuOverlayHandler);

  /*   Pagination : Underline Animate
  /* -------------------------------------------------- */
  var pageNumbers = document.querySelector('ul.page-numbers');
  var pageNumbersEls = document.querySelectorAll('ul.page-numbers li');
  var currentPageNumber = document.querySelector('ul.page-numbers .current');

  if (pageNumbers) {
    var currentParent = currentPageNumber.parentNode;
    var _actionBar = document.createElement('span');
    _actionBar.classList.add('action-bar');
    _actionBar.style.width = currentParent.offsetWidth + 'px';
    _actionBar.style.left = currentParent.offsetLeft + 'px';
    pageNumbers.insertBefore(_actionBar, null);
    currentPageNumber.style.borderBottom = 0;

    var pageNumbersElHoverHandler = function pageNumbersElHoverHandler(event) {
      _actionBar.style.width = event.target.parentNode.offsetWidth + 'px';
      _actionBar.style.left = event.target.parentNode.offsetLeft + 'px';
    };
    var pageNumbersElHoverOutHandler = function pageNumbersElHoverOutHandler() {
      _actionBar.style.width = currentParent.offsetWidth + 'px';
      _actionBar.style.left = currentParent.offsetLeft + 'px';
    };
    var _iteratorNormalCompletion5 = true;
    var _didIteratorError5 = false;
    var _iteratorError5 = undefined;

    try {
      for (var _iterator5 = pageNumbersEls[Symbol.iterator](), _step5; !(_iteratorNormalCompletion5 = (_step5 = _iterator5.next()).done); _iteratorNormalCompletion5 = true) {
        var el = _step5.value;

        el.addEventListener('mouseover', pageNumbersElHoverHandler);
        el.addEventListener('mouseout', pageNumbersElHoverOutHandler);
      }
    } catch (err) {
      _didIteratorError5 = true;
      _iteratorError5 = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion5 && _iterator5.return) {
          _iterator5.return();
        }
      } finally {
        if (_didIteratorError5) {
          throw _iteratorError5;
        }
      }
    }
  }

  /*   Comments : Comment Tab
  /* -------------------------------------------------- */
  var tabmenu = document.querySelector('#comments .comment-tabmenu');
  var tabItems = document.querySelectorAll('#comments .tabitem');
  var actionBar = document.createElement('span');
  var pingList = document.getElementById('ping-list');
  var commentList = document.getElementById('comment-list');

  if (tabmenu) {
    actionBar.classList.add('action-bar');
    tabmenu.insertBefore(actionBar, null);
    actionBar.style.width = tabItems[0].clientWidth + 'px';
  }

  if (pingList) {
    pingList.style.display = 'none';
  }

  var tabItemsHandler = function tabItemsHandler(event) {
    event.preventDefault();
    var target = event.target;

    // Do nothing when clicked the item which is already active
    if (target.parentNode.classList.contains('active')) {
      return;
    }

    if (target.getAttribute('href').includes('#comment')) {
      target.parentNode.classList.add('active');
      tabItems[1].classList.remove('active');
      if (commentList) {
        commentList.classList.add('active');
        commentList.style.display = 'block';
      }
      if (pingList) {
        pingList.classList.remove('active');
        pingList.style.display = 'none';
      }
    } else if (target.getAttribute('href').includes('#ping')) {
      target.parentNode.classList.add('active');
      tabItems[0].classList.remove('active');
      if (pingList) {
        pingList.classList.add('active');
        pingList.style.display = 'block';
      }
      if (commentList) {
        commentList.classList.remove('active');
        commentList.style.display = 'none';
      }
    }

    actionBar.style.width = target.offsetWidth + 'px';
    actionBar.style.left = target.parentNode.offsetLeft + 'px';
  };

  var _iteratorNormalCompletion6 = true;
  var _didIteratorError6 = false;
  var _iteratorError6 = undefined;

  try {
    for (var _iterator6 = tabItems[Symbol.iterator](), _step6; !(_iteratorNormalCompletion6 = (_step6 = _iterator6.next()).done); _iteratorNormalCompletion6 = true) {
      var item = _step6.value;

      item.addEventListener('click', tabItemsHandler);
    }

    /*   Recent Posts Widget : Adjust the date style
    /* -------------------------------------------------- */
  } catch (err) {
    _didIteratorError6 = true;
    _iteratorError6 = err;
  } finally {
    try {
      if (!_iteratorNormalCompletion6 && _iterator6.return) {
        _iterator6.return();
      }
    } finally {
      if (_didIteratorError6) {
        throw _iteratorError6;
      }
    }
  }

  var dates = document.querySelectorAll('.widget_recent_entries .post-date');

  if (dates) {
    var _iteratorNormalCompletion7 = true;
    var _didIteratorError7 = false;
    var _iteratorError7 = undefined;

    try {
      for (var _iterator7 = dates[Symbol.iterator](), _step7; !(_iteratorNormalCompletion7 = (_step7 = _iterator7.next()).done); _iteratorNormalCompletion7 = true) {
        var date = _step7.value;

        if (date.previousElementSibling.tagName === 'A') {
          var _parent = date.previousElementSibling;
          _parent.innerHTML = '<span class="recent_entries_post-title">' + _parent.textContent + '</span>';
          var titleNode = date.previousElementSibling.children[0];
          _parent.insertBefore(date, titleNode);
        }
      }
    } catch (err) {
      _didIteratorError7 = true;
      _iteratorError7 = err;
    } finally {
      try {
        if (!_iteratorNormalCompletion7 && _iterator7.return) {
          _iterator7.return();
        }
      } finally {
        if (_didIteratorError7) {
          throw _iteratorError7;
        }
      }
    }
  }
});