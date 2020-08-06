var page = 2;
jQuery(function ($) {
    $('body').on('click', '.loadmore', function () {
        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'security': blog.security,

        };
        $('.loadmore').hide();
        $('.rt-no-more-post').hide();

        $('.blog-posts1').append('<div class="rtloderstyle">load more ..<img src="https://qik.radiantthemes.com/wp-content/themes/qik/assets/images/loder.gif"></div>');
        $.post(blog.ajaxurl, data, function (response) {
            if (response == 0) {
                $('.loadmore').hide();
                $('.rtloderstyle').hide();
                $('.rt-no-more-post').show();

            } else if (response != '') {

                $('.blog-posts').append(response);
                page++;
                $('.rtloderstyle').hide();
                $('.loadmore').show();
            } else {
                $('.loadmore').hide();
                $('.rt-no-more-post').show();
            }
        });
    });
});
