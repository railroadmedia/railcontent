<div class="tw-flex tw-flex-col">
    <div class="tw-flex tw-flex-col pa-3 bb-light-1">
        <h1 class="tw-text-3xl tw-font-bold tw-text-[#000C17] dark:tw-text-white tw-flex tw-items-center tw-leading-none">
            <a href="{{ $forumUrl }}" class="tw-no-underline tw-mr-2">
                <i class="fas fa-arrow-circle-left tw-text-3xl tw-mt-1 dark:tw-text-white"></i>
            </a>
            Update Forum
        </h1>
    </div>
    <div class="tw-flex tw-flex-col ph pv-3">
        <div class="tw-flex tw-flex-row">
            <div class="tw-flex tw-flex-col ph tw-w-full">
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

                    <div class="form-group tw-mb-2">
                        <input type="text" name="description" id="description" value="{{ old('description') }}">
                        <label for="description" class="{{ $brand }}">Description</label>

                        @include('partials.bladesora.members.inputs.partials._errors', [
                            "inputErrors" => $errors->get('description')
                        ])
                    </div>

                    <div class="form-group tw-mb-2">
                        <input type="text" name="weight" id="weight" value="{{ old('weight') }}">
                        <label for="weight" class="{{ $brand }}">Weight (order), any number</label>

                        @include('partials.bladesora.members.inputs.partials._errors', [
                            "inputErrors" => $errors->get('weight')
                        ])
                    </div>

                    <div class="form-group tw-mb-2">
                        <input type="text" name="icon" id="icon" value="{{ old('icon-class') }}">
                        <label for="icon-class" class="{{ $brand }}">Icon class</label>

                        @include('partials.bladesora.members.inputs.partials._errors', [
                            "inputErrors" => $errors->get('icon-class')
                        ])
                    </div>

                    <div class="tw-flex tw-flex-row align-h-right tw-mt-2 tw-justify-end ">
                        <a href="{{ $forumUrl }}"
                           class="tw-btn-primary tw-bg-transparent tw-text-black dark:tw-text-white hover:tw-bg-slate-200/50 tw-mr-1" dusk="cancel-button">
                            Cancel
                        </a>

                        <button class="tw-btn-primary tw-bg-{{ $brand }}" type="submit" dusk="submit-button">
                            Update Forum
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>