(function ($) {

    var DAILY = {
        init: function () {
            var self = this;

            self.siteBootUp();
        },

        siteBootUp: function () {
            var self = this;
            self.initPopup();
        },

        /**
         * Scroll to top in one click.
         */
        initPopup: function () {
            // Popover with html
            $('.popover-with-html').popover({
                html: true,
                trigger: 'hover',
                container: 'body',
                placement: 'auto top',
            });
        },
    };

    window.DAILY = DAILY;
})(jQuery);

$(document).ready(function () {
    DAILY.init();
});

