define(['jquery','mage/translate','Magento_Ui/js/modal/modal'], function($, $t, modal) {
        var options = {
            type: 'popup',
            responsive: true,
            title: '',
            buttons: [{
                text: $.mage.__('Continue'),
                class: '',
                click: function () {
                    this.closeModal();
                }
            }]
        };

        var popup = modal(options, $('#popup-modal'));
        $("#customerIcon").on('click',function(){
            $("#popup-modal").modal("openModal");
        });

        $(".tab-li").click( function() {
             var dataToggle = $(this).children('a').attr('href');
             $(".tab-li").attr('class','tab-li');
             $(this).attr('class','tab-li active');
             $(".tab-pane").attr('class','tab-pane');
             $("#" + dataToggle + "").addClass('active');
        })
    }
);