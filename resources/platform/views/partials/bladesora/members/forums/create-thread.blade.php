<div class="tw-flex tw-flex-col">
    <div class="tw-flex tw-flex-col pa-3 bb-light-1">
        <h1 class="heading">
            <a href="{{ $forumUrl }}" class="tw-no-underline tw-mr-1">
                <i class="fas fa-arrow-circle-left text-grey-2"></i>
            </a>
            Create a Thread
        </h1>
    </div>
    <div class="tw-flex tw-flex-col ph pv-3">
        <div class="tw-flex tw-flex-row">
            <div class="tw-flex tw-flex-col avatar-column hide-xs-only">
                <img class="rounded" src="{{ $userAvatar }}">
            </div>
            <div class="tw-flex tw-flex-col ph">
                <form action="{{ $formAction }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field($method) }}

                    <div class="form-group tw-mb-2">
                        <input type="text" name="title" id="title" value="{{ old('title') }}">
                        <label for="title" class="{{ $brand }}">Title</label>

                        @include('partials.bladesora.members.inputs.partials._errors', [
                            "inputErrors" => $errors->get('title')
                        ])
                    </div>

                    @if(!empty($topicOptions))
                        <div class="form-group tw-mb-2">
                            <select id="forum" name="category_id">
                                <option selected disabled style="display:none;">
                                @foreach($topicOptions as $index => $topic)
                                    <option value="{{ $index }}" {!! (app('request')->input('thread-title') === $topic) ? 'selected' : '' !!} >{{ $topic }}</option>
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
                                 initial-value="{{ old('first_post_content') }}"></text-editor>

                    @if(!empty($errors->get('first_post_content')))
                        <p class="tiny text-error pa">* The post content field is required</p>
                    @endif

                    <div class="tw-flex tw-flex-row align-h-right mt-2">
                        <a href="{{ $forumUrl }}"
                           class="btn tw-bg-black tw-text-black tw-no-underline flat collapse-150 tw-border-none tw-mr-1" dusk="cancel-button">
                            Cancel
                        </a>

                        <button class="btn collapse-320" type="submit" dusk="submit-button">
                            <span class="tw-bg-{{ $brand }} text-white corners-10">
                                Create Thread
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>