<div class="tw-flex tw-flex-col tw-bg-white tw-shadow corners-10">
    <div class="tw-flex tw-flex-col pa-3 bb-light-1">
        <h1 class="heading">
            <a href="{{ $forumUrl }}" class="tw-no-underline tw-mr-1">
                <i class="fas fa-arrow-circle-left text-grey-2"></i>
            </a>
            Edit Thread Details
        </h1>
    </div>
    <div class="tw-flex tw-flex-col ph pv-3">
        <div class="tw-flex tw-flex-row">
            <div class="tw-flex tw-flex-col ph">
                <form action="{{ $formAction }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field($method) }}

                    <input type="hidden" name="redirect" value="{{ $forumUrl }}">
                    <div class="form-group tw-mb-2">
                        <input type="text" name="title" id="title" value="{{ $thread['title'] }}">
                        <label for="title" class="{{ $brand }}">Title</label>

                        @include('partials.bladesora.members.inputs.partials._errors', [
                            "inputErrors" => $errors->get('title')
                        ])
                    </div>

                    @if(!empty($topicOptions))
                    <div class="form-group tw-mb-2">
                        <select id="postTopic" name="category_id">
                            @foreach($topicOptions as $topicId => $topic)
                                <option
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

                    <div class="tw-flex tw-flex-row align-h-right tw-mt-2">
                        <a href="{{ $forumUrl }}"
                           class="btn tw-bg-black tw-text-black tw-no-underline flat collapse-150 tw-border-none tw-mr-1">
                            Cancel
                        </a>

                        <button class="btn collapse-320" type="submit">
                            <span class="tw-bg-{{ $brand }} tw-text-white corners-10">
                                Edit Thread
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
