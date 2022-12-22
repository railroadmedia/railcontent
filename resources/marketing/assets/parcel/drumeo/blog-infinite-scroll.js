let scroll = true;
let page = 1;
let params = window.location.search;

function listNotGrid(htmlPage) {
    return htmlPage.find('.post-list').children().length > 0;
}

function success(html) {
    let htmlPage = $(html);
    let posts = htmlPage.find('.post-grid').children();

    if (listNotGrid(htmlPage)) {
        posts = htmlPage.find('.post-list').children();
    }

    if (posts.length === 0) {
        $('.load-more-button').addClass('fade-out');
    } else {
        $('.post-grid').append(posts); // This will be the div where our content will be loaded
        if (listNotGrid(htmlPage)) {
            $('.post-list').append(posts); // This will be the div where our content will be loaded
        }
        scroll = true;
    }
}

function loadMore() {
    page++;
    scroll = false;

    let pathname = window.location.pathname;
    let url = pathname + 'page/' + page + '/' + params;

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html',
        success: function (html) {
            success(html);
        },
        error: function (error) {
            if(error.status === 404){
                $('.load-more-button').addClass('fade-out');
            }
        }
    });
}

if (params === '') {
    params = '?';
}

$( document ).ready(function() {
    loadMore();
});

$(window).scroll(function () {
    if ($(window).scrollTop() > $(document).height() - $(window).height() - 800 && scroll) {
        loadMore();
    }
});

$('.load-more-button').on('click', function() {
    loadMore();
});