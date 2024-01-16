@component('partials.bladesora.members.account.settings.edit-form', [
    "gearForm" => true
])
    @slot('formTitle')
        My Singing Gear
    @endslot

    @slot('modalId')
        singingGearModal
    @endslot

    @slot('formData')
        <div class="flex flex-column grow">
            @include('partials.bladesora.members.account.partials._text-fields', [
                "fields" => [
                    "Singing Since" => $singingSince,
                    "Mic" => $mic
                ],
                "showEmpty" => true
            ])
        </div>
    @endslot

    @slot('formModal')
        <div id="singingGearModal" class="modal">
            <div class="flex flex-column bg-white corners-10 shadow">
                <div class="flex flex-row pa-3">
                    <h2 class="subheading">Edit: My Singing Gear</h2>
                </div>

                <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                    {{ method_field($method) }}
                    {{ csrf_field() }}

                    <div class="flex flex-row ph-3 mb-1">
                        <div class="flex flex-column">
                            @include('partials.bladesora.members.inputs.select-input', array_merge([
                                "brand" => $brand ?? "singeo",
                                "inputId" => "singingSince",
                                "inputName" => "singing_since_year",
                                "inputLabel" => "Singing Since",
                                "inputValue" => '',
                                "inputOptions" => array_merge([""],array_reverse(range(1900, date('Y')))),
                                "inputErrors" => [],
                            ], $singingSinceInput ?? []))
                        </div>
                    </div>
                    <div class="flex flex-row ph-3 inline-inputs">
                        <div class="flex flex-column">
                            @include('partials.bladesora.members.inputs.text-input', array_merge([
                                "brand" => $brand ?? "singeo",
                                "type" => "text",
                                "inputId" => "singingMic",
                                "inputName" => "singing_gear_mic_brands",
                                "inputLabel" => "Mic",
                                "inputValue" => "",
                                "inputErrors" => [],
                            ], $micBrandInput ?? []))
                        </div>
                    </div>

                    <div class="flex flex-row ph-3 pb-3">
                        <button class="btn collapse-150 mr-1"
                                type="submit">
                            <span class="bg-{{ $brand }} text-white corners-10 short">
                                Save
                            </span>
                        </button>

                        <a class="btn collapse-150 close-modal corners-10 flat text-black flat short">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    @endslot
@endcomponent
