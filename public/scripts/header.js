// Get the header & nav_top & nav_bottom
let header = document.querySelector("header")
let nav = document.querySelector("nav")
let nav_top = document.getElementById("nav-top")
let nav_bottom = document.getElementById("nav-bottom")
let divRecherche = document.getElementById("recherche")
// Get the main
let main = document.querySelector("main")
// Get the section *presentation*
let presentation = document.getElementById("presentation")

// Get the offset height of the nav
let navHeight = nav.offsetHeight

// Get the offset height of the nav_top
let nav_topHeight = nav_top.offsetHeight

// Get the offset height of the nav_bottom
let nav_bottomHeight = nav_bottom.offsetHeight

// Get the offset height of the header
let headerHeight = header.offsetHeight

// Get the offset height of the presentation
let presentationHeight = presentation.offsetHeight




header.style.height = navHeight + "px"

// divRecherche.style.paddingTop = headerHeight + "px"

let compare = true
let last_scroll_position = 0
let diff = 0
let scroll = nav_topHeight


// When the user scrolls the page, execute function stickynavbar et toggleNav()
window.onscroll = function () 
{
	stickynavbar()

	// toggleNav()

	// diff = last_scroll_position - window.pageYOffset

	// last_scroll_position = window.pageYOffset
};


// Add the sticky class to the nav_bottom when you reach its scroll position. Remove "sticky" when you leave the scroll position
function stickynavbar () 
{
	if (window.pageYOffset >= headerHeight + presentationHeight) {
		// console.log("ok")
		nav.style.transform = "translateY(-80px)"
	} 
	else 
	{
		// console.log("non")
	    nav.style.transform = "translateY(0px)"
	}
}


// function toggleNav () 
// {
// 	if ( diff > 0 /*&& window.pageYOffset > nav_topHeight*/ ) // On remonte la page
// 	{	
// 		if (scroll < nav_topHeight) {
// 			scroll += diff
// 		}
// 		else if ( (scroll + diff) >= nav_topHeight) {
// 			scroll = nav_topHeight
// 		}

// 		header.style.transform = "translateY(" + (-nav_topHeight + scroll) + "px)"
// 	}
// 	else if (diff < 0 /*&& window.pageYOffset > nav_topHeight*/) // on descend la page
// 	{
// 		if (scroll > 0) {
// 			scroll += diff
// 		}
// 		else if (scroll <= 0)
// 		{
// 			scroll = 0
// 		}

// 		header.style.transform = "translateY(" + (-nav_topHeight + scroll) + "px)"
// 	}
// 	console.log("diff = " + diff)
// 	console.log("scroll = " + scroll)
// }

function showNav () 
{	
	nav_top.style.transform = "translateY(0%)"
	nav_bottom.classList.remove("sticky")
	header.classList.add("sticky")
	main.style.marginTop = headerHeight + "px"
}

function hideNav () 
{	
	nav_top.style.transform = "translateY(" + (-nav_topHeight) + "%)"
	nav_bottom.classList.add("sticky")
	main.style.marginTop = nav_bottomHeight + "px"
	header.classList.remove("sticky")
}

