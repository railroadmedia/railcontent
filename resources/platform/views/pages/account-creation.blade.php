@extends('partials.login-layout')

@section('meta')
    <title>Create Your Account | Musora</title>
@endsection

@section('content')
    <reset-pass-form
        :errors="{{ json_encode($errors->all()) }}"
        :usecsrftoken="!!({{ $useCsrfToken ?? true }})"
        :email="{{ json_encode($email) }}"
        :token="{{ json_encode($verificationToken) }}"
        :event-tracking-origin="{{ json_encode($eventTrackingOrigin) }}"
        :submiturl="{{ json_encode(url()->route('user_management_system.create-account-submit')) }}"
        form-type="create"
    >
        <template #csrf>{{ csrf_field() }}</template>
    </reset-pass-form>
@endsection
