<div 
    class="input-field"
    x-bind:disabled="disabled"
>
    <label for="{{ $id }}" class="label text-[#00101D] dark:text-white">
        <span class="text-red-500 @if(empty($required)) hidden @endif">*</span>
        {{ $name }}
    </label>
    <div class="input-wrapper">
        <input  
            type="text" 
            id="{{ $id }}"
            placeholder="{{ $placeholder }}"
            class="focus:border-drumeo dark:bg-[#00101D] dark:text-white dark:placeholder:text-[#9EC0DC] dark:border-[#445F74]"
            @if(!empty($required)) aria-required="required" @endif 
            x-bind:aria-invalid="invalid"
            x-model="formData.{{$name}}"
            aria-describedby=""
        >
        <div class="input-icon">
            <!-- Heroicon name: solid/exclamation-circle -->
            <svg xmlns="http://www.w3.org/2000/svg" class="invalid-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
        </div>
        {{-- <p class="input-message" id="">
            {{ errorMessage }}
        </p> --}}
    </div>
</div>





<script>
export default {
    name: 'TextInput',
    //props
    props: {
        id: {
            type: String,
            required: true
        },
        name: {
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
            type: Boolean,
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        },
        placeholder: {
            type: String,
            default: ''
        }
    },

    // data
    data() {
        return {
            errorMessage: 'Please enter your name.',
        }
    },

    // methods
    methods: {
        validateInput: function(input) {
            if (!input.length) {
                this.errorMessage = "Please enter your name."
                this.$emit('update:textFieldValid', false)
            } else {
                this.errorMessage = '';
                this.$emit('update:textFieldValid', true)
            }
        }
    },

    // computed
    computed: {
        //Value Interface
        valueInterface: {
            get() { return this.inputValue }, 
            set(val) { this.$emit('update:inputValue', val) }
        }
    },

    // lifecycle hooks
    watch: {
        inputValue: function(val) {
            this.validateInput(val);
        },
        invalid: function() {
           this.validateInput(this.inputValue); 
        }
    },

    // lifecycle hooks
}
</script>
