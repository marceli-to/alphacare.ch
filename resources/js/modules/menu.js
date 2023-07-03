(function () {

  const selectors = {
    btn: '[data-menu-btn]',
    menu: '[data-menu]'
  };

  const init = () => {
    const btn = document.querySelector(selectors.btn);
    btn.addEventListener('click', toggle);
  };

  const toggle = () => {
    const menu = document.querySelector(selectors.menu);
    menu.classList.toggle('is-visible');
    const btn = document.querySelector(selectors.btn);
    btn.classList.toggle('is-active');
  };

  init();
  
})();