jQuery(document).ready(function(){

    // Masonry grid var and options
    var $grid = jQuery('.grid').masonry({
        itemSelector: '.grid__item',
        columnWidth: '.grid__col-sizer',
        gutter: '.grid__gutter-sizer',
        percentPosition: true,
        visibleStyle: { transform: 'translateY(0)', opacity: 1 },
        hiddenStyle: { transform: 'translateY(100px)', opacity: 0 }
    });

    // initial items reveal
    $grid.imagesLoaded(function () {
        $grid.removeClass('are-images-unloaded');
        $grid.masonry('layout');
    });

    // get Masonry instance
    var msnry = $grid.data('masonry');

     // Infinite Scroll options
    if ($('.pagination__next').length) {
        $grid.infiniteScroll({
            path: '.pagination__next',
            append: '.grid__item',
            outlayer: msnry,
            status: '.page-load-status',
            scrollThreshold: 800,
            hideNav: '.pagination',
            history: false
        });
    }

    $grid.on('append.infiniteScroll', function (event, response, path, items) {
        $(items).find('img[srcset]').each(function (i, img) {
            img.outerHTML = img.outerHTML;
        });
        $grid.imagesLoaded().done(function () {
            $grid.masonry();
        });  
    });
});