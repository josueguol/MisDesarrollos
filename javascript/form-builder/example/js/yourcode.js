(function(yourcode) {
    yourcode(window.jQuery, window, document);
}(function($, window, document) {
    $(function() {
        $(document).ready(function() {
            var formbuilder = new $._FormBuilder();
            formbuilder.InitForms('get.php', 'get', { method: 'components', components: 'forms' });
            formbuilder.LoadDocument('get.php', 'get', { method: 'components', components: 'document' });
        });
    });
}));
