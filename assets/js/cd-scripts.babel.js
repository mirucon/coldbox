/* eslint no-undef: 0, brace-style: 0. */
jQuery($ => {
  const $body = $('body')
  const body = document.body
  const $wpadminbar = $('#wpadminbar')
  const $header = $('#header')
  const header = document.getElementById('header')
  const $headerMenu = $('#header-nav')
  const $navToggle = $('.nav-toggle.header-menu')
  const $pageNumbers = $('ul.page-numbers')
  const $currentPageNumber = $('ul.page-numbers .current')
  const $searchToggle = $('.search-toggle')

  /*   Back To Top
  /* -------------------------------------------------- */
  $(window).on('load scroll', function() {
    if ($(this).scrollTop() > 100) {
      $('a#back-to-top').fadeIn(600)
    } else {
      $('a#back-to-top').fadeOut(600)
      setTimeout(function() {
        $('a#back-to-top').removeClass('clicked')
      }, 400)
    }
  })
  $('a#back-to-top').click(function() {
    $('html, body').animate({ scrollTop: 0 }, 'slow')
    $('a#back-to-top').addClass('clicked')
    return false
  })
  $(window).on('load scroll', function() {
    let scrollHeight = $(document).height()
    let scrollPosition = $(window).height() + $(window).scrollTop()
    let footHeight = $('.footer-bottom').innerHeight()
    if (scrollHeight - scrollPosition < footHeight) {
      $('#back-to-top').css({ bottom: footHeight })
      $('a#back-to-top').addClass('abs')
    } else {
      $('#back-to-top').css({ bottom: '' })
      $('a#back-to-top').removeClass('abs')
    }
  })

  /*   Smooth Scroll
  /* -------------------------------------------------- */
  $('a[href*="#"]')
    .not('.noscroll')
    .not('a[href^="#comment-list"]')
    .not('a[href^="#ping-list"]')
    .click(function() {
      let href = $(this).prop('href') // Get property of the link
      let hrefPageUrl = href.split('#')[0]
      let currentUrl = location.href
      currentUrl = currentUrl.split('#')[0]

      if (hrefPageUrl === currentUrl) {
        // If the link goes to current page
        href = '#' + href.split('#').pop()
        let target = $(href === '#' || href === '' ? 'html' : href) // Get where it goes
        let position = target.offset().top // Get the offset value
        if (window.matchMedia('(min-width: 767px)').matches) {
          if ($wpadminbar.css('position') === 'fixed') {
            // When the admin bar is shown.
            position -= $wpadminbar.outerHeight()
          }
          if ($body.hasClass('sticky-header') && $body.hasClass('header-row')) {
            // When the header is sticky.
            position -= $header.height()
          } else if (
            $body.hasClass('sticky-header') &&
            $body.hasClass('header-column')
          ) {
            position -= $headerMenu.height()
          }
        }
        $('body, html').animate({ scrollTop: position }, 300) // Smooth Scroll
        return false
      }
    })

  /*   Sticky Header
  /* -------------------------------------------------- */
  if ($body.hasClass('sticky-header')) {
    $(window).on('load scroll resize', () => {
      let siteInfoHgt = $('.site-info').outerHeight()
      let scrollTop = $(window).scrollTop()

      // Reset values on devices smaller than 768px.
      if (!window.matchMedia('(min-width: 767px)').matches) {
        $header.removeClass('sticky')
        $body.css({ paddingTop: '' })
        $header.css({ top: '' })
        $searchToggle.css({ top: '', height: '' })
      }

      // When header row is set
      if (body.className.includes('header-row')) {

        // Abort on devices smaller than 768px.
        if (!window.matchMedia('(min-width: 767px)').matches) {
          return
        }

        if (scrollTop > 0) {
          // On scroll
          header.classList.add('sticky')
          $body.css({ paddingTop: $header.height() })
        } else {
          // Not on scroll
          header.classList.remove('sticky')
          $body.css({ paddingTop: '' })
        }
      }

      // When header column is set
      else if ($body.hasClass('header-column')) {
        // Abort on devices smaller than 768px.
        if (!window.matchMedia('(min-width: 767px)').matches) {
          return
        }

        // Adjust search toggle behavior for the sticky header
        if ($body.hasClass('header-menu-enabled')) {
          // If header menu is set
          if (scrollTop > 0) {
            // On scroll
            let headerMenuHeight = $('#header-menu').height()
            $searchToggle.css({ top: siteInfoHgt, height: headerMenuHeight })
            $('.header-searchbar').css({
              top: siteInfoHgt + headerMenuHeight / 1.3
            })
          } else {
            // Not on scroll
            $searchToggle.css({ top: scrollTop, height: '' })
          }
        }

        // Sticky header
        if (scrollTop > 0 + siteInfoHgt) {
          // On scroll
          $header.addClass('sticky')
          $body.css({ paddingTop: $header.height() })
          if ($body.hasClass('admin-bar')) {
            // When logging in
            $header.css({ top: -siteInfoHgt + $wpadminbar.innerHeight() })
          } else {
            $header.css({ top: -siteInfoHgt })
          }
        } else {
          // Not on scroll
          // Remove sticky header
          $header.removeClass('sticky')
          $body.css({ paddingTop: '' })
          $header.css({ top: '' })
        }
      }
    })
  }

  /*   Fix : Padding of the menu on mobile devices
  /* -------------------------------------------------- */
  $(window).on('load resize', function() {
    if (
      $body.hasClass('header-menu-enabled') &&
      window.matchMedia('(max-width: 767px)').matches
    ) {
      let padding = $('.site-info').outerHeight()
      if ($body.hasClass('admin-bar')) {
        padding += $wpadminbar.innerHeight()
      }
      $('#header-nav').css({ paddingTop: padding })
    } else {
      $('#header-nav').css({ paddingTop: '' })
    }
  })

  /*   [NATIVE JS] Toggle : Search Toggle
  /* -------------------------------------------------- */
  let toggleState = false
  const searchToggle = document.querySelector('.header-inner .search-toggle')
  const closeToggle = document.querySelector('.modal-search-form .close-toggle')

  // Search toggle
  const searchToggleHandler = () => {
    toggleState = true
    if (toggleState) {
      searchToggle.classList.add('open')
      body.classList.add('modal-search-open')
      body.classList.remove('modal-search-closed')
      if (searchToggle.className.includes('modal-search-open'))
        setTimeout(() => {
          document.querySelector('.modal-search-form .search-inner').focus()
        }, 290)
    }
  }
  searchToggle.addEventListener('click', searchToggleHandler)

  const closeToggleHandler = () => {
    toggleState = false
    if (!toggleState) {
      searchToggle.classList.remove('open')
      body.classList.remove('modal-search-open')
      body.classList.add('modal-search-closed')
    }
  }
  closeToggle.addEventListener('click', closeToggleHandler)

  document.onkeydown = function(event) {
    event = event || window.event
    if (event.keyCode === 27) {
      toggleState = false
      if (!toggleState) {
        searchToggle.classList.remove('open')
        body.classList.remove('modal-search-open')
        body.classList.add('modal-search-closed')
      }
    }
  }

  /*   Toggle : Nav Menu Toggle
  /* -------------------------------------------------- */
  let navCount = 0

  $('#header-menu').append('<span class="menu-overlay"></span>')
  $navToggle.click(function() {
    $(this).toggleClass('open')
    navCount++
    if (navCount % 2 === 0) {
      $body.addClass('header-menu-closed')
    }
    if (navCount % 2 === 1) {
      $body.removeClass('header-menu-closed')
    }
  })

  $('.menu-overlay').click(function() {
    $navToggle.removeClass('open')
    $navToggle.addClass('closed')
    $body.addClass('header-menu-closed')
  })

  /*   Multipage Link : Underline Animate
  /* -------------------------------------------------- */
  if ($pageNumbers.length) {
    $pageNumbers.append('<span class="action-bar"></span>')
    $currentPageNumber.css({ borderBottom: 0 })
    $('ul.page-numbers .action-bar').css({
      width: $currentPageNumber.outerWidth(),
      left: $currentPageNumber.parent('li').position().left
    })
    $('ul.page-numbers li').hover(
      function() {
        $('ul.page-numbers .action-bar')
          .stop()
          .css({
            width: $(this).outerWidth(),
            left: $(this).position().left
          })
      },
      function() {
        $('ul.page-numbers .action-bar').css({
          width: $currentPageNumber.outerWidth(),
          left: $currentPageNumber.parent('li').position().left
        })
      }
    )
  }

  /*   [NATIVE JS] Comments : Comment Tab
  /* -------------------------------------------------- */
  const tabmenu = document.querySelector('#comments .comment-tabmenu')
  const tabItems = document.querySelectorAll('#comments .tabitem')
  const actionBar = document.createElement('span')
  const pingList = document.getElementById('ping-list')
  const commentList = document.getElementById('comment-list')

  actionBar.classList.add('action-bar')
  tabmenu.insertBefore(actionBar, null)
  actionBar.style.width = `${tabItems[0].clientWidth}px`

  pingList.style.display = 'none'

  const tabItemsHandler = event => {
    const target = event.target

    // Do nothing when clicked the item which is already active
    if (target.parentNode.className.includes('active')) {
      return
    }

    if (target.getAttribute('href').includes('#comment')) {
      target.parentNode.classList.add('active')
      tabItems[1].classList.remove('active')
      commentList.classList.add('active')
      pingList.classList.remove('active')

      commentList.style.display = 'block'
      pingList.style.display = 'none'
    } else if (target.getAttribute('href').includes('#ping')) {
      target.parentNode.classList.add('active')
      tabItems[0].classList.remove('active')
      commentList.classList.remove('active')
      pingList.classList.add('active')

      commentList.style.display = 'none'
      pingList.style.display = 'block'
    }

    actionBar.style.width = `${target.offsetWidth}px`
    actionBar.style.left = `${target.parentNode.offsetLeft}px`
  }

  for (const item of tabItems) {
    item.addEventListener('click', tabItemsHandler)
  }

  /*   [NATIVE JS] Recent Posts Widget : Adjust the date style
  /* -------------------------------------------------- */
  const dates = document.querySelectorAll('.widget_recent_entries .post-date')

  if (dates) {
    for (const date of dates) {
      if (date.previousElementSibling.tagName === 'A') {
        const parent = date.previousElementSibling
        const title = `<span class="recent_entries_post-title">${parent.textContent}</span>`
        parent.innerHTML = title
        const titleNode = date.previousElementSibling.children[0]
        parent.insertBefore(date, titleNode)
      }
    }
  }
})
