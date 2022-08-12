<fieldset class="fieldset border-none" 
            x-bind:aria-required="required"
            x-bind:aria-invalid="invalid" 
            x-bind:disabled="disabled"
>
    <p class="fieldset-title">
        <span v-if="required" class="text-red-500">*</span>
        {{ name }}
    </p>
    <div class="radio-group">
        <div x-for="(button,i) in buttonsList" 
                x-bind:key="i"
            class="radio-field"
        >
            <input type="radio" 
                    x-bind:id="'radio-'+groupName+'-'+i" 
                    x-bind:name="groupName" 
                    x-bind:value="button.value"
                    x-model="selectedRadioButton">
            <label x-bind:for="'radio-'+groupName+'-'+i">{{ button.label }}</label>
        </div>
    </div>
    <p class="input-message" id="">
        {{ errorMessage }}
    </p>
    <p class="text-sm italic text-blue-500" x-show="showSelectMessage">{{ selectMessage }}</p>
</fieldset>





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
</script>
