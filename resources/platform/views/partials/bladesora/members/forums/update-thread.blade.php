<div class="tw-flex tw-flex-col tw-bg-white tw-shadow corners-10">
    <div class="tw-flex tw-flex-col pa-3 bb-light-1">
        <h1 class="tw-text-3xl tw-font-bold tw-text-[#000C17] dark:tw-text-white tw-flex tw-items-center tw-leading-none">
            <a href="{{ $forumUrl }}" class="tw-no-underline tw-mr-2">
                <i class="fas fa-arrow-circle-left tw-text-3xl tw-mt-1 dark:tw-text-white"></i>
            </a>
            Edit Thread Details
        </h1>
    </div>
    <div class="tw-flex tw-flex-col ph pv-3">
        <div class="tw-flex tw-flex-row">
            <div class="tw-flex tw-flex-col ph tw-w-full">
                <form action="{{ $formAction }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field($method) }}

                    <input type="hidden" name="redirect" value="{{ $forumUrl }}">
                    <div class="form-group tw-mb-2">
                        <input type="text" name="title" id="title" value="{{ $thread['title'] }}" class="tw-pb-0 dark:tw-bg-transparent dark:tw-text-white dark:tw-border-[#445F74]">
                        <label for="title" class="{{ $brand }}">Title</label>

                        @include('partials.bladesora.members.inputs.partials._errors', [
                            "inputErrors" => $errors->get('title')
                        ])
                    </div>

                    @if(!empty($topicOptions))
                    <div class="form-group tw-mb-2">
                        <select id="postTopic" name="category_id" class="dark:tw-text-white tw-pb-0">
                            @foreach($topicOptions as $topicId => $topic)
                                <option
                                    class="dark:tw-text-[#00101D]"
                                    {{ $thread['category_id'] == ($topicId) ? 'selected' : '' }}
                                    value="{{ $topicId }}">{{ $topic }}</option>
                            @endforeach
                        </select>
                        <label for="postTopic" class="{{ $brand }}">Forum</label>

                        @include('partials.bladesora.members.inputs.partials._errors', [
                            "inputErrors" => $errors->get('category_id')
                        ])
                    </div>
                    @endif

                    <div class="tw-flex tw-flex-row align-h-right tw-mt-2 tw-justify-end ">
                        <a href="{{ $forumUrl }}"
                           class="tw-btn-primary tw-bg-transparent tw-text-[#00101D] dark:tw-text-white hover:tw-bg-slate-200/50 dark:hover:tw-bg-white/10 tw-mr-1">
                            Cancel
                        </a>

                        <button class="tw-btn-primary tw-bg-{{ $brand }}" type="submit">
                            Edit Thread
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
