//-------------------------------------//
// init Masonry

let $grid = $('.grid').masonry({
  itemSelector: 'none', // select none at first
  columnWidth: '.grid__col-sizer',
  gutter: '.grid__gutter-sizer',
  percentPosition: true,
  // transitionDuration: '0s',
  stagger: '0.3s',
  // // nicer reveal transition
  visibleStyle: { transform: 'translateY(0)', opacity: 1 },
  hiddenStyle: { transform: 'translateY(100px)', opacity: 0 },
});

// get Masonry instance
let msnry = $grid.data('masonry');

// initial items reveal
$grid.imagesLoaded(function () {
  $grid.removeClass('are-images-unloaded');
  $grid.masonry('option', { itemSelector: '.grid__item' });
  let $items = $grid.find('.grid__item');
  $grid.masonry('appended', $items);
});


// //-------------------------------------//
// // init Infinite Scroll

$grid.infiniteScroll({
  path: '.pagination__next',
  append: '.grid__item',
  outlayer: msnry,
  status: '.page-load-status',
  hideNav: '.pagination',
  history: false,
});

// //-------------------------------------//