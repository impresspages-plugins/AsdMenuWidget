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
</script>