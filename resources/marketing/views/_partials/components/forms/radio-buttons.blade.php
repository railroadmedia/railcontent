<fieldset class="fieldset border-none">
    <p class="fieldset-title">
        <span v-if="required" class="text-red-500">*</span>
        {{ $label }}
    </p>
    <div class="radio-group">
        @foreach ($buttonList as $key => $button)
            <div class="radio-field">
                <input 
                    type="radio" 
                    id="radio-{{$name}}-{{$key}}" 
                    name="{{$name}}" 
                    value="{{$button['value']}}"
                    x-model="formData.{{$name}}"
                    x-on:input.change="if(invalids.{{$name}}) invalids.{{$name}} = false;"
                >
                <label for="radio-{{$name}}-{{$key}}">
                    {{ $button['label'] }}
                </label>
            </div>
        @endforeach
        
    </div>
    <p class="input-message text-[#EF4444]" x-bind:class="invalids.{{$name}} ? 'block' : 'hidden'">
        {{ $errorMessage }}
    </p>
    <p 
        class="text-sm italic text-blue-500" 
        x-bind:class="(formData.{{$name}} === 'Is not a member' || formData.{{$name}} === '') && 'hidden'"
    >
        {{$selectMessage}}
    </p>
</fieldset>


{{-- 


<script>
export default {
    name: 'RadioButtons',
    //props
    props: {
        name: {
            type: String,
            required: true
        },
        groupName: {
            type: String,
            required: true
        },
        inputValue: {
            type: String,
            default: ''
        },
        required: {
            type: Boolean,
            default: false
        },
        invalid: {
            type: [Boolean, null],
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        },
        showSelectMessage: {
            type: Boolean,
            default: false,
        },
        errorMessage: {
            type: String,
            default: ''
        },
        selectMessage: {
            type: String,
            default: ''
        },
        buttonsList: {
            type: Array,
            required: true
        }
    },

    // data
    data() {
        return {
            selectedRadioButton: '',
        }
    },

    // methods
    methods: {

    },

    // computed
    computed: {
        //Value Interface
        valueInterface: {
            get() { return this.inputValue }, 
            set(val) { this.$emit('update:inputValue', val) }
        },
    },

    watch: {
        selectedRadioButton: function(val) {
            this.$emit('updateValue', val);
            this.$emit('update:radioFieldsValid', true);
        },
    }

    // lifecycle hooks
}
</script> --}}
