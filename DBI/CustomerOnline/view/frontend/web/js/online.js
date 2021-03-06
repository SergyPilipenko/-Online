define([
        'jquery',
        'uiComponent',
        'mage/url',
        'Magento_Customer/js/customer-data',
        'mage/translate'
    ],
    function ($, Component, urlBuilder, customerData
    ) {
        'use strict';
        return Component.extend({
            /** @inheritdoc */
            initialize: function () {
                this._super();
                this.customSection = customerData.get('online');

                $(document).on('click', '.online_status', function () {
                    const statusValue = $(this).text();
                    const oldStatus = $('.online-status-value').text();

                    if (oldStatus != statusValue) {
                        $('.online-status-value').text(statusValue);
                        const url = '/rest/V1/customer/customer-online/save/' + statusValue;
                        const verb = 'GET';
                        $.ajax({
                            url: url,
                            type: verb,
                            showLoader: true,
                            cache: false,
                            success: function (response) {
                                customerData.set('messages', {
                                    messages: [{
                                        text: $.mage.__('You have successfully changed the status to ') + statusValue,
                                        type: 'success'
                                    }]
                                });
                            },
                            error: function () {
                                customerData.set('messages', {
                                    messages: [{
                                        text: $.mage.__('Something went wrong'),
                                        type: 'error'
                                    }]
                                });
                            }
                        });
                    }
                });

            }
        });
    });
