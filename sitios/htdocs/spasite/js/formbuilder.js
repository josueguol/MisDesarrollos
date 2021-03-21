/**
 * Global
 */
;(function($) {

    /**
     * Controles
     */
    $._FormControls = function() {};
    $._FormControls.prototype = {
        controlPath: 'js/controls/',
        defaultTheme: 'defaults',
        defaultName: 'controls.html',
        customTheme: null,

        getTemplateUrl: function() {
            var theme = (this.customTheme === null) ? this.defaultTheme : this.customTheme;

            return this.controlPath + theme + '/' + this.defaultName;
        },
        loadTemplates: function() {
            try {
                this.requestWithParams(this.getTemplateUrl(), 'get', null, function(response, params) {
                    $('#frmb-forms-templates').html(response);
                }, null);
            } catch (e) {
                console.log(e);
            }

        },
        requestWithParams: function(url, method, data, callback, params) {
            $.ajax({
                url: url,
                method: method,
                data: data,
                success: function(response) {
                    if (response) {
                        callback(response, params);
                    } else {
                        console.log('Bad response.');
                    }
                },
                error: function(e) {
                    //console.log(e);
                }
            });
        },
        templating: function(template, data) {
            var HBScript = $('#' + template).html();

            if(HBScript === undefined) { 
                return '<div>Ningún plantilla "' + template + '" ' + 'encontrada.</div>';
            }

            var compiledTemplate = Handlebars.compile(HBScript);

            var html = compiledTemplate(data);

            return html;
        },
        setTheme: function(theme) {
            this.customTheme = theme;
        },
        setControlPath: function(path) {
            this.controlPath = path;
        },
        getControl: function(templateName, params) {
            var prefix = '-frmb-template';
            var templateId = templateName + prefix;
            return this.templating(templateId, params);
        },
    };

    $._FormHelper = function() {};

    $._FormHelper.prototype = {
        setEditionMode: function() {

        },
        cleanContainer: function(container) {
            $(container).children().detach().remove();
        }
    };

    /**
     * Api
     */
    $._FormBuilder = function() {};

    $._FormBuilder.prototype = {
        InitForms: function(url, method, params) {
            $._FormControls.prototype.loadTemplates();
            $._FormBuilder.prototype.request(url, method, params, $._FormBuilder.prototype.componentsArea);
        },
        LoadDocument: function(url, method, params) {
            $._FormBuilder.prototype.request(url, method, params, $._FormBuilder.prototype.documentArea);
        },
        dragHelper: function(e) {
            return '<div class="btn btn-primary draggable">Hecho con <span class="glyphicon glyphicon-heart"></span></div>';
        },
        handleDropEvent: function(e, ui) {
            var dragslot = ui.draggable.data('dragslot');
            if (dragslot !== 'new-xcomponent') {
                return;
            }
            var items = $._FormBuilder.prototype.getDataPropertiesArray(ui.draggable);
            var hbtemplate = $._FormBuilder.prototype.templating(items[0].name + '-template', items[0]);

            $('#frmb-workarea-components').append(hbtemplate);
        },
        documentArea: function(data) {
            //TODO: EDITION MODE
            if (false) {}

            //TODO:
            //SHOW AND CLEAN DOC PROPERTIES AREA
            //SHOW AND CLEAN COMPONENTS AREA
            $._FormHelper.prototype.cleanContainer("#frbm-workarea-docProperties"); // CLEAR DOC PROPERTIES AREA
            $('#frbm-action-buttons').show(); // SAVE - CANCEL BUTTONS
            $('#frbm-droppable-component').show(); // SHOW DROPPABLE AREA
            //TODO: FILL PROPERTIES DOC
            $._FormBuilder.prototype.propertiesArea(data);
            //TODO: FILL COMPONENTS AREA
            $._FormBuilder.prototype.loadComponents(data.elements);

        },
        propertiesArea: function(data) {
            $.each(data, function(key, value) {
                var item = {
                    name: key,
                    control: value
                };
                if (value.type) {
                    $('#frbm-workarea-docProperties').append(
                        $._FormControls.prototype.getControl(value.type, item)
                    );
                }
            });
        },
        loadComponents: function(data) {
            $.each(data, function() {
                var controlType = this.control.split('.');
                $('#frmb-workarea-components').append($._FormBuilder.prototype.templating(controlType[controlType.length - 1] + '-template', this));
            });
        },
        componentsArea: function(data) {
            $('#frmb-toolbar-components').append($._FormBuilder.prototype.templating('frmb-component-template', data));

            $(".draggable").data('dragslot', 'new-xcomponent').draggable({
                cursor: 'move',
                containment: 'document',
                scroll: true,
                helper: $._FormBuilder.prototype.dragHelper
            });

            $('.workarea-plus').droppable({
                hoverClass: 'workarea-plus-hover',
                drop: $._FormBuilder.prototype.handleDropEvent
            });

            $(".workarea-sortable").sortable({
                revert: true
            });
        },
        getDataPropertiesArray: function(objects, needle) {
            if (needle === undefined) needle = 'data-';
            var items = [];

            $.each(objects, function() {
                var item = [];

                $.each(this.attributes, function() {
                    if (this.specified) {
                        if (this.name.lastIndexOf(needle, 0) === 0) {
                            item[this.name.replace(needle, '')] = this.value;
                        }
                    }
                });

                items.push(item);
            });

            return items;
        },
        templating: function(template, data) {
            var HBScript = $('#' + template).html();

            if(HBScript === undefined) { 
                return '<div>Ningún plantilla "' + template + '" ' + 'encontrada.</div>';
            }

            var compiledTemplate = Handlebars.compile(HBScript);

            var html = compiledTemplate(data);

            return html;
        },
        request: function(url, method, data, callback) {
            $.ajax({
                url: url,
                method: method,
                data: data,
                success: function(json) {
                    if (json) {
                        callback(json);
                    } else {
                        console.log('Data error.');
                    }
                },
                error: function() {
                    console.log('Error.');
                }
            });
        },
        requestParams: function(url, method, data, callback, params) {
            $.ajax({
                url: url,
                method: method,
                data: data,
                success: function(json) {
                    if (json) {
                        callback(json, params);
                    } else {
                        console.log('Data error.');
                    }
                },
                error: function() {
                    console.log('Error.');
                }
            });
        }
    };

    $._FormBuilder.id = 0;
    $._FormBuilder.edition_mode = false;

    /*window.addEventListener("beforeunload", function(e) {
        var confirmationMessage = 'It looks like you have been editing something. ' +
            'If you leave before saving, your changes will be lost.';

        (e || window.event).returnValue = confirmationMessage; //Gecko + IE
        return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
    });*/

}(jQuery));

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