define(
    [
        'jquery',
        'jquery/ui'
    ],
    function ($) {
        'use strict';
        $.widget('alexYe.catalog_demoFunction',{
            options:{
                text: 'Default text'
            },
            _create: function () {
                this.append();
            },
            append: function (){
                var tag = $('<p></p>').html(this.options.text)
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
