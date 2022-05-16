@extends('account.settings.layout')

@section('meta')
    <title>Login Credentials | Musora</title>
@endsection

@section('edit-forms')
    <div id="editForm" class="tw-flex tw-flex-col">
        <div class="tw-flex tw-flex-row pa-3 bb-grey-1-1 tw-flex-auto">
            <h1 class="heading">Login Credentials</h1>
        </div>

        <div class="tw-flex tw-flex-row pa-3 tw-flex-auto bt-grey-1-1">
            @include('partials.bladesora.members.account.settings.login-credentials.email-form', [
                'brand' => brand(),
                'otherBrands' => 'Drumeo, Pianote, and Guitareo',
                'action' =>  route('user_management_system.email-change.request'),
                'method' => 'post',
                'emailInput' => [
                    'inputErrors' => $errors->get('email'),
                    'inputValue' => user()->email,
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

        <div class="tw-flex tw-flex-row pa-3 tw-flex-auto bt-grey-1-1 body">
            @include('partials.bladesora.members.account.settings.login-credentials.password-form', [
                'brand' => '{{ $brand }}',
                'otherBrands' => 'Drumeo, Pianote, and Guitareo',
                'action' => route('user_management_system.password.update'),
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
