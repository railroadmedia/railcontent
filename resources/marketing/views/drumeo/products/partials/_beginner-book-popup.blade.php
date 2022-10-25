<div class="columns">
    <div class="thumbnail-wrap" data-open="chapter{{ $chapterNumber }}-modal" style="background-image:url('{{ cdn('books/best-beginner-drum-book/sales/chapter') . $chapterNumber . '.jpg' }}');">
        <div class="magnify"><i class="far fa-search-plus"></i></div>
    </div>
    <p>{{ $chapterSubTitle }}<br>
        <strong>{{ $chapterTitle }}</strong></p>

    <div class="reveal large text-center" id="chapter{{ $chapterNumber }}-modal" data-reveal data-reset-on-close="true">

        <img src="{{ cdn('books/best-beginner-drum-book/sales/chapter') . $chapterNumber . '.jpg' }}">
    </div>
</div>