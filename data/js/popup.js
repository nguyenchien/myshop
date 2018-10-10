/**
 * Created by PC-06 on 13/07/2018.
 */

var Popup = {
    status: 'close',
    init: function () {
        var bodyEl =  $('body');
        bodyEl.on('click', '#closePopup', function(e) {
            e.preventDefault();
            Popup.closePopup();
        });
        bodyEl.on('click', '#addToCart', function(e) {
            e.preventDefault();
            Popup.showPopup();
        });
    },
    showPopup: function () {
        this.status = 'show';
        $('#containerPopupCart').fadeIn('600').addClass('container-popup-cart-overflow');
        $('html').addClass('popup-open-overflow');
    },
    closePopup: function () {
        this.status = 'close';
        $('#containerPopupCart').hide().removeClass('container-popup-cart-overflow');
        $('html').removeClass('popup-open-overflow');

        // Reload lại page để load lại content popup
        location.reload();
    }
};