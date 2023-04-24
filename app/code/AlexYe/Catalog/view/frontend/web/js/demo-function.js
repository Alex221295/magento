define(
    [
        'jquery',
    ],
    function ($) {
        'use strict';
        $.widget('alexYe.catalog_demoFunction',{
            option:{
                text: 'Default text'
            },
            _create: function () {
                this.append();
            },
            append: function (){
                var tag = $('<p></p>').html(this.option.text)
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
