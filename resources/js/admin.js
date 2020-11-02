global.$ = global.jQuery = require('jquery');
require('bootstrap/dist/js/bootstrap');
require('metismenu/dist/metisMenu');
require('jquery-slimscroll/jquery.slimscroll');
require('../template/admin/assets/js/app');

setTimeout(function (){
    $('.alert').slideUp();
}, 3000);
