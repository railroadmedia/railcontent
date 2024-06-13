<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('redeemForm', () => ({
            errors: {
                access_code: '',
                email: '',
                password: '',
                passwordCheck: '',
            },
            loading: false,
            isValid: true,
            submitted: false,

            async submitRedeem(event) {
                this.errors = {
                    access_code: '',
                    email: '',
                    password: '',
                    passwordCheck: '',
                }
                this.isValid = true;
                this.loading = true;
                this.submitted = false;

                const form = event.target;

                //validation
                let access_code = form.access_code.value;
                access_code = access_code.replaceAll(' ', '');
                if (!access_code || access_code.length < 24) {
                    this.errors.access_code = 'Code is not valid.';
                }

                const email = form.email.value;
                const emailFormat = /^\w+([\.-^+]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                if (!email.match(emailFormat)) {
                    this.errors.email = 'Email is not a valid email address.';
                }

                const password = form.password.value;
                if (password.length < 8) {
                    this.errors.password = 'Password must be at least 8 characters long.';
                }

            @if (empty($existingMember) || !$existingMember)
                    const passwordCheck = form.password_confirmation.value;
                if (!passwordCheck) {
                    this.errors.passwordCheck = 'Password must be confirmed.';
                } else if (password !== passwordCheck) {
                    this.errors.passwordCheck = 'Passwords do not match.';
                }
            @endif

                Object.keys(this.errors).forEach(key => {
                    if (this.errors[key]) {
                        this.loading = false;
                        this.isValid = false;
                    }
                })

                if (this.isValid) {
                    const data = new FormData(form);

                    const response = await fetch('{{ $api }}', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            ...Object.fromEntries(data)
                        })
                    })
                    const result = await response.json();
                    this.loading = false;

                    if(result.errors){
                        this.isValid = false;
                        Object.keys(result.errors).forEach(key => {
                            this.errors[key] = result.errors[key][0];
                        })
                    } else {
                        this.submitted = true;
                        window.location.replace('/login')
                    }
                }
            }
        }))
    })
</script>
