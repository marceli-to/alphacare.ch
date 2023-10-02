(function () {

  const classes = {
    hidden: '!is-hidden',
    visible: '!is-block',
    active: 'is-btn-active',
  };

  const selectors = {
    btn: '[data-category-btn]',
    btnReset: '[data-reset-btn]',
    items: '[data-category-item]',
  };

  let activeCategory = null


  const init = () => {
    // on btn click get the data-btn-category attribute value
    // and show the items with the same data-item-category attribute value
    const btns = document.querySelectorAll(selectors.btn);
    btns.forEach(btn => {
      btn.addEventListener('click', () => {
        const category = btn.getAttribute('data-category-btn');
        activeCategory = category;

        // show reset btn
        const resetBtn = document.querySelector(selectors.btnReset);
        resetBtn.classList.remove(classes.hidden);

        // add class active to the clicked btn
        btns.forEach(btn => {
          btn.classList.remove(classes.active);
        });
        btn.classList.add(classes.active);

        // hide all items
        const itemsToHide = document.querySelectorAll(selectors.items);
        itemsToHide.forEach(item => {
          item.classList.remove(classes.visible);
          item.classList.add(classes.hidden);
        });

        // show selected item with the same data-category-item attribute value
        const itemsToShow = document.querySelectorAll(`[data-category-item*="${category}"]`);
        itemsToShow.forEach(item => {
          item.classList.remove(classes.hidden);
          item.classList.add(classes.visible);
        });
      });
    });

    // on reset btn click show all items
    const resetBtn = document.querySelector(selectors.btnReset);
    resetBtn.addEventListener('click', () => {
      // hide reset btn
      resetBtn.classList.add(classes.hidden);

      // remove active class from all btns
      btns.forEach(btn => {
        btn.classList.remove(classes.active);
      });

      // show all items
      const itemsToShow = document.querySelectorAll(selectors.items);
      itemsToShow.forEach(item => {
        item.classList.remove(classes.hidden);
        item.classList.add(classes.visible);
      });
    });
  };


  init();
  
})();