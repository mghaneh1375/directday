document.addEventListener("DOMContentLoaded", makeResponsive, false);

const PADDING = 48;
const A = 40;

function scrollContainer(
  childs,
  currIdx,
  scrollElem,
  elem,
  limit,
  specialMode,
  offset
) {
  let scroll = 0;
  for (let i = 1; i <= childs.length; i++) {

    if (i != currIdx) {

      if (i < currIdx) {
	if(specialMode)
		scroll += window.innerWidth;
	else {
		scroll += childs[i - 1].offsetWidth;
		if(offset !== undefined)
			scroll += offset;
	}
      }

      childs[i - 1].classList.remove("active-item");
    } else {

//      if (currIdx != 1 && specialMode)
//        scroll += childs[i - 1].offsetWidth / 2 - 80;

      childs[i - 1].classList.add("active-item");
    }
  }


  scrollElem.scroll({left: scroll, behavior: "smooth"});

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
  specialMode,
  offset
) {
  let rect = elem.getBoundingClientRect();
  let childs = scrollElem.children;

  if (childs.length === 1) childs = childs[0].childNodes;

  scrollContainer(childs, currIdx, scrollElem, elem, limit, specialMode, offset);

  elem.onclick = function (e) {
    let isClicked = false;
    let goNext = true;

    if (isFullWidth) {


      if (e.clientX > elem.offsetWidth - A || e.clientX < A) {
        if (bottom == -1) bottom = elem.offsetHeight / 2;


        if (
          e.offsetY >= elem.offsetHeight - bottom - 40 &&
          e.offsetY <= elem.offsetHeight - bottom + 20
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
      scrollContainer(childs, currIdx, scrollElem, elem, limit, specialMode, offset);
  };
}


function sc(childs, currIdx) {

  let scroll = 0;

  for (let i = 0; i < childs.length; i++) {

    if (i < currIdx)
	scroll += childs[i].scrollWidth;
    else break;

  }

  return scroll;

}

function makeResponsive() {
  let width = window.innerWidth;
  let slider = document.querySelectorAll(".top-section > div:nth-child(2) img");


for (i = 0; i < slider.length; i++) {

	if(i == 0) {
		slider[i].addEventListener('click', function() {
	  		document.location.href = '/pos-system-products/counter-and-customer-display';
		});
	}
	else if(i == 1) {
		slider[i].addEventListener('click', function() {
	  		document.location.href = '/pos-system-products';
		});
	}
	else {
		slider[i].addEventListener('click', function() {
		  	document.location.href = '/pos-system-demo';
		});
	}

}

  let curr_featured_idx = 0;
  let featured_posts = document.querySelectorAll(".featured-article-container > div .next-featured-article");
  if(featured_posts !== undefined && featured_posts != null && featured_posts.length > 0) {
	for(i = 0; i < featured_posts.length; i++) {
		featured_posts[i].addEventListener("click", function() {

			let curr_idx = parseInt(this.getAttribute('data-idx'));
			const elements = document.querySelectorAll('.featured-article-container');

			elements.forEach((element, index) => {
				if(index == curr_idx + 1)
					element.classList.remove('hidden');
				else
					element.classList.add('hidden');

			});

			
			curr_featured_idx++;
		});
	}
  }


  let video_posts = document.querySelectorAll(".most-read-articles-container .directday-play");
  if(video_posts !== undefined && video_posts != null && video_posts.length > 0) {
	for(i = 0; i < video_posts.length; i++) {
		video_posts[i].addEventListener("click", function() {
			let curr_idx = parseInt(this.getAttribute('data-idx'));
			const elem = document.getElementById("post_video_" + curr_idx);
			elem.classList.remove('hidden');

		});
	}
  }

  if (width < 800) {

    let el = document.getElementsByClassName("price-card-container");
    if(el.length > 0)
    	doMakeResponsive(el[0], el[0], 3, 1, false, -1, false);
    
    let el6 = document.getElementById("testimonials_carousel");
    if(el6 !== undefined && el6 !== null)
    	doMakeResponsive(el6, el6, 2, 1, true, -1, true);

    
    let el2 = document.getElementsByClassName("why-we-are-different");
    if(el2.length > 0)
    	doMakeResponsive(el2[0], el2[0], 3, 1, false, -1, false);

    let el3 = document.getElementsByClassName("latest-blog-section");
    if(el3.length > 0)
    	doMakeResponsive(el3[0], el3[0].children[0], 4, 1, true, -1, false);

    let el4 = document.getElementsByClassName("EPOS");
    if(el4.length > 0) {
    	doMakeResponsive(el4[0], el4[0].children[1], 3, 1, true, -1, false);
    	doMakeResponsive(el4[1], el4[1].children[1], 2, 1, true, -1, false);
    }

    let el7 = document.getElementsByClassName("regular-card-section");
    if(el7.length > 0)
    	doMakeResponsive(el7[0], el7[0], 3, 1, false, -1, false);

    let el8 = document.getElementsByClassName("customer-card-section");
    if(el8.length > 0)
    	doMakeResponsive(el8[0], el8[0], 2, 1, true, -1, false);

    let el9 = document.getElementsByClassName("others-card-section");
    if(el9.length > 0) {
      if(el9.length > 1) {
    	doMakeResponsive(el9[0], el9[0], 5, 1, true, -1, false);
    	doMakeResponsive(el9[1], el9[1], 3, 1, true, -1, false);
      }
      else
    	doMakeResponsive(el9[0], el9[0], 4, 1, true, -1, false);
    }


    let el5 = document.getElementById("steps-container");

	if(el5 !== undefined && el5 !== null) {
    doMakeResponsive(
      el5,
      document.getElementsByClassName("steps")[0],
      5,
      1,
      true,
      50,
      false, 30
    );
}


    let el10 = document.getElementsByClassName("our-values");

    if(el10.length > 0)
	el10[0].scrollLeft = 394;

    let el11 = document.getElementById("go-prev-team-member");


    if(el11 !== undefined && el11 !== null) {

	let el12 = document.getElementsByClassName("our-team-gallery")[0];
	let currIdxForTeamMembers = 2;

	el11.onclick = function (e) {
		if(currIdxForTeamMembers == 0) return;
		currIdxForTeamMembers--;
		el12.scrollLeft = sc(el12.children, currIdxForTeamMembers) - window.innerWidth / 4;
		if(currIdxForTeamMembers == 0)
			el11.classList.add('hidden');
		else
			el13.classList.remove('hidden');



	};

	let el13 = document.getElementById("go-next-team-member");
	el13.onclick = function (e) {
		if(currIdxForTeamMembers == 4) return;
		currIdxForTeamMembers++;
		el12.scrollLeft = sc(el12.children, currIdxForTeamMembers) - window.innerWidth / 4;

		if(currIdxForTeamMembers == 4)
			el13.classList.add('hidden');
		else
			el11.classList.remove('hidden');


	};


	el12.scrollLeft = sc(el12.children, currIdxForTeamMembers) - window.innerWidth / 4;
    }


  }
}
