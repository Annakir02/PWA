define('qtyWidget',['jquery','mage/translate','jquery-ui-modules/widget'], function ($) {
    $.widget("mage.qtyWidget", {

        _create: function() {
            $(this.element.find('.plus')).click(function () {
                var inputId = $('#' + $(this).parent().children('input').attr('id'));
                inputId.val(parseInt(inputId.val()) + 1);
            });

            $(this.element.find('.minus')).click(function () {
                var inputId = $('#' + $(this).parent().children('input').attr('id'));
                if (inputId.val() > 0) {
                    inputId.val(parseInt(inputId.val()) - 1);
                }
            })
        }
    });

    return $.mage.qtyWidget;
});