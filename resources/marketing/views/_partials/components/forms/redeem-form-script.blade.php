<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('redeemForm', () => ({
            errors: {
                code: '',
                email: '',
                password: '',
                passwordCheck: '',
            },

            async submitRedeem(event) {
                this.errors = {
                    code: '',
                    email: '',
                    password: '',
                    passwordCheck: '',
                }
                let isValid = true;

                const form = event.target;

                // console.log(Object.fromEntries(data))

                //validation
                const access_code = form.access_code.value;
                if (!access_code.replaceAll(' ', '') || access_code.length < 24) {
                    this.errors.code = 'Code is not valid.';
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
                        isValid = false;
                    }
                })

                if (isValid) {
                    const data = new FormData(form);

                    fetch('{{ $api }}', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            ...Object.fromEntries(data)
                        })
                    }).then(async res => {
                        const body = await res.json();
                        console.log({body})
                    }).catch(error => {
                        console.log(error)
                    })

                    // form.submit();
                }
            }
        }))
    })
</script>
