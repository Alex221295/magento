define([
    'jquery',
    'ko',
    'uiComponent',
    'AlexYe_CustomerPreferences/js/model/customer-preferences',
    // Guarantee that the form is initialized and labels are present in the model
    'alexYe_customerPreferences_form'
], function ($, ko, Component, customerPreferencesModel) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'AlexYe_CustomerPreferences/sidebar'
        },

        customerPreferences: customerPreferencesModel.preferences,
        sidebarClass: ko.observable(''),

        /** @inheritdoc */
        initialize: function () {
            this._super();

            $(document).on(
                'alexYe_CustomerPreferences_openPreferences.alexYe_customerPreferences',
                $.proxy(this.openPreferences, this)
            );
        },

        /**
         * Open preferences sidebar
         */
        openPreferences: function () {
            this.sidebarClass('active');
        },

        /**
         * Open popup with the form to edit preferences
         */
        editPreferences: function () {
            $(document).trigger('alexYe_CustomerPreferences_editPreferences');
        },

        /**
         * Close preferences sidebar
         */
        closeSidebar: function () {
            this.sidebarClass('');
            $(document).trigger('alexYe_CustomerPreferences_closePreferences');
        }
    });
});
