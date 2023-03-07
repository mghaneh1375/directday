document.addEventListener("DOMContentLoaded", makeResponsive, false);

const PADDING = 48;

function makeResponsive() {
  let width = window.innerWidth;
  if (width < 800) {
    let elem = document.getElementsByClassName("price-card-container")[0];
    let rect = elem.getBoundingClientRect();
    elem.onclick = function (e) {
      if (e.offsetX > elem.offsetWidth) {
        elem.scrollLeft += elem.offsetWidth;
      } else if (e.offsetX < rect.left - PADDING) {
        elem.scrollLeft -= elem.offsetWidth;
      } else alert("c0");
    };
  }
}
