define(
    [
        'jquery',
    ],
    function ($) {
        'use strict';
        $.widget('alexYe.catalog_demoFunction',{
            _create: function () {
                var tag = $('<p></p>').html('Some message')
                $(this.element).append(tag)
            }
        });

        // return function (){
        //     var tag = $('<p></p>').html('Some message')
        //     $("#js-demo").append(tag)

        // }
        return $.alexYe.catalog_demoFunction;
    }
);
