(function () {

  const selectors = {
    btn: '[data-btn-menu]',
    menu: '[data-menu]'
  };

  const init = () => {
    const btn = document.querySelector(selectors.btn);
    btn.addEventListener('click', toggle);
  };

  const toggle = () => {
    const menu = document.querySelector(selectors.menu);
    menu.classList.toggle('is-open');
    
    const btn = document.querySelector(selectors.btn);
    btn.classList.toggle('is-active');
  };

  init();
  
})();