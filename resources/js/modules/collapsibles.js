(function () {
 
  const init = () => {
    const collapsibles = document.querySelectorAll('details');
    collapsibles.forEach((item) => {
      item.addEventListener('toggle', (event) => {
        if (item.open) {
          collapsibles.forEach((item) => {
            if (item !== event.target) {
              item.open = false;
            }
          });
        }
      });
    });
  };

  init();
  
})();