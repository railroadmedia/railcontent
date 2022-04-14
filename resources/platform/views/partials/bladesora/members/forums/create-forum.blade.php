<div class="tw-flex tw-flex-col">
    <div class="tw-flex tw-flex-col pa-3 bb-light-1">
        <h1 class="heading">
            <a href="{{ $forumUrl }}" class="tw-no-underline tw-mr-1">
                <i class="fas fa-arrow-circle-left text-grey-2"></i>
            </a>
            Create a Forum
        </h1>
    </div>
    <div class="tw-flex tw-flex-col ph pv-3">
        <div class="tw-flex tw-flex-row">
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

                    <div class="form-group mb-2">
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

                    <div class="tw-flex tw-flex-row align-h-right tw-mt-2">
                        <a href="{{ $forumUrl }}"
                           class="btn tw-bg-black tw-text-black tw-no-underline flat collapse-150 tw-border-none tw-mr-1" dusk="cancel-button">
                            Cancel
                        </a>

                        <button class="btn collapse-320" type="submit" dusk="submit-button">
                            <span class="tw-bg-{{ $brand }} tw-text-white corners-10">
                                Create Forum
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>