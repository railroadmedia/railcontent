<div class="input-field">
    <label for="{{$id}}" class="label text-[#00101D] dark:text-white">
        <span class="text-red-500 @if(empty($required)) hidden @endif">*</span>
        {{ $label }}
    </label>
    <div class="input-wrapper">
        <textarea 
            type="text" 
            id="{{$id}}"
            rows="{{$rows}}"
            name="{{$name}}" 
            placeholder="{{$placeholder}}"
            class="font-primary "
            x-bind:class="invalids.{{$name}} ? 'border-[#EF4444] bg-[#FEF2F2]' : 'focus:border-drumeo dark:bg-[#00101D] dark:text-white dark:placeholder:text-[#9EC0DC] dark:border-[#445F74]'"
            @if(!empty($required)) required @endif 
            x-on:input.change="
                if(invalids.{{$name}}) invalids.{{$name}} = false;
                if(hasValidated && !$event.target.value) invalids.{{$name}} = true;
            "
            x-model="formData.{{$name}}"
        ></textarea>
        <span class="input-icon">
            <!-- Invalid Icon -->
            <svg 
                xmlns="http://www.w3.org/2000/svg" 
                class="invalid-icon" 
                x-bind:class="invalids.{{$name}} && 'block text-[#EF4444]'"
                viewBox="0 0 20 20" 
                fill="currentColor" 
                aria-hidden="true"
            >
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
        </span>

        <!-- Error Message -->
        <p class="input-message text-[#EF4444]" x-bind:class="invalids.{{$name}} ? 'block' : 'hidden'">
            {{ $errorMessage }}
        </p>
    </div> 
</div>





{{-- 
<script>
    export default {
    name: 'TextareaInput',
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
        resize: {
            type: Boolean,
            default: true
        },
        disabled: {
            type: Boolean,
            default: false
        },
        rows: {
            type: Number,
            default: 4
        },
        placeholder: {
            type: String,
            default: ''
        },
    },

    // data
    data() {
        return {
            errorMessage: 'Please enter the details of your request.'
        }
    },

    // methods
    methods: {
        validateInput: function(input) {
            if (!input.length) {
                this.errorMessage = "Please enter the details of your request."
                this.$emit('update:messageFieldValid', false)
            } else {
                this.errorMessage = '';
                this.$emit('update:messageFieldValid', true)
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

    watch: {
        inputValue: function(val) {
            this.validateInput(val);
        },
        invalid: function() {
           this.validateInput(this.inputValue); 
        }
    }
    // lifecycle hooks
}
</script> --}}
