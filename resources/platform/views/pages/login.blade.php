@extends('_partials.layout.public-layout')

@section('head-includes')
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
@stop

<!-- Main -->
@section('layout-body')
    
<main class="absolute top-0 left-0 bg-center bg-cover h-full w-full flex items-center justify-center" 
         style="background-color:#1a1e58;background-image:url(https://musora-center.s3.amazonaws.com/homepage/2021/header.jpg);">


    <form class="p-8 w-full max-w-md mx-auto my-5 bg-white rounded-lg bg-gray-100 drop-shadow-xl">
        <img class="w-48 block mb-10 mx-auto opacity-80" src="https://musora-ui.s3.amazonaws.com/logos/musora-black.svg" title="Guitareo Logo">
        <!-- email -->
        <div class="input-field">
            <label for="email3" class="label">Email</label>
            <div class="input-wrapper">
                <input  type="email" 
                        required
                        name="email" 
                        id="email3" 
                        class="focus:border-drumeo placeholder-gray-400"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                        title="You have entered an invalid email address."
                        placeholder="Email Address">
                <div class="input-icon">
                    <!-- Heroicon name: solid/exclamation-circle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 invalid-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="input-message" id="email-error">Your password must be less than 4 characters.</p>
            </div>
        </div>
        <!-- password -->
        <div class="input-field">
            <label for="password2" class="label">Password</label>
            <div class="input-wrapper">
                <input  type="password" 
                        required
                        name="password" 
                        id="password2" 
                        class="focus:border-drumeo placeholder-gray-400"
                        placeholder="Password"
                        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                <div class="input-icon">
                    <!-- Heroicon name: solid/exclamation-circle -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 invalid-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="input-message" id="password-error">Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters.</p>
            </div>
        </div>
        <!-- password -->
        <button class="btn-primary bg-musora border-0 w-full mb-6" type="submit">Sign up</button>
        <div class="text-center">
            <a href="/" class="text-sm text-gray-400  hover:text-drumeo">Forgot your password?</a>
        </div>
    </form>
</main>


@stop
