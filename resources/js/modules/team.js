(function () {

  const classes = {
    hidden: '!is-hidden',
    visible: '!is-block',
    active: 'is-btn-active',
  };

  const selectors = {
    select: '[data-categories]',
    btnReset: '[data-reset-btn]',
    items: '[data-category-item]',
  };

  let activeCategory = null


  const init = () => {
    // on select change show items with the same data-item-category attribute value
    // and show the items with the same data-item-category attribute value
    const select = document.querySelector(selectors.select);

    select.addEventListener('change', () => {
      const category = select.value;
      activeCategory = category;

      // show reset btn
      const resetBtn = document.querySelector(selectors.btnReset);
      resetBtn.classList.remove(classes.hidden);

      hideAll();

      if (category === 'all') {
        showAll();
        return;
      }

      showSelected(category);
    });

    // on reset btn click show all items
    const resetBtn = document.querySelector(selectors.btnReset);
    resetBtn.addEventListener('click', () => {
      // hide reset btn
      resetBtn.classList.add(classes.hidden);

      showAll();

      // select first option
      const select = document.querySelector(selectors.select);
      select.value = 'all';
    });
  };

  const showAll = () => {
    const itemsToShow = document.querySelectorAll(selectors.items);
    itemsToShow.forEach(item => {
      item.classList.remove(classes.hidden);
      item.classList.add(classes.visible);
    });
  };

  const hideAll = () => {
    const itemsToHide = document.querySelectorAll(selectors.items);
    itemsToHide.forEach(item => {
      item.classList.remove(classes.visible);
      item.classList.add(classes.hidden);
    });
  };

  const showSelected = (category) => {
    const itemsToShow = document.querySelectorAll(`[data-category-item*="${category}"]`);
    itemsToShow.forEach(item => {
      item.classList.remove(classes.hidden);
      item.classList.add(classes.visible);
    });
  };


  init();
  
})();