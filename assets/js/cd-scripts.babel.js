import smoothscroll from 'smoothscroll-polyfill'
smoothscroll.polyfill()

document.addEventListener('DOMContentLoaded', () => {
  const body = document.body
  const wpAdminBar = document.getElementById('wpadminbar')
  const header = document.getElementById('header')
  const headerMenu = document.getElementById('header-menu')
  const siteInfo = document.querySelector('#header .site-info')
  const searchToggle = document.querySelector('.header-inner .search-toggle')

  /*   Remove link shadows on images link
  /* -------------------------------------------------- */
  {
    const images = document.querySelectorAll('.entry img')
    if (images) {
      for (const image of images) {
        const parent = image.parentNode
        if (parent.tagName === 'A') {
          parent.style.boxShadow = 'none'
        }
      }
    }
  }

  /*   Masonry responsive widgets
  /* -------------------------------------------------- */
  {
    const sidebarInner = document.querySelector('#sidebar-s1 .sidebar-inner')
    const widgets = document.querySelectorAll('#sidebar-s1 .widget')

    if (widgets) {
      const masonryHandler = () => {
        if (
          window.matchMedia('(max-width: 980px) and (min-width: 641px)')
            .matches ||
          document.body.classList.contains('bottom-sidebar-s1')
        ) {
          /* eslint-disable-next-line no-unused-vars, no-undef */
          const msnry = new Masonry(sidebarInner, {
            itemSelector: '.widget',
            percentPosition: !0,
            isAnimated: !0
          })
          if (widgets) {
            for (const widget of widgets) {
              widget.style.position = 'absolute'
            }
          }
        } else {
          if (widgets) {
            for (const widget of widgets) {
              widget.style.position = ''
              widget.style.top = ''
              widget.style.left = ''
            }
          }
        }
      }
      window.addEventListener('load', masonryHandler)
      window.addEventListener('resize', masonryHandler)
    }
  }

  /*   Back To Top
  /* -------------------------------------------------- */
  {
    const backToTop = document.getElementById('back-to-top')

    if (backToTop) {
      const showBackToTop = () => {
        if (window.pageYOffset > 100) {
          backToTop.style.display = 'block'
          backToTop.classList.remove('is-hidden')
          backToTop.classList.add('is-shown')
        } else {
          backToTop.classList.add('is-hidden')
          backToTop.classList.remove('is-shown')
          setTimeout(() => {
            backToTop.classList.remove('clicked')
          }, 400)
        }
      }
      window.addEventListener('scroll', showBackToTop)

      const scrollToTop = event => {
        event.preventDefault()
        if (event.target.classList.contains('is-hidden')) {
          return
        }
        window.scroll({
          top: 0,
          behavior: 'smooth'
        })
        backToTop.classList.add('clicked')
      }
      backToTop.addEventListener('click', scrollToTop)

      const stickBackToTopOnFooter = () => {
        const scrollHeight = body.scrollHeight
        const scrollPosition = window.pageYOffset + window.innerHeight
        const footerHeight = document.querySelector('.footer-bottom').clientHeight
        if (scrollHeight - scrollPosition < footerHeight) {
          backToTop.style.bottom = `${footerHeight + 5}px`
          backToTop.classList.add('abs')
        } else {
          backToTop.style.bottom = ''
          backToTop.classList.remove('abs')
        }
      }
      window.addEventListener('scroll', stickBackToTopOnFooter)
    }
  }

  /*   Smooth Scroll
  /* -------------------------------------------------- */
  {
    const headerInner = document.querySelector('#header .header-inner')
    const links = document.querySelectorAll('a[href*="#"]:not(.noscroll)')

    const inPageLinkHandler = event => {
      let href = event.target.getAttribute('href') // Get href attr of the link
      let hrefPageUrl = href.split('#')[0]
      let currentUrl = location.href.split('#')[0]

      if (hrefPageUrl === currentUrl || hrefPageUrl === '') {
        event.preventDefault()
        // If the link goes on the same page, run smooth scroll
        href = href.split('#').pop()
        let target
        if (href === '#' || href === '') {
          target = document.documentElement
        } else {
          target = document.getElementById(href)
        }
        const rect = target.getBoundingClientRect()
        let targetPosition = window.pageYOffset + rect.top
        if (window.matchMedia('(min-width: 767px)').matches) {
          if (
            body.classList.contains('admin-bar') &&
            window.getComputedStyle(wpAdminBar).getPropertyValue('position') ===
              'fixed'
          ) {
            // When the admin bar is shown.
            targetPosition -= wpAdminBar.clientHeight
          }
          if (
            body.classList.contains('sticky-header') &&
            body.classList.contains('header-row')
          ) {
            // When the header is sticky.
            targetPosition -= headerInner.clientHeight
          } else if (
            body.classList.contains('sticky-header') &&
            body.classList.contains('header-column') &&
            body.classList.contains('header-menu-enabled')
          ) {
            targetPosition -= headerMenu.clientHeight
          }
        }
        window.scroll({
          top: targetPosition,
          behavior: 'smooth'
        })
      }
    }

    for (const link of links) {
      link.addEventListener('click', inPageLinkHandler)
    }
  }

  /*   Sticky Header
  /* -------------------------------------------------- */
  if (body.classList.contains('sticky-header')) {
    const stickyHeaderHandler = () => {
      const siteInfoHgt = siteInfo.offsetHeight
      let scrollTop = window.pageYOffset

      // Reset values on devices smaller than 768px.
      if (!window.matchMedia('(min-width: 767px)').matches) {
        header.classList.remove('sticky')
        body.style.paddingTop = ''
        header.style.top = ''
        searchToggle.style.top = ''
        searchToggle.style.height = ''
      }

      // When header row is set
      if (body.classList.contains('header-row')) {
        // Do nothing on devices smaller than 768px.
        if (!window.matchMedia('(min-width: 767px)').matches) {
          return
        }

        if (scrollTop > 0) {
          // On scroll
          header.classList.add('sticky')
          body.style.paddingTop = `${header.clientHeight}px`
        } else {
          // Not on scroll
          header.classList.remove('sticky')
          body.style.paddingTop = ''
        }
      }

      // When header column is set
      else if (body.classList.contains('header-column')) {
        // Abort on devices smaller than 768px.
        if (!window.matchMedia('(min-width: 767px)').matches) {
          return
        }

        // Adjust search toggle behavior for the sticky header
        if (body.classList.contains('header-menu-enabled')) {
          if (scrollTop > 0) {
            // On scroll
            const headerMenuHgt = headerMenu.clientHeight
            searchToggle.style.top = `${siteInfoHgt}px`
            searchToggle.style.height = `${headerMenuHgt}px`
          } else {
            // Not on scroll
            searchToggle.style.top = scrollTop
            searchToggle.style.height = ''
          }
        }

        // Sticky header
        if (scrollTop > siteInfoHgt) {
          // On scroll
          header.classList.add('sticky')
          body.style.paddingTop = `${header.clientHeight}px`
          if (body.classList.contains('admin-bar')) {
            // When user is logged in
            header.style.top = `${-siteInfoHgt + wpAdminBar.clientHeight}px`
          } else {
            header.style.top = `${-siteInfoHgt}px`
          }
        } else {
          // Not on scroll - Remove sticky header
          header.classList.remove('sticky')
          body.style.paddingTop = ''
          header.style.top = ''
        }
      }
    }
    stickyHeaderHandler()
    window.addEventListener('resize', stickyHeaderHandler)
    window.addEventListener('scroll', stickyHeaderHandler)
  }

  /*   Fix : Padding of the menu on mobile devices
  /* -------------------------------------------------- */
  const getMenuPaddingTop = (includesAdminBar = true) => {
    let height = siteInfo.offsetHeight
    if (body.classList.contains('admin-bar') && includesAdminBar) {
      height += wpAdminBar.clientHeight
    }
    return height
  }

  const headerNav = document.getElementById('header-nav')

  if (headerNav) {
    const fixMobilePaddingOnMenu = () => {
      if (
        body.classList.contains('header-menu-enabled') &&
        window.matchMedia('(max-width: 767px)').matches
      ) {
        headerNav.style.paddingTop = `${getMenuPaddingTop()}px`
      } else {
        headerNav.style.paddingTop = '0'
      }
    }
    fixMobilePaddingOnMenu()
    window.addEventListener('resize', fixMobilePaddingOnMenu)
  }

  /*   Toggle : Search Toggle
  /* -------------------------------------------------- */
  {
    let toggleState = false
    const closeToggle = document.querySelector(
      '.modal-search-form .close-toggle'
    )
    const modalSearchDialog = document.getElementById('modal-search-form')

    if (searchToggle) {
      // Open Search toggle
      const searchToggleHandler = () => {
        toggleState = true
        if (toggleState) {
          searchToggle.classList.add('open')
          body.classList.add('modal-search-open')
          body.classList.remove('modal-search-closed')

          // Keyboard navigation - prevent from navigating outside of modal
          if (!modalSearchDialog.querySelector('#modal-search-backdrop')) {
            const backdrop = document.createElement('div')
            backdrop.setAttribute('id', 'modal-search-backdrop')
            backdrop.setAttribute('tabindex', '0')
            modalSearchDialog.appendChild(backdrop)
            const focusBackToFirstElInModal = () => {
              document.querySelector('.modal-search-form .search-inner').focus()
            }
            backdrop.addEventListener('focus', focusBackToFirstElInModal)
          }

          if (
            !modalSearchDialog.querySelector('#modal-search-forward-focus-trap')
          ) {
            const forwardTrap = document.createElement('div')
            forwardTrap.setAttribute('id', 'modal-search-forward-focus-trap')
            forwardTrap.setAttribute('tabindex', '0')
            modalSearchDialog.insertBefore(
              forwardTrap,
              modalSearchDialog.childNodes[0]
            )
            const focusToFirstElInModal = () => {
              document.querySelector('.modal-search-form .search-inner').focus()
            }
            forwardTrap.addEventListener('focus', focusToFirstElInModal)
          }

          if (body.classList.contains('modal-search-open')) {
            setTimeout(() => {
              document.querySelector('.modal-search-form .search-inner').focus()
            }, 160)
          }
        }
      }
      searchToggle.addEventListener('click', searchToggleHandler)

      // Close toggle
      const closeToggleHandler = () => {
        toggleState = false
        if (!toggleState) {
          searchToggle.classList.remove('open')
          body.classList.remove('modal-search-open')
          body.classList.add('modal-search-closed')
          searchToggle.focus()
        }
      }
      closeToggle.addEventListener('click', closeToggleHandler)

      // Close toggle when pressing `esc` key
      document.onkeydown = event => {
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
    }
  }

  /*   Toggle : Nav Menu Toggle
  /* -------------------------------------------------- */
  {
    let navCount = 0
    const navToggle = document.querySelector('.nav-toggle.header-menu')
    const menuCloseButton = document.getElementById('close-mobile-menu')

    if (navToggle) {
      const menuOverlay = document.createElement('div')
      menuOverlay.classList.add('menu-overlay')
      if (headerMenu) {
        headerMenu.insertBefore(menuOverlay, null)
      }

      const navToggleHandler = () => {
        let top = 0
        navCount++
        if (navCount % 2 === 1) {
          // Opens menu.
          navToggle.classList.add('open')
          headerMenu.classList.add('open')
          body.classList.remove('header-menu-closed')

          if (body.classList.contains('admin-bar')) {
            top += wpAdminBar.clientHeight
          }
          navToggle.style.position = 'fixed'
          navToggle.style.top = `${top}px`
          navToggle.style.height = `${getMenuPaddingTop(false)}px`
        } else if (navCount % 2 === 0) {
          navToggle.classList.remove('open')
          headerMenu.classList.remove('open')
          body.classList.add('header-menu-closed')

          navToggle.style.position = 'relative'
          navToggle.style.top = 'auto'
          navToggle.style.height = 'auto'
        }
      }
      navToggle.addEventListener('click', navToggleHandler)

      const menuOverlayHandler = () => {
        navToggle.classList.remove('open')
        headerMenu.classList.remove('open')
        headerMenu.classList.add('closed')
        navToggle.classList.add('closed')
        body.classList.add('header-menu-closed')

        navToggle.style.position = 'relative'
        navToggle.style.top = 'auto'
        navToggle.style.height = 'auto'
      }
      menuOverlay.addEventListener('click', menuOverlayHandler)
      menuCloseButton.addEventListener('click', menuOverlayHandler)

      const handleAriaAttribute = () => {
        if (window.matchMedia('(min-width: 768px)').matches) {
          navToggle.setAttribute('aria-hidden', 'true')
        } else {
          navToggle.removeAttribute('aria-hidden')
        }
      }
      window.addEventListener('resize', handleAriaAttribute)
      handleAriaAttribute()
    }

    const setElementOrder = () => {
      const items = document.querySelector('#header > .header-inner')
      if (window.matchMedia('(max-width: 767px)').matches) {
        if (items.childNodes[3].id === 'header-menu') {
          items.insertBefore(
            items.childNodes[3],
            items.childNodes[items.childNodes.length - 1]
          )
        }
      } else {
        const possibleKeys = [3, 4, 5, 6]
        for (const key of possibleKeys) {
          if (!items.childNodes[key]) {
            return
          }
          if (
            items.childNodes[key].classList &&
            items.childNodes[key].classList.contains('search-toggle')
          ) {
            items.insertBefore(
              items.childNodes[key],
              items.childNodes[items.childNodes.length - 1]
            )
          }
        }
      }
    }
    setElementOrder()
    window.addEventListener('resize', setElementOrder)
  }

  /*   Menu : Submenu handling on focus
  /* -------------------------------------------------- */
  {
    /**
     * Find the most parent in the nested sub menu.
     *
     * @param {HTMLElement} el
     * @return {HTMLElement}
     */
    const getTheParent = el => {
      const parent = el.parentElement

      if (parent.classList.contains('menu-container')) {
        return el
      }

      return getTheParent(parent)
    }

    /**
     * @private
     * @param {HTMLElement} el
     * @return {boolean|HTMLElement}
     */
    const findClosestSubMenu = el => {
      if (
        el.parentElement.classList.contains('menu-container') ||
        !el.parentElement
      ) {
        return false
      }
      if (el.parentElement.classList.contains('menu-item-has-children')) {
        return el.parentElement
      }
      return findClosestSubMenu(el.parentElement)
    }

    /**
     * Get all the parent menu items.
     *
     * @param {HTMLElement} el
     * @return {Array<HTMLElement>|[]}
     */
    const getAllParentSubMenus = el => {
      const parents = []

      let res = el
      do {
        res = findClosestSubMenu(res)
        if (res) {
          parents.push(res)
        }
      } while (res)

      return parents
    }

    const parentMenus = document.querySelectorAll(
      '.menu-container li'
    )

    parentMenus.forEach(parentEl => {
      const allMenus = getAllParentSubMenus(parentEl)
      const mostParent = getTheParent(parentEl)
      const allMenuLinks = mostParent.querySelectorAll('a')

      ;[...parentEl.children]
        .filter(childEl => {
          return childEl.tagName === 'A' || childEl.tagName === 'a'
        })
        .forEach(linkEl => {
          linkEl.addEventListener('focusin', () => {
            if ([...allMenuLinks].includes(document.activeElement)) {
              allMenus.forEach(subMenu => {
                subMenu.classList.add('is-sub-menu-shown')
              })
            }
          })
          linkEl.addEventListener('blur', () => {
            if (![...allMenuLinks].includes(document.activeElement)) {
              allMenus.forEach(subMenu => {
                subMenu.classList.remove('is-sub-menu-shown')
              })
            }
          })
        })
    })
  }

  /*   Pagination : Underline Animate
  /* -------------------------------------------------- */
  {
    const pageNumbers = document.querySelector('ul.page-numbers')
    const pageNumbersEls = document.querySelectorAll('ul.page-numbers li')
    const currentPageNumber = document.querySelector('ul.page-numbers .current')

    if (pageNumbers) {
      const currentParent = currentPageNumber.parentNode
      const actionBarWrapper = document.createElement('li')
      actionBarWrapper.classList.add('action-bar-wrapper')
      const actionBar = document.createElement('span')
      actionBar.classList.add('action-bar')
      actionBar.style.width = `${currentParent.offsetWidth}px`
      actionBar.style.left = `${currentParent.offsetLeft}px`
      actionBarWrapper.appendChild(actionBar)
      pageNumbers.insertBefore(actionBarWrapper, null)
      currentPageNumber.style.borderBottom = 0

      const pageNumbersElHoverHandler = event => {
        actionBar.style.width = `${event.target.parentNode.offsetWidth}px`
        actionBar.style.left = `${event.target.parentNode.offsetLeft}px`
      }
      const pageNumbersElHoverOutHandler = () => {
        actionBar.style.width = `${currentParent.offsetWidth}px`
        actionBar.style.left = `${currentParent.offsetLeft}px`
      }
      for (const el of pageNumbersEls) {
        el.addEventListener('mouseover', pageNumbersElHoverHandler)
        el.addEventListener('mouseout', pageNumbersElHoverOutHandler)
      }
    }
  }

  /*   Comments : Comment Tab
  /* -------------------------------------------------- */
  {
    const tabmenu = document.querySelector('#comments .comment-tabmenu')
    const tabItems = document.querySelectorAll('#comments .tabitem')
    const actionBar = document.createElement('span')
    const pingList = document.getElementById('ping-list')
    const commentList = document.getElementById('comment-list')

    if (tabmenu) {
      actionBar.classList.add('action-bar')
      tabmenu.insertBefore(actionBar, null)
      actionBar.style.width = `${tabItems[0].clientWidth}px`
    }

    if (pingList) {
      pingList.style.display = 'none'
    }

    const tabItemsHandler = event => {
      event.preventDefault()
      const target = event.target

      // Do nothing when clicked the item which is already active
      if (target.parentNode.classList.contains('active')) {
        return
      }

      if (target.getAttribute('href').includes('#comment')) {
        target.parentNode.classList.add('active')
        tabItems[1].classList.remove('active')
        if (commentList) {
          commentList.classList.add('active')
          commentList.style.display = 'block'
        }
        if (pingList) {
          pingList.classList.remove('active')
          pingList.style.display = 'none'
        }
      } else if (target.getAttribute('href').includes('#ping')) {
        target.parentNode.classList.add('active')
        tabItems[0].classList.remove('active')
        if (pingList) {
          pingList.classList.add('active')
          pingList.style.display = 'block'
        }
        if (commentList) {
          commentList.classList.remove('active')
          commentList.style.display = 'none'
        }
      }

      actionBar.style.width = `${target.offsetWidth}px`
      actionBar.style.left = `${target.parentNode.offsetLeft}px`
    }

    for (const item of tabItems) {
      item.addEventListener('click', tabItemsHandler)
    }
  }

  /*   Recent Posts Widget : Adjust the date style
  /* -------------------------------------------------- */
  {
    const dates = document.querySelectorAll('.widget_recent_entries .post-date')

    if (dates) {
      for (const date of dates) {
        if (date.previousElementSibling.tagName === 'A') {
          const parent = date.previousElementSibling
          parent.innerHTML = `<span class="recent_entries_post-title">${parent.textContent}</span>`
          const titleNode = date.previousElementSibling.children[0]
          parent.insertBefore(date, titleNode)
        }
      }
    }
  }
})
