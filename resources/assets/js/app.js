(function ($) {

    var DAILY = {
        init: function () {
            var self = this;

            self.siteBootUp();
        },

        siteBootUp: function () {
            var self = this;
            self.initTimeAgo();
            self.initPopup();
        },

        initTimeAgo: function(){
            moment.lang('zh-cn');
            $('.timeago').each(function(){
                var time_str = $(this).text();
                if(moment(time_str, "YYYY-MM-DD HH:mm:ss", true).isValid()) {
                    $(this).text(moment(time_str).fromNow());
                }

                $(this).addClass('popover-with-html');
                $(this).attr('data-content', time_str);
            });
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

