document.addEventListener("DOMContentLoaded", makeResponsive, false);

const PADDING = 48;
const A = 40;

function scrollContainer(
  childs,
  currIdx,
  scrollElem,
  elem,
  limit,
  specialMode
) {
  let scroll = 0;

  for (let i = 1; i <= childs.length; i++) {
    if (i != currIdx) {
      if (i < currIdx) scroll += childs[i - 1].offsetWidth;

      childs[i - 1].classList.remove("active-item");
    } else {
      if (currIdx != 1 && specialMode)
        scroll += childs[i - 1].offsetWidth / 2 - 80;
      childs[i - 1].classList.add("active-item");
    }
  }

  scrollElem.scrollLeft = scroll;

  if (currIdx == 1) {
    elem.classList.add("hidden-left-arrow");
    elem.classList.remove("hidden-right-arrow");
  } else if (currIdx == limit) {
    elem.classList.add("hidden-right-arrow");
    elem.classList.remove("hidden-left-arrow");
  } else {
    elem.classList.remove("hidden-right-arrow");
    elem.classList.remove("hidden-left-arrow");
  }
}

function doMakeResponsive(
  elem,
  scrollElem,
  limit,
  currIdx,
  isFullWidth,
  bottom,
  specialMode
) {
  let rect = elem.getBoundingClientRect();
  let childs = scrollElem.children;

  if (childs.length === 1) childs = childs[0].childNodes;

  scrollContainer(childs, currIdx, scrollElem, elem, limit, specialMode);

  elem.onclick = function (e) {
    let isClicked = false;
    let goNext = true;

    if (isFullWidth) {
      if (e.clientX > elem.offsetWidth - A || e.clientX < A) {
        if (bottom == -1) bottom = elem.offsetHeight / 2;

        if (
          e.offsetY >= elem.offsetHeight - bottom - 40 &&
          e.offsetY <= elem.offsetHeight - bottom
        )
          isClicked = true;

        if (isClicked && e.clientX < A) goNext = false;
      }
    } else {
      if (e.offsetX > elem.offsetWidth) {
        isClicked = true;
      } else if (e.offsetX < rect.left - PADDING) {
        isClicked = true;
        goNext = false;
      }
    }

    if (isClicked) {
      if (goNext && currIdx < limit) currIdx++;
      else if (currIdx > 1) currIdx--;
      else isClicked = false;
    }
    if (isClicked)
      scrollContainer(childs, currIdx, scrollElem, elem, limit, specialMode);
  };
}

function makeResponsive() {
  let width = window.innerWidth;

  if (width < 800) {
    let el = document.getElementsByClassName("price-card-container")[0];
    doMakeResponsive(el, el, 3, 1, false, -1, false);
    let el2 = document.getElementsByClassName("why-we-are-different")[0];
    doMakeResponsive(el2, el2, 3, 1, false, -1, false);

    let el3 = document.getElementsByClassName("latest-blog-section")[0];
    doMakeResponsive(el3, el3.children[0], 4, 1, true, -1, false);

    let el4 = document.getElementsByClassName("EPOS")[0];
    doMakeResponsive(el4, el4.children[1], 3, 1, true, -1, false);

    doMakeResponsive(
      document.getElementById("steps-container"),
      document.getElementsByClassName("steps")[0],
      5,
      3,
      true,
      50,
      true
    );
  }
}
