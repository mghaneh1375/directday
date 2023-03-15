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

      if (i < currIdx) {
	if(specialMode)
		scroll += window.innerWidth;
	else
		scroll += childs[i - 1].offsetWidth + 0;
      }

      childs[i - 1].classList.remove("active-item");
    } else {

//      if (currIdx != 1 && specialMode)
//        scroll += childs[i - 1].offsetWidth / 2 - 80;

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
      } else if (e.offsetX < rect.left) {
        isClicked = true;
        goNext = false;
      }
    }

    if (isClicked) {

      if (goNext && currIdx < limit) currIdx++;
      else if (!goNext && currIdx > 1) currIdx--;
      else isClicked = false;
    }
    if (isClicked)
      scrollContainer(childs, currIdx, scrollElem, elem, limit, specialMode);
  };
}

function makeResponsive() {
  let width = window.innerWidth;

  if (width < 800) {


    let el = document.getElementsByClassName("price-card-container");
    if(el.length > 0)
    	doMakeResponsive(el[0], el[0], 3, 1, false, -1, false);
    
    let el6 = document.getElementById("testimonials_carousel");
    if(el6 !== undefined && el6 !== null)
    	doMakeResponsive(el6, el6, 4, 1, true, -1, true);

    
    let el2 = document.getElementsByClassName("why-we-are-different");
    if(el2.length > 0)
    	doMakeResponsive(el2[0], el2[0], 3, 1, false, -1, false);

    let el3 = document.getElementsByClassName("latest-blog-section");
    if(el3.length > 0)
    	doMakeResponsive(el3[0], el3[0].children[0], 4, 1, true, -1, false);

    let el4 = document.getElementsByClassName("EPOS");
    if(el4.length > 0)
    	doMakeResponsive(el4[0], el4[0].children[1], 3, 1, true, -1, false);

    let el7 = document.getElementsByClassName("regular-card-section");
    if(el7.length > 0)
    	doMakeResponsive(el7[0], el7[0], 3, 1, false, -1, false);

    let el8 = document.getElementsByClassName("customer-card-section");
    if(el8.length > 0)
    	doMakeResponsive(el8[0], el8[0], 2, 1, true, -1, false);

    let el9 = document.getElementsByClassName("others-card-section");
    if(el9.length > 0)
    	doMakeResponsive(el9[0], el9[0], 4, 1, true, -1, false);


    let el5 = document.getElementById("steps-container");

	if(el5 !== undefined && el5 !== null) {
    doMakeResponsive(
      el5,
      document.getElementsByClassName("steps")[0],
      5,
      3,
      true,
      50,
      false
    );
}



  }
}
