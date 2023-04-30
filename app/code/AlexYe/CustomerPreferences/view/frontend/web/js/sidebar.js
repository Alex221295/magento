define([
    'jquery',
    'alexYe_customerPreferences_form'
], function ($) {
    'use strict';

    $.widget('alexYeCustomerPreferences.sidebar', {
        options: {
            sidebarOpenButton: '.alex-ye-customer-preferences-open-button',
            editButton: '#alex-ye-customer-preferences-edit-button',
            closeSidebar: '#alex-ye-customer-preferences-close-sidebar-button',
            customerPreferencesList: '#alex-ye-customer-preferences-list',
            form: '#alex-ye-customer-preferences-form'
        },

        /**
         * @private
         */
        _create: function () {
            $(document).on('alexYe_CustomerPreferences_openPreferences.alexYe_customerPreferences', $.proxy(this.openPreferences, this));
            $(this.options.closeSidebar).on('click.alexYe_customerPreferences', $.proxy(this.closePreferences, this));
            $(this.options.editButton).on('click.alexYe_customerPreferences', $.proxy(this.editPreferences, this));

            // make the hidden form visible after the styles are initialized
            $(this.element).show();
        },

        /**
         * @private
         */
        _destroy: function () {
            $(document).off('alexYe_CustomerPreferences_openPreferences.alexYe_customerPreferences');
            $(this.options.closeSidebar).off('click.alexYe_customerPreferences');
            $(this.options.editButton).off('click.alexYe_customerPreferences');
        },

        /**
         * Open preferences sidebar
         */
        openPreferences: function () {
            $(this.element).addClass('active');
        },

        /**
         * Close preferences sidebar
         */
        closePreferences: function () {
            $(this.element).removeClass('active');
            $(this.options.sidebarOpenButton).trigger('alexYe_CustomerPreferences_closePreferences');
        },

        /**
         * Open popup with the form to edit preferences
         */
        editPreferences: function () {
            console.log($(this.options))
            $(this.options.form).data('mage-modal').openModal();
        }
    });

    return $.alexYeCustomerPreferences.sidebar;
});
