(function(dragdrop) {

    dragdrop(window.jQuery, window, document);

}(function($, window, document) {

    $(function() {

        Handlebars.registerHelper('equal', function(value, compare, options) {
            if (value === compare) {
                return options.fn(this);
            }

            return options.inverse(this);
        });

    });

}));
