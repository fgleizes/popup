jQuery(document).ready(function(){

    // Masonry grid var and options
    var $grid = jQuery('.grid').masonry({
        // itemSelector: 'none',
        itemSelector: '.grid__item',
        columnWidth: '.grid__col-sizer',
        // stamp: '.stamp',
        gutter: '.grid__gutter-sizer',
        percentPosition: true,
        stagger: '0.3s',
        // transitionDuration: '0.4s',
        // horizontalOrder: true,
        visibleStyle: { transform: 'translateY(0)', opacity: 1 },
        hiddenStyle: { transform: 'translateY(100px)', opacity: 0 }
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
            scrollThreshold: 400,
            // loadOnScroll: false,
            hideNav: '.pagination',
            history: false,
            // checkLastPage: '.pagination__next',
            // debug: true,
            onInit: function () {
                this.on( 'append', function( event, response, path, items ) {
                    $grid.imagesLoaded().done( function() {
                        $grid.masonry();
                    });
                });
            }
        });
    }

    
    // initial items reveal
    $grid.imagesLoaded( function() {
        $grid.removeClass('are-images-unloaded');
        $grid.masonry('layout');
    });

    // $grid.imagesLoaded(function () {
    //     $grid.removeClass('are-images-unloaded');
    //     $grid.masonry('option', { itemSelector: '.grid__item' });
    //     let $items = $grid.find('.grid__item');
    //     $grid.masonry('appended', $items);
    // });
    
    $grid.on('append.infiniteScroll', function (event, response, path, items) {
        $(items).find('img[srcset]').each(function (i, img) {
            img.outerHTML = img.outerHTML;
        });
    });
    

    // jQuery('.view-more-button').click(function() {
    //     // load next page
    //     $grid.infiniteScroll('loadNextPage', function(){
    //         // this was the breakthrough. after appending to grid do something rather than on load
    //         this.on('append.infiniteScroll', function(){
    //             $grid.imagesLoaded().always( function() {
    //                 $grid.masonry();
    //             });
    //         });
    //     });
    //     // enable loading on scroll
    //     $grid.infiniteScroll( 'option', {
    //         loadOnScroll: true
    //     });
    //     // hide button
    //     jQuery('.view-more-button').hide();
    // });

});