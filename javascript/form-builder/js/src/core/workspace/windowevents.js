(function(windowevents) {

    windowevents(window.jQuery, window, document);

}(function($, window, document) {

    $(function() {
        
        console.log('Window events ready!');

        $(window).resize(function() {
            console.log($(window).height());
        });

    });

}));