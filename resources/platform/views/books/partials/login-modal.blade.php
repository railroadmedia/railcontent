<div id="loginModal" class="modal">
    <div class="flex flex-column bg-white corners-3 pa-3">
        <h2 class="subheading mb-3">Login To Pianote</h2>

        <div class="flex flex-row">
            <div class="flex flex-column mb-1">
                <p class="tiny text-black mb-1">
                    To access some of the resources on this page you must be logged in to Pianote.
                </p>

                <form
                    method="POST"
                    action="{{ url()->route(
                        'usora.authenticate.with-credentials',
                        ['redirect' => url()->current()]
                    ) }}"
                >
                    {{ method_field('POST') }}
                    {{ csrf_field() }}

                    <div class="flex flex-column mb-1">
                        @include('bladesora::members.inputs.text-input', [
                            "brand" => "pianote",
                            "type" => "text",
                            "inputId" => "loginEmail",
                            "inputName" => "email",
                            "inputLabel" => "Email Address...",
                            "inputValue" => old('email'),
                            "inputErrors" => $errors->get('log'),
                        ])
                    </div>

                    <div class="flex flex-column mb-1">
                        @include('bladesora::members.inputs.text-input', [
                            "brand" => "pianote",
                            "type" => "password",
                            "inputId" => "loginPassword",
                            "inputName" => "password",
                            "inputLabel" => "Password...",
                            "inputValue" => old('password'),
                            "inputErrors" => $errors->get('pwd'),
                        ])
                    </div>

                    <div class="flex flex-column">
                        <button class="btn big-text" type="submit">
                                <span class="bg-pianote text-white">
                                    Login
                                </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>