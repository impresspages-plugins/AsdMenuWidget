<div class="ip">
    <div id="ipWidgetMenuPopup" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php _e('Menu options', 'CpThemeWidgets'); ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $form->render(); ?>
                </div>
                <!--button id="testas" type="button">Browse</button-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('Cancel', 'Ip-admin'); ?></button>
                    <button type="button" class="btn btn-primary ipsConfirm"><?php _e('Confirm', 'Ip-admin'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ip">
    <div id="ipWidgetMenuBrowseLinkPopup" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><?php _e('Menu options', 'CpThemeWidgets'); ?></h4>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('Cancel', 'Ip-admin'); ?></button>
                    <button type="button" class="btn btn-primary ipsConfirm"><?php _e('Confirm', 'Ip-admin'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $this = $('#ipWidgetMenuPopup');
    $this.find('fieldset').each(function (index, fieldset) {
        var $fieldset = $(fieldset);
        var $legend = $fieldset.find('legend');

        // if legend exist it means its option group
        if ($legend.length) {
            // adding required attributes to make collapse() to work
            $legend
                .attr('data-toggle', 'collapse')
                .attr('data-target', '#propertiesCollapse'+index)
                .addClass('collapsed');
            $fieldset.find('.form-group').wrapAll('<div class="collapse" id="propertiesCollapse'+index+'" />');
        }
    });
    ipInitForms();
        
    
    /*
    return this.each(function(){
        var $this=$(this);
        var $input=$(this).find('input');
        var data=$this.data('ipFormUrl');
        if(!data){
            $this.data('ipFormUrl',{initialized:1});
            $this.find('.ipsBrowse').on('click',function(){
                ipBrowseLink(function(link){
                    if(link){
                        $input.val(link).change();
                    }});
            });
        }});
    }};
    */
    /*
    $('body').on('hidden.bs.modal','#ipBrowseLinkModal',function(e,response){
            e.preventDefault();
            $iframe = $(this).find('.ipsPageSelectIframe');
            var iframeWindow = $iframe.get(0).contentWindow;
            selectedPageId= iframeWindow.angular.element( iframeWindow.$('.ipAdminPages') ).scope().selectedPageId;
            console.log(selectedPageId);
            $('#ipWidgetMenuPopup').find('[name="redirectUrl"]').val(selectedPageId);

    });
    */
    
    /*
    if(typeof ipBrowseLinkModalTemplate!=="undefined"){
        $('body').append(ipBrowseLinkModalTemplate);
    }};this.setManagementMode=function(mode){$.ajax({url:ip.baseUrl,dataType:'json',type:'POST',data:{aa:'Content.setManagementMode',value:mode,securityToken:ip.securityToken},success:function(response){if(response){window.location=window.location.href.split('#')[0].split('?')[0]+'?_revision='+ip.revisionId;}else{window.location=ip.baseUrl+'admin';}},error:function(response){alert('error: '+response);}});};};
    */
    $('#ipWidgetMenuPopup').on('click', '#testas', function () {
        /*
        var $modal = $('#ipWidgetMenuBrowseLinkPopup');
        $('#ipWidgetMenuBrowseLinkPopup .modal-body').html( $(ipBrowseLinkModalTemplate).find('.ipsPageSelectIframe') );
        var $iframe = $modal.find('.ipsPageSelectIframe');
        $iframe.attr('src',$iframe.data('source'));
        $('#ipWidgetMenuBrowseLinkPopup').modal('show');
        */
    });
    $('body').on('click', '#ipWidgetMenuBrowseLinkPopup .ipsConfirm',function(){
        /*
        var $modal = $('#ipWidgetMenuBrowseLinkPopup');
        var $iframe = $modal.find('.ipsPageSelectIframe');
        var iframeWindow = $iframe.get(0).contentWindow;
        //selectedPageId = iframeWindow.angular.element( iframeWindow.$('.ipAdminPages') ).scope().selectedPageId;
        selectedPageId = iframeWindow.angular.element( iframeWindow.$('.ipAdminPages') ).scope().selectedPageId;
        console.log(selectedPageId);
        */
        /*
        var iframeWindow = $iframe.get(0).contentWindow;
        console.log(iframeWindow );
        
        */
        //$modal.modal('hide');
        //
        /*
        $iframe = $(this).find('.ipsPageSelectIframe');

        console.log(selectedPageId);
        $('#ipWidgetMenuPopup').find('[name="redirectUrl"]').val(selectedPageId);
        */
    });
</script>