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
            self.initDeleteForm();
        },

        initTimeAgo: function () {
            moment.lang('zh-cn');
            $('.timeago').each(function () {
                var time_str = $(this).text();
                if (moment(time_str, "YYYY-MM-DD HH:mm:ss", true).isValid()) {
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

        initDeleteForm: function () {
            $('[data-method]')
                .append(function () {
                    return "\n" +
                        "<form action='" + $(this).attr('data-url') + "' method='POST' style='display:none'>\n" +
                        "   <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n" +
                        "   <input type='hidden' name='_token' value='" + Config.token + "'>\n" +
                        "</form>\n"
                })
                .attr('style', 'cursor:pointer;')
                .click(function () {
                    var that = $(this);
                    if ($(this).attr('data-method') == 'delete') {
                        swal({
                            title: "",
                            text: "你确定要删除此内容吗？",
                            type: "warning",
                            showCancelButton: true,
                            cancelButtonText: "取消",
                            confirmButtonText: "删除"
                        }, function () {
                            that.find("form").submit();
                        });
                    }
                    if ($(this).attr('data-btn') == 'transform-button') {
                        swal({
                            title: "",
                            text: "确定要把此话题转换为专栏文章？",
                            type: "warning",
                            showCancelButton: true,
                            cancelButtonText: "取消",
                            confirmButtonText: "转为文章"
                        }, function () {
                            that.find("form").submit();
                        });
                    }
                    if ($(this).attr('data-method') == 'post') {
                        $(this).find("form").submit();
                    }
                });
        }
    };

    window.DAILY = DAILY;
})(jQuery);

$(document).ready(function () {
    DAILY.init();
});

