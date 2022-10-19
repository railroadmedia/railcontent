{{-- Form Data --}}
@php
  require_once(resource_path('marketing/views/musora/_partials/forms/data/support-options.php'))
@endphp

{{-- Contact Page Email Form --}}
<form class="flex flex-col py-4"
        novalidate="true"
        x-data='contactForm()'
        x-on:submit.prevent='submitForm'
>
    {{-- Name --}}
    @component('_partials.components.forms.text-input',[
        'name' => 'name',
        'required' => true,
        'label' => 'name',
        'id' => 'customer-name',
        'placeholder' => 'Enter your name...',
        'errorMessage' => 'Please enter your name.',
        'darkMode' => true,
    ])@endcomponent

    {{-- Radio Buttons --}}
    @component('_partials.components.forms.radio-buttons',[
        'label' => 'Do you have a membership with us?',
        'name' => 'membership',
        'required' => true,
        'buttonList' => [
            [
                'label' => 'Yes',
                'value' => 'Is currently a member',
            ],
            [
                'label' => 'No',
                'value' => 'Is not a member',
            ]
            ],
        'errorMessage' => 'Please select an option.',
        'selectMessage' => 'If your account is under a different email address than noted below, please provide it in your description.',
        'darkMode' => true,
    ])@endcomponent

    {{-- Email --}}
    @component('_partials.components.forms.email-input',[
        'label' => 'Email Address',
        'name' => 'email',
        'id' => 'support-listbox',
        'placeholder' => 'Enter your email address...',
        'required' => true,
        'darkMode' => true,
    ])@endcomponent

    {{-- Multi Level Dropdown --}}
    @component('_partials.components.forms.multi-level-dropdown',[
        'label' => 'What can we help you with?',
        'name' => 'supportOption',
        'id' => 'support-listbox',
        'placeholder' => 'Please select the option that is closest to your request...',
        'errorMessage' => 'Please select an option that is closest to your request.',
        'listData' => $supportOptions,
        'required' => true,
        'darkMode' => true,
    ])@endcomponent

    <!-- Description -->
    @component('_partials.components.forms.textarea-input',[
        'label' => 'description',
        'name' => 'description',
        'id' => 'support-description',
        'placeholder' => 'Add message here...',
        'rows' => 4,
        'errorMessage' => 'Please enter the details of your request.',
        'required' => true,
        'darkMode' => true,
    ])@endcomponent

    <div class="flex flex-col-reverse sm:flex-row full">
        <div class="my-4 inline-flex mx-auto sm:mx-0 sm:my-0 sm:w-1/2">
            {{-- Recaptcha Form Component --}}
            @component('_partials.components.forms.recaptcha', [
                "siteKey" => "6LfwMZ4dAAAAALEGLsEUwAqrJLLnec_sSbl72Oqx",
                "tokenName" => "recaptchaToken"
            ])
            @endcomponent
        </div>

        <div class="sm:w-72 sm:ml-auto">
            {{-- File Upload Button --}}
            @component('_partials.components.forms.file-input',[
                'label' => 'attach file',
                'name' => 'attachment',
                'id' => 'support-file',
                'accept' => 'video/*,image/*',
                'megabiteLimit' => '100',
                'message' => 'For security reasons, we only accept image and video files.',
                'darkMode' => true,
            ])@endcomponent

        </div>

    </div>

    {{-- SUBMIT BUTTON --}}
    <button class="btn-primary bg-drumeo self-start mr-auto w-full sm:w-min"
            type="submit"
            x-bind:disabled="!formValid || !formVerified"
    >
            Submit
    </button>

    {{-- Response Message --}}
    <div x-cloak class="flex z-150 fixed rounded-lg left-8 p-6 text-base shadow-lg mr-8 transition-all duration-200 ease-in-out"
            :class="[responseMessageVisible ? 'bottom-8': '-bottom-52', formSuccessful ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600']"
    >
        <svg v-if="formSuccessful" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 mr-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
        </svg>
        <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500 mr-4" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
        <div v-if="formSuccessful">
            <p class="font-bold mb-3">Your message was successfully sent!</p>
            <p class="mb-2">Your message has been submitted to the support team and will be reviewed shortly</p>
            <p class="font-bold mb-2 cursor-pointer" x-on:click="responseMessageVisible = false">Dismiss</p>
        </div>
        <div v-else>
            <p class="font-bold mb-3">Your message was not sent</p>
            <p class="mb-2">We could not submit your message to the support team due to a servor error. </p>
            <p class="font-bold mb-2 cursor-pointer" x-on:click="responseMessageVisible = false">Dismiss</p>
        </div>
    </div>
</form>

<script>
    function contactForm(){
        return {
            formData: {
                name: '',
                email: '',
                membership: '',
                description: '',
                supportOption: '',
                attachment: [],
            },
            formValid: true, //update this
            formVerified: true, //update this
            formSuccessful: false, //update this
            responseMessageVisible: false,
            invalids: {
                name: false,
                email: {
                    isInvalid: false,
                    errorMessage: 'Please enter your email address.',
                },
                membership: false,
                description: false,
                supportOption: false,
            },
            hasValidated: false,
            submitForm(){

                if(this.formData.name === ''){
                    this.invalids.name = true;
                }

                if(this.formData.email === ''){
                    this.invalids.email.isInvalid = true;
                }

                if(this.formData.membership === ''){
                    this.invalids.membership = true;
                }

                if(this.formData.description === ''){
                    this.invalids.description = true;
                }

                if(this.formData.supportOption === ''){
                    this.invalids.supportOption = true;
                }

                console.log(this.formData);

                grecaptcha.ready(() => {
                    grecaptcha.execute('6LfwMZ4dAAAAALEGLsEUwAqrJLLnec_sSbl72Oqx', { action: 'post' }).then((token) => {

                        console.log(token);

                    })
                })

                const formDataObj = new FormData();
                formDataObj.append('type', 'support-contact');
                formDataObj.append('subject', 'Contact request');  // append email or name
                formDataObj.append('sender-name', this.formData.name);
                formDataObj.append('sender-address', this.formData.email);
                formDataObj.append('isMember', this.formData.membership);
                formDataObj.append('supportOption', this.formData.supportOption);
                formDataObj.append('message', this.formData.description);
                formDataObj.append('attachment', this.formData.attachment);
                formDataObj.append('logo', "https://dmmior4id2ysr.cloudfront.net/logos/musora-logo.png");
                formDataObj.append('recipient', "support@musora.com");

                axios.post("{{url()->route('mailora.public.send') }}", formDataObj, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then((response) => {
                    if (response) {
                        this.formSuccessful = true;
                        this.responseMessageVisible = true;
                        this.formData.name = '';
                        this.formData.membership = '';
                        this.formData.supportOption = '';
                        this.formData.description = '';
                        this.formData.email = '';
                    }
                })
            }
        }
    }
</script>
