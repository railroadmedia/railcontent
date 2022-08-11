<div class="input-field"
        x-bind:disabled="disabled"
>
    <label x-bind:for="id" class="label text-[#00101D] dark:text-white">
        <span x-if="required" class="text-red-500">*</span>
        {{ name }}
    </label>
    <div class="input-wrapper">
        <input  type="email" 
                x-bind:id="id"
                x-bind:placeholder="placeholder"
                class="focus:border-drumeo dark:bg-[#00101D] dark:text-white dark:placeholder:text-[#9EC0DC] dark:border-[#445F74]"
                x-bind:aria-required="required"
                x-bind:aria-invalid="invalid"
                x-model="valueInterface"
                aria-describedby=""
        >
        <div class="input-icon">
            <!-- Heroicon name: solid/exclamation-circle -->
            <svg xmlns="http://www.w3.org/2000/svg" class="invalid-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
        </div>
        <p class="input-message" id="">{{ errorMessage }}</p>
    </div>
</div>





<script>
export default {
    name: 'EmailInput',
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
        },
    },

    // data
    data() {
        return {
            errorMessage: ''
        }
    },

    // methods
    methods: {
        validateEmail: function(email) {
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (email.length === 0) {
                this.errorMessage = "Please enter your email address."
                this.$emit('update:emailFieldValid', false)
            } else if(!re.test(email)) {
                this.errorMessage = "Please enter a valid email."
                this.$emit('update:emailFieldValid', false)
            } else {
                // console.log('nothing')
                this.errorMessage = '';
                this.$emit('update:emailFieldValid', true)
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
            this.validateEmail(val);
        },
        invalid: function() {
           this.validateEmail(this.inputValue); 
        }
    },
}
</script>
