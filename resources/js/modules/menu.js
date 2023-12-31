(function () {

  const classes = {
    open: 'is-open',
    active: 'is-active',
    hidden: 'is-hidden',
  };

  const selectors = {
    btn: '[data-btn-menu]',
    menu: '[data-menu]',
    menuParentItem: '[data-menu-parent-item]',
    menuChildItem: '[data-menu-child-item]',
    menuChildItemLink: '[data-menu-child-item] a',
  };

  let screen = null;

  const init = () => {
    const btn = document.querySelector(selectors.btn);
    btn.addEventListener('click', toggleMenu);

    // Set initial 'screen' value
    setScreen();

    // Debounce the setScreen function on window resize
    window.addEventListener('resize', debounce(setScreen, 200));

    // on click menuChildItemLink close the menu
    const menuChildItemLinks = document.querySelectorAll(selectors.menuChildItemLink);
    menuChildItemLinks.forEach((item) => {
      item.addEventListener('click', hideMenu);
    });
  };

  // Toggle menu
  const toggleMenu = () => {
    const menu = document.querySelector(selectors.menu);
    menu.classList.toggle(classes.open);
    
    const btn = document.querySelector(selectors.btn);
    btn.classList.toggle(classes.active);

    // remove is-active from all menu items if the menu is closed
    if (!menu.classList.contains(classes.open)) {
      const menuItems = document.querySelectorAll(selectors.menuParentItem);
      menuItems.forEach((item) => {
        item.classList.remove(classes.active);
      });
    }
  };

  // Hide menu
  const hideMenu = () => {
    const menu = document.querySelector(selectors.menu);
    menu.classList.remove(classes.open);

    const btn = document.querySelector(selectors.btn);
    btn.classList.remove(classes.active);
  };

  // Toggle submenu
  const toggleSubMenu = (item) => {
    const ul = item.nextElementSibling;
    if (ul)
    {
      if (ul.classList.contains(classes.hidden)) {
        hideAllSubMenus();
        ul.classList.remove(classes.hidden);
        item.classList.add(classes.active);
      }
      else {
        ul.classList.add(classes.hidden);
        item.classList.remove(classes.active);
        
        const href = item.getAttribute('href');
        if (href) {
          document.location.href = href;
          return;
        }    
      }
    }
  };

  // Hide all submenus
  const hideAllSubMenus = () => {
    const subMenus = document.querySelectorAll(selectors.menuParentItem);
    subMenus.forEach((item) => {
      const ul = item.nextElementSibling;
      ul.classList.add(classes.hidden);
      item.classList.remove(classes.active);
    });
  };
  
  // Set the screen variable to either 'mobile' or 'desktop'
  const setScreen = () => {
    const isMobile = ('ontouchstart' in window) || (window.innerWidth < 768);
    screen = isMobile ? 'mobile' : 'desktop';

    // if screen is mobile remove the hover event listeners and add click event listeners
    if (screen === 'mobile') {
      const subMenus = document.querySelectorAll(selectors.menuParentItem);
      subMenus.forEach((item) => {
        item.removeEventListener('mouseenter', mouseEnterHandler);
        item.addEventListener('click', clickHandler);
      });

      const subMenuItems = document.querySelectorAll(selectors.menuChildItem);
      subMenuItems.forEach((item) => {
        item.removeEventListener('mouseleave', mouseLeaveHandler);
      });
    }

    // if screen is desktop remove the click event listeners and add hover event listeners
    else {
      const subMenus = document.querySelectorAll(selectors.menuParentItem);
      subMenus.forEach((item) => {
        item.removeEventListener('click', clickHandler);
        item.addEventListener('mouseenter', mouseEnterHandler);
      });

      // add a mouseleave event listener to the menuChildItems
      const subMenuItems = document.querySelectorAll(selectors.menuChildItem);
      subMenuItems.forEach((item) => {
        item.addEventListener('mouseleave', mouseLeaveHandler);
      });

      // add a mouseleave event listener to the menu
      const menu = document.querySelector(selectors.menu);
      menu.addEventListener('mouseleave', mouseLeaveMenuHandler);
    }
  };

  // Event handler for click
  const clickHandler = (e) => {
    const item = e.target;
    toggleSubMenu(item);
    e.preventDefault();
    e.stopPropagation();
  };

  // Event handler for hover
  const mouseEnterHandler = (e) => {
    const item = e.target;
    toggleSubMenu(item);
    e.preventDefault();
    e.stopPropagation();
  };

  // Event handler for mouseleave
  const mouseLeaveHandler = (e) => {
    const item = e.target;
    const ul = item.nextElementSibling;
    item.classList.add(classes.hidden);
    e.preventDefault();
    e.stopPropagation();
  };

  const mouseLeaveMenuHandler = () => {
    hideAllSubMenus();
  };

  // Debounce function to limit the rate of execution
  const debounce = (func, delay) => {
    let timeoutId;
    return (...args) => {
      clearTimeout(timeoutId);
      timeoutId = setTimeout(() => {
        func.apply(this, args);
      }, delay);
    };
  };

  init();
  
})();