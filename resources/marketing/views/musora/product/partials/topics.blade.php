<div class="mt-10">
    <h4 class="font-bold text-lg uppercase mb-6 md:text-xl lg:text-2xl">Topics Include</h4>
    <ul class="fa-ul topics-list ml-6">
        @foreach ($topicList as $topicListItem)
            <li class="text-lg leading-5 mb-4"><i class="fa-li fas fa-check-circle text-base"></i> {!! trans(nl2br($topicListItem->desc)) !!}</li>
        @endforeach
    </ul>
</div>
