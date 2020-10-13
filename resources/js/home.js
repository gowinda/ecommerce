global.$ = global.jQuery = require('jquery');
require("../template/home/vendor/animsition/js/animsition");
require("bootstrap");
require("../template/home/vendor/slick/slick");
require("../template/home/js/slick-custom");
require("../template/home/vendor/parallax100/parallax100");
$('.parallax100').parallax100();
require("../template/home/vendor/MagnificPopup/jquery.magnific-popup.min");
$('.gallery-lb').each(function () {
    $(this).magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
            enabled: true
        },
        mainClass: 'mfp-fade'
    });
});
require("../template/home/vendor/isotope/isotope.pkgd.min");
require('../template/home/js/main');






