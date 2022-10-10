<div 
    class="file-field" 
    {{-- x-bind:disabled="disabled" --}}
    x-data="{
        message: '{{$message}}',
    }"
>
    <label 
        for="{{$id}}" 
        class="btn-secondary sm:btn-small {{ $darkMode ? 'text-[#a1afc9]' : 'text-gray-400' }}"
        @if(!empty($required)) aria-required="required" @endif 
        {{-- x-bind:aria-invalid="invalid" --}}
        {{-- x-bind:aria-valid="valid" --}}
    >
        <div class="input-icon">
            {{-- <!-- Normal State --> --}}
            <i class="fal fa-paperclip"></i>
            {{-- <!-- Heroicon name: solid/exclamation-circle --> --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="invalid-icon" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{-- <!-- Heroicon name: solid/checkmark-circle --> --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="valid-icon" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
        </div>
            {{ $label }}
        <input 
            type="file" 
            id="{{$id}}" 
            accept="{{$accept}}"
            x-on:change="
                limit = {{ $megabiteLimit }} * 1000000;
                fileTypes = [
                    'video/mp4',
                    'video/x-m4v',
                    'video/quicktime',
                    'image/apng', 
                    'image/bmp', 
                    'image/gif', 
                    'image/jpeg', 
                    'image/pjpeg', 
                    'image/png', 
                    'image/svg+xml', 
                    'image/tiff', 
                    'image/webp', 
                    'image/x-icon', 
                ];

                if(!fileTypes.includes($event.target.files[0].type)){
                    message = 'For security reasons, we only accept image and video files.'
                    return;
                }
                else if($event.target.files[0].size > limit){
                    message = 'Your file size exceeds {{ $megabiteLimit }}mb.';
                    return;
                }
                else {
                    message = '';
                    formData.{{$name}}.push($event.target.files[0]);
                }

            "
        >
    </label>
    {{-- <!-- Message --> --}}
    <div class="input-messages">
        <p class="primary-message {{ $darkMode ? 'text-white' : 'text-[#00101D]' }}" x-text="message"></p>
        <p 
            x-bind:class="message === '' && 'hidden'"
            class="secondary-message">
            Max File Size {{ $megabiteLimit }}MB
        </p>
    </div>
    {{-- <!-- Uploadedd Files --> --}}
    <div x-bind:class="formData.{{$name}}.length === 0 && 'hidden'">
        <template x-for="file in formData.{{$name}}">
            <div class="bg-green-50 p-2 inline-flex items-center font-bold text-xs w-full mb-2">
                <span class="truncate" x-text="file.name"></span> 
                <span class="ml-1 text-gray-500 mr-auto whitespace-nowrap" x-text="
                    bytes = file.size.toString().replace(/[^0-9.]/g, '')
                    sizes = ['B', 'KB', 'MB', 'GB', 'TB']
                    bytes = parseInt(bytes)
                    if(bytes <= 0 || isNaN(bytes)) return '0 B'
                    i = Math.floor(Math.log(bytes) / Math.log(1024))
                    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i]
                ">
                </span>
                {{-- <!-- Remove File --> --}}
                <div class="ml-4 inline-flex"
                    x-on:click="
                        formData.{{$name}} = [];
                        message = '{{$message}}'
                    ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-500 h-4 w-4 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </template>
    </div>
</div>



{{-- 

<script>
export default {
    name: 'FileInput',
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
        files: {
            type: Array,
            required: true
        },
        megabiteLimit: {
            type: Number,
            required: true
        },
        accept: {
            type: String,
            default: 'image/*'
        },
        required: {
            type: Boolean,
            default: false
        },
        multiple: {
            type: Boolean,
            default: false
        },
        message: {
            type: String,
            default: ''
        },
        disabled: {
            type: Boolean,
            default: false
        }
    },

    // data
    data() {
        return {
            valid: false,
            invalid: false,
            selectedFile: '',
            formState: 0,
            fileInvalid: false,
        }
    },

    // methods
    methods: {
        checkUploadedFile(e) {
            const limit = (this.megabiteLimit * 1000000); //100mb == 100000000 bytes
            const fileTypes = [
                "video/mp4",
                "video/x-m4v",
                "video/quicktime",
                "image/apng", 
                "image/bmp", 
                "image/gif", 
                "image/jpeg", 
                "image/pjpeg", 
                "image/png", 
                "image/svg+xml", 
                "image/tiff", 
                "image/webp", 
                "image/x-icon", 
            ];


            if (!fileTypes.includes(e.target.files[0].type) || e.target.files[0].size > limit ) {
                this.invalidate()
                if(!fileTypes.includes(e.target.files[0].type) ) {
                    this.formState = 0;
                } else {
                    this.formState = 1;
                }
                if(!this.multiple) this.$emit('clearFiles')
                return;
            } else {
                this.validate()
                this.formState = 2; 
                if(!this.multiple) this.$emit('clearFiles')
                this.$emit('attachFile', e.target.files[0]);
            }
        },

        formatBytes(bytes) {
            bytes = bytes.toString().replace(/[^0-9.]/g, '');
            var sizes = ["B", "KB", "MB", "GB", "TB"];
            bytes = parseInt(bytes);
            if (bytes <= 0 || isNaN(bytes)) return "0 B";
            var i = Math.floor(Math.log(bytes) / Math.log(1024));
            return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
        },

        validate() {
            this.invalid = false;
            this.valid = true;
        },
        invalidate() {
            this.invalid = true;
            this.valid = false;
        },

        removeFile(index) {
            this.$emit('removeFile', index);
        },
    },

    // computed
    computed: {
        messageController() {
            //not uploaded
            if(this.formState === 0) return this.message;
            //too large
            if(this.formState === 1) return 'Your file size exceeds 100mb.';
            //uploaded
            if(this.formState === 2) return ''
        },
    },

    // lifecycle hooks
    watch: {
        files: function(Arr){
            if(Arr.length === 0 && !this.invalid) {
                this.valid = false;
                this.formState = 0;
            } 
        }
    }
}
</script> --}}
