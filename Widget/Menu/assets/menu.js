IpWidget_Menu = function() {

    this.$widgetObject = null;

    this.init = function($widgetObject, data) {
        this.widgetObject = $widgetObject;
        this.data = data;
        var context = this;
        $('.ipsWidgetEdit').on('click', $.proxy(openPopup, context));
    };

    this.onAdd = function() {
        $.proxy(openPopup, this)();
    };

    var openPopup = function() {
        var $this = this;
        this.popup = $('#ipWidgetMenuPopup');
        this.confirmButton = $this.popup.find('.ipsConfirm');

        var $fields = new Object();
        
        if( this.data !== undefined ) {
            data = QueryStringToJSON(this.data.serialized);
            $.each(data, function( ind, val ) {
                var $el = $this.popup.find('[name="'+ind+'"]');
                if( $el.attr('type') === 'checkbox' ) {
                    $el.attr('checked',true);
                } else {
                    $el.val(val);
                }
            }); 
        }
        this.popup.modal(); // open modal popup

        this.confirmButton.off(); // ensure we will not bind second time
        this.confirmButton.on('click', $.proxy(save, this));
    };

    var save = function() {
        var data = new Object();
        data = {
            serialized : this.popup.find('form').serialize()
        };
        this.widgetObject.save(data, 1, function() {
            $('.ipsModuleInlineManagementImage').ipModuleInlineManagementImage();
        });
        this.popup.modal('hide');
    };

};

function QueryStringToJSON(str) { 
    var pairs = str.replace( /%5B/g, '[' ).replace( /%5D/g, ']' ).split('&');
    
    var result = {};
    pairs.forEach(function(pair) {
        pair = pair.split('=');
        result[pair[0]] = decodeURIComponent(pair[1] || '');
    });

    return JSON.parse(JSON.stringify(result));
}