(function(){const s={open:"is-open",active:"is-active",hidden:"is-hidden"},n={btn:"[data-btn-menu]",menu:"[data-menu]",menuParentItem:"[data-menu-parent-item]",menuChildItem:"[data-menu-child-item]",menuChildItemLink:"[data-menu-child-item] a"};let i=null;const a=()=>{document.querySelector(n.btn).addEventListener("click",u),d(),window.addEventListener("resize",p(d,200)),document.querySelectorAll(n.menuChildItemLink).forEach(c=>{c.addEventListener("click",h)})},u=()=>{const e=document.querySelector(n.menu);e.classList.toggle(s.open),document.querySelector(n.btn).classList.toggle(s.active),e.classList.contains(s.open)||document.querySelectorAll(n.menuParentItem).forEach(o=>{o.classList.remove(s.active)})},h=()=>{document.querySelector(n.menu).classList.remove(s.open),document.querySelector(n.btn).classList.remove(s.active)},r=e=>{const t=e.nextElementSibling;t&&(t.classList.contains(s.hidden)?(m(),t.classList.remove(s.hidden),e.classList.add(s.active)):(t.classList.add(s.hidden),e.classList.remove(s.active)))},m=()=>{document.querySelectorAll(n.menuParentItem).forEach(t=>{t.nextElementSibling.classList.add(s.hidden),t.classList.remove(s.active)})},d=()=>{i="ontouchstart"in window||window.innerWidth<768?"mobile":"desktop",i==="mobile"?(document.querySelectorAll(n.menuParentItem).forEach(o=>{o.removeEventListener("mouseenter",b),o.addEventListener("click",v)}),document.querySelectorAll(n.menuChildItem).forEach(o=>{o.removeEventListener("mouseleave",L)})):(document.querySelectorAll(n.menuParentItem).forEach(l=>{l.removeEventListener("click",v),l.addEventListener("mouseenter",b)}),document.querySelectorAll(n.menuChildItem).forEach(l=>{l.addEventListener("mouseleave",L)}),document.querySelector(n.menu).addEventListener("mouseleave",E))},v=e=>{const t=e.target;r(t),e.preventDefault(),e.stopPropagation()},b=e=>{const t=e.target;r(t),e.preventDefault(),e.stopPropagation()},L=e=>{const t=e.target;t.nextElementSibling,t.classList.add(s.hidden),e.preventDefault(),e.stopPropagation()},E=()=>{m()},p=(e,t)=>{let c;return(...o)=>{clearTimeout(c),c=setTimeout(()=>{e.apply(this,o)},t)}};a()})();(function(){(()=>{const n=document.querySelectorAll("details");n.forEach(i=>{i.addEventListener("toggle",a=>{i.open&&n.forEach(u=>{u!==a.target&&(u.open=!1)})})})})()})();