<template>
    <fieldset class="fieldset border-none" 
              :aria-required="required"
              :aria-invalid="invalid" 
              :disabled="disabled"
    >
        <p class="fieldset-title text-[#00101D] dark:text-white">
            <span v-if="required" class="text-red-500">*</span>
            {{ name }}
        </p>
        <div class="radio-group">
            <div v-for="(button,i) in buttonsList" 
                :key="i"
                class="radio-field"
            >
                <input type="radio" 
                      :id="'radio-'+groupName+'-'+i" 
                      :name="groupName" 
                      :value="button.value"
                      v-model="selectedRadioButton">
                <label :for="'radio-'+groupName+'-'+i" class="text-[#00101D] dark:text-white">{{ button.label }}</label>
            </div>
        </div>
        <p class="input-message" id="">
           {{ errorMessage }}
        </p>
        <p class="text-sm italic text-blue-50 dark:text-[#9EC0DC]" v-show="showSelectMessage">{{ selectMessage }}</p>
    </fieldset>
</template>

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
