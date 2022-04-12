@extends('account.settings.layout')

@section('meta')
    <title>Login Credentials | Musora</title>
@endsection

@section('edit-forms')
    <div id="editForm" class="flex flex-column">
        <div class="flex flex-row pa-3 bb-grey-1-1 flex-auto">
            <h1 class="heading">Login Credentials</h1>
        </div>

        <div class="flex flex-row pa-3 flex-auto bt-grey-1-1">
            @include('partials.bladesora.members.account.settings.login-credentials.email-form', [
                'brand' => '{{ $brand }}',
                'otherBrands' => 'Drumeo, Pianote, and Guitareo',
                'action' => '/usora/email-change/request',
                'method' => 'post',
                'emailInput' => [
                    'inputErrors' => $errors->get('email'),
                    'inputValue' => current_user()->getEmail(),
                    'inputName' => 'email',
                ],
                'emailPasswordInput' => [
                    'inputErrors' => $errors->get('current_password'),
                    'inputValue' => '',
                    'inputName' => 'user_password'
                ],
                'showLegacyUserNameMessage' => false
           ])
        </div>

        <div class="flex flex-row pa-3 flex-auto bt-grey-1-1 body">
            @include('partials.bladesora.members.account.settings.login-credentials.password-form', [
                'brand' => '{{ $brand }}',
                'otherBrands' => 'Drumeo, Pianote, and Guitareo',
                'action' => route('usora.user-password.update'),
                'method' => 'patch',
                'currentPasswordInput' => [
                    'inputErrors' => $errors->get('current_password'),
                ],
                'newPasswordInput' => [
                    'inputErrors' => $errors->get('new_password'),
                    'inputName' => 'new_password',
                ],
                'newPasswordConfirmationInput' => [
                    'inputErrors' => $errors->get('new_password_confirmation'),
                    'inputName' => 'new_password_confirmation',
                ],
            ])
        </div>
    </div>
@endsection
