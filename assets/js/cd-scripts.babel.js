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

  /*   Existing social/abbreviation tooltips: keyboard, hover and Escape support.
  /* -------------------------------------------------- */
  {
    let tooltipId = 0
    const triggers = [...document.querySelectorAll('.social-links a[title], .entry abbr[title]')]
      .filter(node => !node.closest('.widget_cd_widget_social_links') && node.title.trim())
    for (const node of triggers) {
      const tooltip = document.createElement('span')
      tooltip.className = 'cd-tooltip'
      tooltip.textContent = node.title
      tooltip.setAttribute('role', 'tooltip')
      tooltip.setAttribute('aria-hidden', 'true')
      do { tooltip.id = `cd-tooltip-${++tooltipId}` } while (document.getElementById(tooltip.id))
      if (node.tagName === 'ABBR') {
        if (!node.hasAttribute('tabindex')) node.tabIndex = 0
        const description = node.getAttribute('aria-describedby')
        node.setAttribute('aria-describedby', [description, tooltip.id].filter(Boolean).join(' '))
      }
      node.appendChild(tooltip)
      node.classList.add('cd-tooltip-ready')
      // Preserve the native title fallback when JavaScript is unavailable.
      node.removeAttribute('title')
      const open = () => {
        tooltip.style.transform = ''
        node.classList.add('cd-tooltip-open')
        const rect = tooltip.getBoundingClientRect()
        const shift = rect.left < 12 ? 12 - rect.left : Math.min(0, innerWidth - 12 - rect.right)
        if (shift) tooltip.style.transform = `translateX(${shift}px)`
      }
      node.addEventListener('pointerenter', open)
      node.addEventListener('focusin', open)
      node.addEventListener('pointerleave', () => {
        if (!node.contains(document.activeElement)) node.classList.remove('cd-tooltip-open')
      })
      node.addEventListener('focusout', () => {
        if (!node.matches(':hover')) node.classList.remove('cd-tooltip-open')
      })
    }
    document.addEventListener('keydown', event => {
      if (event.key === 'Escape') {
        for (const node of triggers) node.classList.remove('cd-tooltip-open')
      }
    })
  }

  /*   Keyboard access to content that actually needs scrolling.
  /* -------------------------------------------------- */
  {
    const scrollAreas = [...document.querySelectorAll('.entry pre, .comment-body pre, .wp-block-gallery figcaption')]
      .filter(node => !node.hasAttribute('tabindex'))
    const update = node => {
      const style = getComputedStyle(node)
      const scrolls = (/auto|scroll/.test(style.overflowX) && node.scrollWidth > node.clientWidth + 1) ||
        (/auto|scroll/.test(style.overflowY) && node.scrollHeight > node.clientHeight + 1)
      if (scrolls) node.tabIndex = 0
      else node.removeAttribute('tabindex')
    }
    const observer = new ResizeObserver(entries => entries.forEach(entry => update(entry.target)))
    scrollAreas.forEach(node => {
      update(node)
      observer.observe(node)
      // WebKit focuses gallery captions but does not scroll them with arrow keys.
      if (node.tagName === 'FIGCAPTION') node.addEventListener('keydown', event => {
        if (event.target !== node || event.defaultPrevented || node.isContentEditable || event.altKey || event.ctrlKey || event.metaKey || event.shiftKey) return
        const step = { ArrowDown: 40, ArrowUp: -40 }[event.key]
        if (!step) return
        const before = node.scrollTop
        node.scrollTop += step
        if (node.scrollTop !== before) event.preventDefault()
      })
    })
    window.addEventListener('load', () => scrollAreas.forEach(update))
    document.fonts.ready.then(() => scrollAreas.forEach(update))
  }

  /*   Masonry responsive widgets
  /* -------------------------------------------------- */
  {
    const sidebarInner = document.querySelector('#sidebar-s1 .sidebar-inner')
    const widgets = document.querySelectorAll('#sidebar-s1 .widget')

    if (sidebarInner && widgets.length) {
      const masonryHandler = () => {
        if (
          window.matchMedia('(max-width: 980px) and (min-width: 641px)')
            .matches ||
          document.body.classList.contains('bottom-sidebar-s1')
        ) {
          // Masonry loads asynchronously; an early resize can precede it.
          // The load event below performs layout once the dependency is ready.
          if (typeof Masonry !== 'function') return
          /* eslint-disable-next-line no-unused-vars, no-undef */
          const msnry = new Masonry(sidebarInner, {
            itemSelector: '.widget',
            percentPosition: !0,
            isAnimated: !0,
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

      const scrollToTop = (event) => {
        event.preventDefault()
        if (event.target.classList.contains('is-hidden')) {
          return
        }
        if (header) {
          header.setAttribute('tabindex', '-1')
          header.focus({ preventScroll: true })
        }
        window.scroll({
          top: 0,
          behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'instant' : 'smooth',
        })
        backToTop.classList.add('clicked')
      }
      backToTop.addEventListener('click', scrollToTop)

      const stickBackToTopOnFooter = () => {
        const scrollHeight = body.scrollHeight
        const scrollPosition = window.pageYOffset + window.innerHeight
        const footerHeight = document.getElementById('footer').clientHeight
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

    const inPageLinkHandler = (event) => {
      let href = event.currentTarget.getAttribute('href') // The listener belongs to the anchor, including clicks on its children.
      const hrefPageUrl = href.split('#')[0]
      const currentUrl = location.href.split('#')[0]

      if (hrefPageUrl === currentUrl || hrefPageUrl === '') {
        // If the link goes on the same page, run smooth scroll
        href = href.split('#').pop()
        let target
        if (href === '#' || href === '') {
          target = document.documentElement
        } else {
          target = document.getElementById(href)
        }
        if (!target) return
        event.preventDefault()
        if (!target.hasAttribute('tabindex')) target.setAttribute('tabindex', '-1')
        target.focus({ preventScroll: true })
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
          behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'instant' : 'smooth',
        })
      }
    }

    for (const link of links) {
      link.addEventListener('click', inPageLinkHandler)
    }
  }

  /*   Sticky Header
  /* -------------------------------------------------- */
  if (header && siteInfo && searchToggle && body.classList.contains('sticky-header')) {
    const stickyHeaderHandler = () => {
      const siteInfoHgt = siteInfo.offsetHeight
      const scrollTop = window.pageYOffset

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
          searchToggle.setAttribute('aria-expanded', 'true')
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
              closeToggle.focus()
            }
            forwardTrap.addEventListener('focus', focusToFirstElInModal)
          }

          if (body.classList.contains('modal-search-open')) {
            document.querySelector('.modal-search-form .search-inner').focus()
          }
        }
      }
      searchToggle.addEventListener('click', searchToggleHandler)

      // Close toggle
      const closeToggleHandler = () => {
        toggleState = false
        if (!toggleState) {
          searchToggle.classList.remove('open')
          searchToggle.setAttribute('aria-expanded', 'false')
          body.classList.remove('modal-search-open')
          body.classList.add('modal-search-closed')
          searchToggle.focus()
        }
      }
      closeToggle.addEventListener('click', closeToggleHandler)

      // Close toggle when pressing `esc` key
      document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && toggleState) {
          closeToggleHandler()
        }
      })
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
          navToggle.setAttribute('aria-expanded', 'true')
          headerMenu.classList.add('open')
          body.classList.remove('header-menu-closed')

          if (body.classList.contains('admin-bar')) {
            top += wpAdminBar.clientHeight
          }
          navToggle.style.position = 'fixed'
          navToggle.style.top = `${top}px`
          navToggle.style.height = `${getMenuPaddingTop(false)}px`
          headerMenu.querySelector('a, button')?.focus()
        } else if (navCount % 2 === 0) {
          navToggle.classList.remove('open')
          navToggle.setAttribute('aria-expanded', 'false')
          headerMenu.classList.remove('open')
          body.classList.add('header-menu-closed')

          navToggle.style.position = 'relative'
          navToggle.style.top = 'auto'
          navToggle.style.height = 'auto'
        }
      }
      navToggle.addEventListener('click', navToggleHandler)

      const menuOverlayHandler = () => {
        navCount = 0
        navToggle.classList.remove('open')
        navToggle.setAttribute('aria-expanded', 'false')
        headerMenu.classList.remove('open')
        headerMenu.classList.add('closed')
        navToggle.classList.add('closed')
        body.classList.add('header-menu-closed')

        navToggle.style.position = 'relative'
        navToggle.style.top = 'auto'
        navToggle.style.height = 'auto'
        navToggle.focus()
      }
      menuOverlay.addEventListener('click', menuOverlayHandler)
      menuCloseButton.addEventListener('click', menuOverlayHandler)

      document.addEventListener('keydown', (event) => {
        if (!headerMenu.classList.contains('open') || window.innerWidth >= 768) return
        if (event.key === 'Escape') {
          event.preventDefault()
          menuOverlayHandler()
        } else if (event.key === 'Tab') {
          const controls = [...headerMenu.querySelectorAll('a, button')]
            .filter(el => getComputedStyle(el).visibility !== 'hidden' && el.getClientRects().length)
          const first = controls[0]
          const last = controls[controls.length - 1]
          if (event.shiftKey && (document.activeElement === first || !headerMenu.contains(document.activeElement))) {
            event.preventDefault()
            last?.focus()
          } else if (!event.shiftKey && (document.activeElement === last || !headerMenu.contains(document.activeElement))) {
            event.preventDefault()
            first?.focus()
          }
        }
      })

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
      if (!items) return // WordPress's widget preview has no theme header.
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
    const parentMenus = document.querySelectorAll('.menu-container .menu-item-has-children')

    parentMenus.forEach((parentEl, index) => {
      const link = parentEl.querySelector('a')
      const submenu = parentEl.querySelector('.sub-menu')
      if (!submenu.id) submenu.id = `cd-submenu-${index}`
      link.setAttribute('aria-controls', submenu.id)
      const updateState = () => link.setAttribute('aria-expanded', String(
        window.innerWidth < 768 || parentEl.classList.contains('is-sub-menu-shown')
      ))
      const open = () => {
        parentEl.classList.remove('is-sub-menu-dismissed')
        parentEl.classList.add('is-sub-menu-shown')
        updateState()
      }
      parentEl.addEventListener('focusin', open)
      parentEl.addEventListener('mouseenter', open)
      parentEl.addEventListener('focusout', event => {
        if (!parentEl.contains(event.relatedTarget)) parentEl.classList.remove('is-sub-menu-shown')
        updateState()
      })
      parentEl.addEventListener('mouseleave', () => {
        if (!parentEl.contains(document.activeElement)) parentEl.classList.remove('is-sub-menu-shown')
        updateState()
      })
      parentEl.addEventListener('keydown', event => {
        if (event.key !== 'Escape' || window.innerWidth < 768) return
        event.preventDefault()
        event.stopPropagation()
        link.focus()
        parentEl.classList.remove('is-sub-menu-shown')
        parentEl.classList.add('is-sub-menu-dismissed')
        updateState()
      })
      updateState()
      window.addEventListener('resize', updateState)
    })
    document.addEventListener('keydown', event => {
      if (event.key !== 'Escape' || window.innerWidth < 768) return
      parentMenus.forEach(parentEl => {
        if (!parentEl.matches(':hover')) return
        parentEl.classList.remove('is-sub-menu-shown')
        parentEl.classList.add('is-sub-menu-dismissed')
        parentEl.querySelector('a').setAttribute('aria-expanded', 'false')
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

      const pageNumbersElHoverHandler = (event) => {
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
    const actionBar = document.createElement('li')
    const pingList = document.getElementById('ping-list')
    const commentList = document.getElementById('comment-list')

    if (tabmenu) {
      tabmenu.setAttribute('role', 'tablist')
      actionBar.setAttribute('role', 'presentation')
      actionBar.setAttribute('aria-hidden', 'true')
      actionBar.classList.add('action-bar')
      tabmenu.insertBefore(actionBar, null)
      actionBar.style.width = `${tabItems[0].clientWidth}px`
    }

    const tabs = [...tabItems].map(item => item.querySelector('a'))
    const panels = tabs.map((tab, index) => {
      const list = document.querySelector(tab.getAttribute('href'))
      const panel = document.createElement('div')
      panel.id = `comment-panel-${index}`
      panel.setAttribute('role', 'tabpanel')
      panel.setAttribute('tabindex', '0')
      tab.id = `comment-tab-${index}`
      panel.setAttribute('aria-labelledby', tab.id)
      tab.setAttribute('role', 'tab')
      tab.setAttribute('aria-controls', panel.id)
      tab.setAttribute('aria-selected', String(index === 0))
      tab.tabIndex = index === 0 ? 0 : -1
      tab.parentElement.setAttribute('role', 'presentation')
      panel.hidden = index !== 0
      if (list) {
        list.before(panel)
        panel.appendChild(list)
      } else {
        tabmenu.after(panel)
      }
      return panel
    })

    if (pingList) {
      pingList.style.display = 'none'
    }

    const tabItemsHandler = (event) => {
      event.preventDefault()
      const target = event.currentTarget.querySelector('a')

      // Do nothing when clicked the item which is already active
      if (target.parentNode.classList.contains('active')) {
        return
      }
      tabs.forEach((tab, index) => {
        const selected = tab === target
        tab.setAttribute('aria-selected', String(selected))
        tab.tabIndex = selected ? 0 : -1
        panels[index].hidden = !selected
      })

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
    tabs.forEach((tab, index) => tab.addEventListener('keydown', event => {
      let next
      if (event.key === 'ArrowRight') next = (index + 1) % tabs.length
      if (event.key === 'ArrowLeft') next = (index + tabs.length - 1) % tabs.length
      if (event.key === 'Home') next = 0
      if (event.key === 'End') next = tabs.length - 1
      if (next !== undefined) {
        event.preventDefault()
        tabs[next].focus()
        tabs[next].click()
      }
    }))
  }

  /*   Recent Posts Widget : Adjust the date style
  /* -------------------------------------------------- */
  {
    const dates = document.querySelectorAll('.widget_recent_entries .post-date')

    if (dates) {
      for (const date of dates) {
        if (date.previousElementSibling.tagName === 'A') {
          const parent = date.previousElementSibling
          const titleNode = document.createElement('span')
          titleNode.className = 'recent_entries_post-title'
          titleNode.textContent = parent.textContent
          parent.replaceChildren(titleNode)
          parent.insertBefore(date, titleNode)
        }
      }
    }
  }
})
