define([
    'jquery',
    'jquery/ui',
    'mage/translate'
], function ($) {
    'use strict';

    $.widget('alexYeCustomerPreferences.openButton', {
        options: {
            hideButton: true
        },

        /**
         * @private
         */
        _create: function () {
            $(this.element).on('click.alexYe_customerPreferences', $.proxy(this.openPreferences, this));
            $(this.element).on('alexYe_CustomerPreferences_closePreferences.alexYe_customerPreferences', $.proxy(this.closePreferences, this));
        },

        /**
         * jQuery(jQuery('.alex-ye-customer-preferences-open-button').get(0)).data('alexYeCustomerPreferencesOpenButton').destroy()
         * @private
         */
        _destroy: function () {
            $(this.element).off('click.alexYe_customerPreferences');
            $(this.element).off('alexYe_CustomerPreferences_closePreferences.alexYe_customerPreferences');
        },

        /**
         * Open preferences sidebar
         */
        openPreferences: function () {
            console.log(1);
            $(document).trigger('alexYe_CustomerPreferences_openPreferences');

            if (this.options.hideButton) {
                $(this.element).removeClass('active');
            }
        },

        /**
         * Close preferences sidebar
         */
        closePreferences: function () {
            $(this.element).addClass('active');
        }
    });

    return $.alexYeCustomerPreferences.openButton;
});
