<div>
    <h4 class="tw-font-bold tw-text-lg tw-uppercase tw-mb-6 md:tw-text-xl lg:tw-text-2xl">Topics Include</h4>
    <ul class="fa-ul topics-list tw-ml-6">
        @foreach ($topicList as $topicListItem)
            <li class="tw-text-lg tw-leading-5 tw-mb-4"><i class="fa-li fas fa-check-circle tw-text-base"></i> {!! trans(nl2br($topicListItem->desc)) !!}</li>
        @endforeach
    </ul>
</div>
