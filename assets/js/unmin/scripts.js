/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _smoothscrollPolyfill = __webpack_require__(1);

var _smoothscrollPolyfill2 = _interopRequireDefault(_smoothscrollPolyfill);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

_smoothscrollPolyfill2.default.polyfill();

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

  if (widgets) {
    var masonryHandler = function masonryHandler() {
      if (window.matchMedia('(max-width: 980px) and (min-width: 641px)').matches || document.body.classList.contains('bottom-sidebar-s1')) {
        /* eslint-disable-next-line no-unused-vars, no-undef */
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
  }

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
  window.addEventListener('scroll', stickBackToTopOnFooter);

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

  if (headerNav) {
    var fixMobilePaddingOnMenu = function fixMobilePaddingOnMenu() {
      if (body.classList.contains('header-menu-enabled') && window.matchMedia('(max-width: 767px)').matches) {
        headerNav.style.paddingTop = getMenuPaddingTop() + 'px';
      } else {
        headerNav.style.paddingTop = '0';
      }
    };
    fixMobilePaddingOnMenu();
    window.addEventListener('resize', fixMobilePaddingOnMenu);
  }

  /*   Toggle : Search Toggle
  /* -------------------------------------------------- */
  var toggleState = false;
  var closeToggle = document.querySelector('.modal-search-form .close-toggle');

  if (searchToggle) {
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
  }

  /*   Toggle : Nav Menu Toggle
  /* -------------------------------------------------- */
  var navCount = 0;
  var navToggle = document.querySelector('.nav-toggle.header-menu');

  if (navToggle) {
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
  }

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

/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

/* smoothscroll v0.4.0 - 2018 - Dustan Kasten, Jeremias Menichelli - MIT License */
(function () {
  'use strict';

  // polyfill
  function polyfill() {
    // aliases
    var w = window;
    var d = document;

    // return if scroll behavior is supported and polyfill is not forced
    if (
      'scrollBehavior' in d.documentElement.style &&
      w.__forceSmoothScrollPolyfill__ !== true
    ) {
      return;
    }

    // globals
    var Element = w.HTMLElement || w.Element;
    var SCROLL_TIME = 468;

    // object gathering original scroll methods
    var original = {
      scroll: w.scroll || w.scrollTo,
      scrollBy: w.scrollBy,
      elementScroll: Element.prototype.scroll || scrollElement,
      scrollIntoView: Element.prototype.scrollIntoView
    };

    // define timing method
    var now =
      w.performance && w.performance.now
        ? w.performance.now.bind(w.performance)
        : Date.now;

    /**
     * indicates if a the current browser is made by Microsoft
     * @method isMicrosoftBrowser
     * @param {String} userAgent
     * @returns {Boolean}
     */
    function isMicrosoftBrowser(userAgent) {
      var userAgentPatterns = ['MSIE ', 'Trident/', 'Edge/'];

      return new RegExp(userAgentPatterns.join('|')).test(userAgent);
    }

    /*
     * IE has rounding bug rounding down clientHeight and clientWidth and
     * rounding up scrollHeight and scrollWidth causing false positives
     * on hasScrollableSpace
     */
    var ROUNDING_TOLERANCE = isMicrosoftBrowser(w.navigator.userAgent) ? 1 : 0;

    /**
     * changes scroll position inside an element
     * @method scrollElement
     * @param {Number} x
     * @param {Number} y
     * @returns {undefined}
     */
    function scrollElement(x, y) {
      this.scrollLeft = x;
      this.scrollTop = y;
    }

    /**
     * returns result of applying ease math function to a number
     * @method ease
     * @param {Number} k
     * @returns {Number}
     */
    function ease(k) {
      return 0.5 * (1 - Math.cos(Math.PI * k));
    }

    /**
     * indicates if a smooth behavior should be applied
     * @method shouldBailOut
     * @param {Number|Object} firstArg
     * @returns {Boolean}
     */
    function shouldBailOut(firstArg) {
      if (
        firstArg === null ||
        typeof firstArg !== 'object' ||
        firstArg.behavior === undefined ||
        firstArg.behavior === 'auto' ||
        firstArg.behavior === 'instant'
      ) {
        // first argument is not an object/null
        // or behavior is auto, instant or undefined
        return true;
      }

      if (typeof firstArg === 'object' && firstArg.behavior === 'smooth') {
        // first argument is an object and behavior is smooth
        return false;
      }

      // throw error when behavior is not supported
      throw new TypeError(
        'behavior member of ScrollOptions ' +
          firstArg.behavior +
          ' is not a valid value for enumeration ScrollBehavior.'
      );
    }

    /**
     * indicates if an element has scrollable space in the provided axis
     * @method hasScrollableSpace
     * @param {Node} el
     * @param {String} axis
     * @returns {Boolean}
     */
    function hasScrollableSpace(el, axis) {
      if (axis === 'Y') {
        return el.clientHeight + ROUNDING_TOLERANCE < el.scrollHeight;
      }

      if (axis === 'X') {
        return el.clientWidth + ROUNDING_TOLERANCE < el.scrollWidth;
      }
    }

    /**
     * indicates if an element has a scrollable overflow property in the axis
     * @method canOverflow
     * @param {Node} el
     * @param {String} axis
     * @returns {Boolean}
     */
    function canOverflow(el, axis) {
      var overflowValue = w.getComputedStyle(el, null)['overflow' + axis];

      return overflowValue === 'auto' || overflowValue === 'scroll';
    }

    /**
     * indicates if an element can be scrolled in either axis
     * @method isScrollable
     * @param {Node} el
     * @param {String} axis
     * @returns {Boolean}
     */
    function isScrollable(el) {
      var isScrollableY = hasScrollableSpace(el, 'Y') && canOverflow(el, 'Y');
      var isScrollableX = hasScrollableSpace(el, 'X') && canOverflow(el, 'X');

      return isScrollableY || isScrollableX;
    }

    /**
     * finds scrollable parent of an element
     * @method findScrollableParent
     * @param {Node} el
     * @returns {Node} el
     */
    function findScrollableParent(el) {
      var isBody;

      do {
        el = el.parentNode;

        isBody = el === d.body;
      } while (isBody === false && isScrollable(el) === false);

      isBody = null;

      return el;
    }

    /**
     * self invoked function that, given a context, steps through scrolling
     * @method step
     * @param {Object} context
     * @returns {undefined}
     */
    function step(context) {
      var time = now();
      var value;
      var currentX;
      var currentY;
      var elapsed = (time - context.startTime) / SCROLL_TIME;

      // avoid elapsed times higher than one
      elapsed = elapsed > 1 ? 1 : elapsed;

      // apply easing to elapsed time
      value = ease(elapsed);

      currentX = context.startX + (context.x - context.startX) * value;
      currentY = context.startY + (context.y - context.startY) * value;

      context.method.call(context.scrollable, currentX, currentY);

      // scroll more if we have not reached our destination
      if (currentX !== context.x || currentY !== context.y) {
        w.requestAnimationFrame(step.bind(w, context));
      }
    }

    /**
     * scrolls window or element with a smooth behavior
     * @method smoothScroll
     * @param {Object|Node} el
     * @param {Number} x
     * @param {Number} y
     * @returns {undefined}
     */
    function smoothScroll(el, x, y) {
      var scrollable;
      var startX;
      var startY;
      var method;
      var startTime = now();

      // define scroll context
      if (el === d.body) {
        scrollable = w;
        startX = w.scrollX || w.pageXOffset;
        startY = w.scrollY || w.pageYOffset;
        method = original.scroll;
      } else {
        scrollable = el;
        startX = el.scrollLeft;
        startY = el.scrollTop;
        method = scrollElement;
      }

      // scroll looping over a frame
      step({
        scrollable: scrollable,
        method: method,
        startTime: startTime,
        startX: startX,
        startY: startY,
        x: x,
        y: y
      });
    }

    // ORIGINAL METHODS OVERRIDES
    // w.scroll and w.scrollTo
    w.scroll = w.scrollTo = function() {
      // avoid action when no arguments are passed
      if (arguments[0] === undefined) {
        return;
      }

      // avoid smooth behavior if not required
      if (shouldBailOut(arguments[0]) === true) {
        original.scroll.call(
          w,
          arguments[0].left !== undefined
            ? arguments[0].left
            : typeof arguments[0] !== 'object'
              ? arguments[0]
              : w.scrollX || w.pageXOffset,
          // use top prop, second argument if present or fallback to scrollY
          arguments[0].top !== undefined
            ? arguments[0].top
            : arguments[1] !== undefined
              ? arguments[1]
              : w.scrollY || w.pageYOffset
        );

        return;
      }

      // LET THE SMOOTHNESS BEGIN!
      smoothScroll.call(
        w,
        d.body,
        arguments[0].left !== undefined
          ? ~~arguments[0].left
          : w.scrollX || w.pageXOffset,
        arguments[0].top !== undefined
          ? ~~arguments[0].top
          : w.scrollY || w.pageYOffset
      );
    };

    // w.scrollBy
    w.scrollBy = function() {
      // avoid action when no arguments are passed
      if (arguments[0] === undefined) {
        return;
      }

      // avoid smooth behavior if not required
      if (shouldBailOut(arguments[0])) {
        original.scrollBy.call(
          w,
          arguments[0].left !== undefined
            ? arguments[0].left
            : typeof arguments[0] !== 'object' ? arguments[0] : 0,
          arguments[0].top !== undefined
            ? arguments[0].top
            : arguments[1] !== undefined ? arguments[1] : 0
        );

        return;
      }

      // LET THE SMOOTHNESS BEGIN!
      smoothScroll.call(
        w,
        d.body,
        ~~arguments[0].left + (w.scrollX || w.pageXOffset),
        ~~arguments[0].top + (w.scrollY || w.pageYOffset)
      );
    };

    // Element.prototype.scroll and Element.prototype.scrollTo
    Element.prototype.scroll = Element.prototype.scrollTo = function() {
      // avoid action when no arguments are passed
      if (arguments[0] === undefined) {
        return;
      }

      // avoid smooth behavior if not required
      if (shouldBailOut(arguments[0]) === true) {
        // if one number is passed, throw error to match Firefox implementation
        if (typeof arguments[0] === 'number' && arguments[1] === undefined) {
          throw new SyntaxError('Value could not be converted');
        }

        original.elementScroll.call(
          this,
          // use left prop, first number argument or fallback to scrollLeft
          arguments[0].left !== undefined
            ? ~~arguments[0].left
            : typeof arguments[0] !== 'object' ? ~~arguments[0] : this.scrollLeft,
          // use top prop, second argument or fallback to scrollTop
          arguments[0].top !== undefined
            ? ~~arguments[0].top
            : arguments[1] !== undefined ? ~~arguments[1] : this.scrollTop
        );

        return;
      }

      var left = arguments[0].left;
      var top = arguments[0].top;

      // LET THE SMOOTHNESS BEGIN!
      smoothScroll.call(
        this,
        this,
        typeof left === 'undefined' ? this.scrollLeft : ~~left,
        typeof top === 'undefined' ? this.scrollTop : ~~top
      );
    };

    // Element.prototype.scrollBy
    Element.prototype.scrollBy = function() {
      // avoid action when no arguments are passed
      if (arguments[0] === undefined) {
        return;
      }

      // avoid smooth behavior if not required
      if (shouldBailOut(arguments[0]) === true) {
        original.elementScroll.call(
          this,
          arguments[0].left !== undefined
            ? ~~arguments[0].left + this.scrollLeft
            : ~~arguments[0] + this.scrollLeft,
          arguments[0].top !== undefined
            ? ~~arguments[0].top + this.scrollTop
            : ~~arguments[1] + this.scrollTop
        );

        return;
      }

      this.scroll({
        left: ~~arguments[0].left + this.scrollLeft,
        top: ~~arguments[0].top + this.scrollTop,
        behavior: arguments[0].behavior
      });
    };

    // Element.prototype.scrollIntoView
    Element.prototype.scrollIntoView = function() {
      // avoid smooth behavior if not required
      if (shouldBailOut(arguments[0]) === true) {
        original.scrollIntoView.call(
          this,
          arguments[0] === undefined ? true : arguments[0]
        );

        return;
      }

      // LET THE SMOOTHNESS BEGIN!
      var scrollableParent = findScrollableParent(this);
      var parentRects = scrollableParent.getBoundingClientRect();
      var clientRects = this.getBoundingClientRect();

      if (scrollableParent !== d.body) {
        // reveal element inside parent
        smoothScroll.call(
          this,
          scrollableParent,
          scrollableParent.scrollLeft + clientRects.left - parentRects.left,
          scrollableParent.scrollTop + clientRects.top - parentRects.top
        );

        // reveal parent in viewport unless is fixed
        if (w.getComputedStyle(scrollableParent).position !== 'fixed') {
          w.scrollBy({
            left: parentRects.left,
            top: parentRects.top,
            behavior: 'smooth'
          });
        }
      } else {
        // reveal element in viewport
        w.scrollBy({
          left: clientRects.left,
          top: clientRects.top,
          behavior: 'smooth'
        });
      }
    };
  }

  if (true) {
    // commonjs
    module.exports = { polyfill: polyfill };
  } else {}

}());


/***/ })
/******/ ]);