<div class="tw-flex tw-flex-col">
    <div class="tw-flex tw-flex-col pa-3 bb-light-1">
        <h1 class="tw-text-3xl tw-font-bold tw-text-[#000C17] dark:tw-text-white tw-flex tw-items-center tw-leading-none">
            <a href="{{ $forumUrl }}" class="tw-no-underline tw-mr-2">
                <i class="fas fa-arrow-circle-left tw-text-3xl tw-mt-1 dark:tw-text-white"></i>
            </a>
            Create a Thread
        </h1>
    </div>
    <div class="tw-flex tw-flex-col ph pv-3" >
        <div class="tw-flex tw-flex-row">
            <div class="tw-flex tw-flex-col avatar-column hide-xs-only">
                <img class="rounded" src="{{ $userAvatar }}">
            </div>
            <div class="tw-flex tw-flex-col ph tw-w-full">
                <form action="{{ $formAction }}" method="post" id="createThreadForm">
                    {{ csrf_field() }}
                    {{ method_field($method) }}

                    <div class="form-group tw-mb-2">
                        <input type="text" name="title" id="title" value="{{ old('title') }}" 
                               class="tw-pb-0 dark:tw-bg-transparent dark:tw-text-white dark:tw-border-[#223F57]"
                        >
                        <label for="title" class="dark:tw-text-[#9EC0DC] {{ $brand }}">Title</label>

                        @include('partials.bladesora.members.inputs.partials._errors', [
                            "inputErrors" => $errors->get('title')
                        ])
                    </div>

                    @if(!empty($topicOptions))
                        <div class="form-group tw-mb-2">
                            <select id="forum" name="category_id" class="dark:tw-text-white tw-pb-0">
                                <option selected disabled style="display:none;">
                                @foreach($topicOptions as $index => $topic)
                                    <option class="dark:tw-text-black" value="{{ $index }}" {!! (app('request')->input('thread-title') === $topic) ? 'selected' : '' !!} >{{ $topic }}</option>
                                @endforeach
                            </select>
                            <label for="forum" class="{{ $brand }}">Forum</label>

                            @include('partials.bladesora.members.inputs.partials._errors', [
                                "inputErrors" => $errors->get('category_id')
                            ])
                        </div>
                    @else
                        <input type="hidden" name="category_id" value="1">
                    @endif

                    <text-editor field-key="first_post_content"
                                 :is-dark-mode="slotProps.isDarkMode"
                                 initial-value="{{ old('first_post_content') }}">
                    </text-editor>

                    @if(!empty($errors->get('first_post_content')))
                        <p class="tiny text-error pa">* The post content field is required</p>
                    @endif

                    <div class="tw-flex tw-flex-row tw-justify-end mt-2">
                        <a href="{{ $forumUrl }}"
                           class="tw-btn-primary tw-bg-transparent tw-text-black dark:tw-text-white hover:tw-bg-slate-200/50 tw-mr-1" dusk="cancel-button">
                            Cancel
                        </a>

                        <button class="tw-btn-primary tw-bg-{{ $brand }}" type="submit" dusk="submit-button">
                            Create Thread
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>