(function () {

  const classes = {
    hidden: 'is-hidden',
  };

  const selectors = {
    header: '[data-header]',
  };


  const init = () => {
    // on scroll down, the header will be hidden by adding the 'is-hidden' class
    // on scroll up, the header will be shown by removing the 'is-hidden' class
    // for both directions the user has to scroll at least 100px
    let lastScrollTop = 0;
    window.addEventListener('scroll', debounce(() => {
      const header = document.querySelector(selectors.header);
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      if (scrollTop > lastScrollTop && scrollTop > 100) {
        header.classList.add(classes.hidden);
        return;
      }
      else {
        header.classList.remove(classes.hidden);
        return;
      }
      lastScrollTop = scrollTop;
    }, 100));


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