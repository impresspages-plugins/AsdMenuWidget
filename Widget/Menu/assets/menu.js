IpWidget_Menu = function() {

    this.$widgetObject = null;

    this.init = function($widgetObject, data) {
        this.widgetObject = $widgetObject;
        this.data = data;
        var context = this;
        this.$button = this.widgetObject.find('.ipsWidgetEdit');
        this.$button.on('click', $.proxy(openPopup, context));
    };

    this.onAdd = function() {
        $.proxy(openPopup, this)();
    };

    var openPopup = function() {
        var $this = this;
        this.popup = $('#ipWidgetMenuPopup');
        this.confirmButton = $this.popup.find('.ipsConfirm');

        if( this.data.serialized !== undefined ) {
            data = QueryStringToJSON(this.data.serialized);
            $.each(data, function( ind, val ) {
                var $el = $this.popup.find('[name="'+ind+'"]');
                $el.val(val);
            }); 
        }
        this.popup.modal(); // open modal popup
        this.confirmButton.off(); // ensure we will not bind second time
        this.confirmButton.on('click', $.proxy(save, this));
    };

    var save = function() {
        this.data = {
            serialized : this.popup.find('form').serialize()
        };
        this.widgetObject.save(this.data, 1, function() {
            $('.ipsModuleInlineManagementImage').ipModuleInlineManagementImage();
        });
        this.popup.modal('hide');
    };

};

function QueryStringToJSON(str) { 
    var pairs = str.replace('+', ' ').replace( /%5B/g, '[' ).replace( /%5D/g, ']' ).split('&');
    
    var result = {};
    pairs.forEach(function(pair) {
        pair = pair.split('=');
        result[pair[0]] = decodeURIComponent(pair[1] || '');
    });

    return JSON.parse(JSON.stringify(result));
}