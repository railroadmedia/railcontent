@extends('partials.login-layout')

@section('meta')
    <title>Reset Password | Musora</title>
@endsection

@section('content')
    <reset-pass-form
        :errors="{{json_encode($errors->all())}}"
        :usecsrftoken="!!({{$useCsrfToken ?? true}})"
        :email="{{ json_encode($email) }}"
        :token="{{ json_encode($token) }}"
        :submiturl="{{ json_encode(url()->route('user_management_system.password.reset-password-with-token')) }}"
        formType="reset"
    >
        <template #csrf>{{ csrf_field() }}</template>
    </reset-pass-form>
@endsection
