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
            self.initAjax();
            self.initEditorPreview();
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
        },

        initAjax: function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            this.initDataAjax();
            this.initAppendsModal();
        },

        initAppendsModal: function () {
            var self = this;
            var appendsContainer = $('.topic .appends-container');
            var appendText = appendsContainer.data('lang-append');
            var modal = $('#exampleModal');
            var submitBtn = modal.find('button[type=submit]');
            var count = 0;
            var appendMsg = '';

            modal.find('form').on('submit', function () {
                var tpl = '';
                count = appendsContainer.find('.appends').length;
                appendMsg = $(this).find('textarea').val();

                if ($.trim(appendMsg) !== '') {
                    submitBtn.html('提交中...').addClass('disabled').prop('disabled', true);
                    $.ajax({
                        method: 'POST',
                        url: $(this).attr('action'),
                        data: {
                            content: appendMsg
                        },
                    }).done(function (data) {
                        if (data.status === 200) {
                            tpl += '<div class="appends">';
                            tpl += '<span class="meta">' + appendText + ' ' + count + ' &nbsp;·&nbsp; <abbr title="' + data.append.created_at + '" class="timeago">' + data.append.created_at + '</abbr></span>';
                            tpl += '<div class="sep5"></div>';
                            tpl += '<div class="markdown-reply append-content">';
                            tpl += data.append.content;
                            tpl += '</div>';
                            tpl += '</div>';
                        }

                        $(tpl).hide().appendTo(appendsContainer).slideDown();
                        self.initTimeAgo();
                        modal.modal('hide');
                    });
                }

                return false;
            });

            modal.on('hidden.bs.modal', function () {
                $(this).find('textarea').val('');
                submitBtn.html('提交').removeClass('disabled').prop('disabled', false);
            });
        },

        /**
         * do content preview
         */
        runPreview: function () {
            var replyContent = $("#reply_content");
            var oldContent = replyContent.val();

            if (oldContent) {
                marked(oldContent, function (err, content) {
                    $('#preview-box').html(content);
                    emojify.run(document.getElementById('preview-box'));
                });
            }
        },

        initEditorPreview: function () {
            var self = this;
            $("#reply_content").focus(function (event) {
                $("#preview-box").fadeIn(1500);
                $("#preview-lable").fadeIn(1500);
            });
            $('#reply_content').keyup(function () {
                self.runPreview();
            });
        },

        initDataAjax: function () {
            var self = this;
            $(document).on('click', '[data-ajax]', function () {
                var that = $(this);
                var method = that.data('ajax');
                var url = that.data('url');
                var active = that.is('.active');
                var cancelText = that.data('lang-cancel');
                var isRecomend = that.is('#topic-recomend-button');
                var isWiki = that.is('#topic-wiki-button');
                var ribbonContainer = $('.topic .ribbon-container');
                var ribbon = $('.topic .ribbon');
                var excellent = $('.topic .ribbon-excellent');
                var wiki = $('.topic .ribbon-wiki');
                var total = $('.replies .total b');
                var voteCount = $('#vote-count');
                var upVote = $('#up-vote');
                var isVote = that.is('.vote');
                var isUpVote = that.is('#up-vote');
                var isCommentVote = that.is('.comment-vote');
                var commenVoteCount = that.find('.vote-count');
                var emptyBlock = $('#replies-empty-block');
                var originUpVoteActive = upVote.is('.active');

                if (Config.user_id === 0) {
                    swal({
                        title: "",
                        text: '需要登录以后才能执行此操作。',
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "取消",
                        confirmButtonText: "前往登录"
                    }, function () {
                        location.href = '/login-required';
                    });
                }

                if (method === 'delete') {
                    swal({
                        title: "",
                        text: "Are you sure want to proceed?",
                        type: "warning",
                        showCancelButton: true,
                        cancelButtonText: "取消",
                        confirmButtonText: "删除"
                    }, function () {
                        that.closest('.list-group-item').slideUp();
                        $.ajax({
                            method: method,
                            url: url
                        }).done(function (data) {
                            if (data.status === 200) {
                                that.closest('.list-group-item').remove();
                                total.html(parseInt(total.html()) - 1);
                                if (parseInt(total.html()) === 0) {
                                    emptyBlock.removeClass('hide');
                                }
                            }
                        }).fail(function () {
                            that.closest('.list-group-item').show();
                        });
                    });

                    return;
                }

                if (that.is('.ajax-loading')) return;
                that.addClass('ajax-loading');

                if (active) {
                    that.removeClass('active');
                    that.removeClass('animated rubberBand');

                    if (isRecomend) {
                        excellent.hide();
                    } else if (isWiki) {
                        wiki.hide();
                    }

                    if (isVote) {
                        // @CJ 如果是点赞，并且是已经点过赞的点赞，那就是去除点赞
                        $('.user-lists').find("a[data-userId='" + Config.user_id + "']").fadeOut('slow/400/fast', function () {
                            $(this).remove();
                        });
                    }
                } else {
                    that.addClass('active');
                    that.addClass('animated rubberBand');

                    if (cancelText) {
                        that.find('span').html(cancelText);
                        self.showPluginDownload();
                    }

                    if (isRecomend) {
                        var excellentText = ribbonContainer.data('lang-excellent');
                        if (excellent.length) {
                            excellent.show();
                        } else {
                            if (ribbon.length) {
                                ribbon.prepend('<div class="ribbon-excellent"><i class="fa fa-trophy"></i> ' + excellentText + ' </div>');
                            } else {
                                ribbonContainer.prepend('<div class="ribbon"><div class="ribbon-excellent"><i class="fa fa-trophy"></i> ' + excellentText + ' </div></div>');
                            }
                        }
                    } else if (isWiki) {
                        var wikiText = ribbonContainer.data('lang-wiki');
                        if (wiki.length) {
                            wiki.show();
                        } else {
                            if (ribbon.length) {
                                ribbon.append('<div class="ribbon-wiki"><i class="fa fa-graduation-cap"></i> ' + wikiText + ' </div>');
                            } else {
                                ribbonContainer.append('<div class="ribbon"><div class="ribbon-wiki"><i class="fa fa-graduation-cap"></i> ' + wikiText + ' </div></div>');
                            }
                        }
                    }

                    if (isVote && Config.user_id > 0) {
                        // @CJ 如果是点赞，并且是没有点过赞的
                        var newContent = $('.voted-template').clone();
                        newContent.attr('data-userId', Config.user_id);
                        newContent.attr('href', Config.user_link);
                        newContent.find('img').attr('src', Config.user_avatar);

                        newContent.prependTo('.user-lists').show('fast', function () {
                            $(this).addClass('animated swing');
                        });

                        $('.vote-hint').hide();
                    }
                }

                $.ajax({
                    method: method,
                    url: url
                }).done(function (data) {
                    if (data.status === 200) {
                        if (isCommentVote) {
                            var num = parseInt(commenVoteCount.html());
                            num = isNaN(num) ? 0 : num;

                            if (data.type === 'sub') {
                                commenVoteCount.html(num - 1 < 1 ? '' : num - 1);
                            } else if (data.type === 'add') {
                                commenVoteCount.html(num + 1);
                            }
                        }
                    }
                }).fail(function () {
                    if (!active) {
                        that.removeClass('active');

                        if (isRecomend) {
                            excellent.hide();
                        } else if (isWiki) {
                            wiki.hide();
                        }
                    } else {
                        that.addClass('active');

                        if (cancelText) {
                            that.find('span').html(cancelText);
                        }

                        if (isRecomend) {
                            excellent.show();
                        } else if (isWiki) {
                            wiki.show();
                        }
                    }

                    if (isVote) {
                        if (originUpVoteActive) {
                            upVote.addClass('active');
                        } else {
                            upVote.removeClass('active');
                        }
                    }
                }).always(function () {
                    that.removeClass('ajax-loading');
                });
            })
        }
    };

    window.DAILY = DAILY;
})(jQuery);

$(document).ready(function () {
    DAILY.init();
});

