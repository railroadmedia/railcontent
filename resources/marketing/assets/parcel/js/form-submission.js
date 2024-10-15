document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('form').forEach(form => {
        const formId = form.id;
        const formContainer = form.closest('.form-container');
        const thankYouBox = formContainer ? formContainer.querySelector('.thank-you-box') : null;

      
        const handleCheckboxChange = () => {
            const preferredInstrument = form.querySelector('#preferred_instrument');
            const selectedInstrument = Array.from(form.querySelectorAll('.instrument-checkbox:checked'))
                .map(cb => cb.value)
                .join(', ');

            if (preferredInstrument) {
                preferredInstrument.value = selectedInstrument;
            }
        };

        
        form.querySelectorAll('.instrument-checkbox').forEach(checkbox => {
            const newCheckbox = checkbox.cloneNode(true);
            checkbox.parentNode.replaceChild(newCheckbox, checkbox);
            newCheckbox.addEventListener('change', handleCheckboxChange);
        });

       
        const emailInput = form.querySelector('input[type="email"]');
        if (emailInput) {
            emailInput.addEventListener('input', function() {
                const emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                const emailError = form.querySelector('#email-error');
                if (this.value.match(emailFormat)) {
                    if (emailError) emailError.classList.add('opacity-0');
                    this.classList.remove('bg-red-200', 'border-red');
                } else {
                    if (emailError) emailError.classList.remove('opacity-0');
                    this.classList.add('bg-red-200', 'border-red');
                }
            });
        }

     
        window[`recaptchaSubmit${formId}`] = function(token) {
            const emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            const userEmail = form.querySelector('input[type=email]');
            const submitButton = form.querySelector('.submit');
            const checkboxes = form.querySelectorAll('.instrument-checkbox');
            const tooltip = form.querySelector('#checkbox-tooltip');
            const disclaimer = form.querySelector('.disclaimer');

            let isValid = true;

            if (checkboxes.length > 0 && tooltip) {
                const isCheckboxSelected = Array.from(checkboxes).some(checkbox => checkbox.checked);
                if (!isCheckboxSelected) {
                    tooltip.classList.remove('opacity-0');
                    tooltip.classList.add('opacity-100');
                    setTimeout(() => {
                        tooltip.classList.remove('opacity-100');
                        tooltip.classList.add('opacity-0');
                    }, 3000);
                    isValid = false;
                } else {
                    tooltip.classList.add('opacity-0');
                }
            }

            if (userEmail) {
                const emailError = form.querySelector('#email-error');
                if (!userEmail.value.match(emailFormat)) {
                    userEmail.classList.add('bg-red-200', 'border-red-500');
                    if (emailError) emailError.classList.remove('opacity-0');
                    isValid = false;
                } else {
                    userEmail.classList.remove('bg-red-200', 'border-red-500');
                    if (emailError) emailError.classList.add('opacity-0');
                }
            }

            if (isValid && submitButton) {
                const formData = new FormData(form);
                const preAdd = submitButton.querySelector('.pre-add');
                const pending = submitButton.querySelector('.pending');
                const success = submitButton.querySelector('.success');
                const fail = submitButton.querySelector('.fail');

                if (preAdd) preAdd.classList.add('hidden');
                if (pending) pending.classList.remove('hidden');

                axios.post(form.action, formData)
                    .then(response => {
                        if (response.status === 201) {
                            //console.log('Form submitted', response);
                            form.reset();
                            if (pending) pending.classList.add('hidden');
                            if (success) success.classList.remove('hidden');

                            form.classList.add('hidden');
                            if (thankYouBox) {
                                thankYouBox.classList.remove('invisible', 'max-h-0', 'opacity-0', 'hidden');
                                thankYouBox.classList.add('active');
                            }

                            if (disclaimer) {
                                disclaimer.classList.add('hidden');
                            }

                            const successRedirect = form.querySelector('input[name="success_redirect"]');
                            if (successRedirect && successRedirect.value) {
                                setTimeout(() => {
                                    window.location.href = successRedirect.value;
                                }, 2000);
                            }
                        } else {
                            console.error('Unexpected response status', response.status);
                            if (pending) pending.classList.add('hidden');
                            if (fail) fail.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error submitting form:', error);
                        if (pending) pending.classList.add('hidden');
                        if (fail) fail.classList.remove('hidden');
                    });
            }
        };
    });
});