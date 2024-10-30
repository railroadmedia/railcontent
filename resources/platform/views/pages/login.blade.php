@extends('partials.login-layout')

@section('meta')
    <title>Login | Musora</title>
@endsection

@section('content')
    <login
    redirect-url="{{ $redirect }}"
    reseturl="{{ url()->route('user_management_system.password.send-reset-email', (!empty($redirect) ? ['redirect_to' => $redirect] : [])) }}"
    :errors="{{json_encode($errors->all())}}"
    hassessionstatus="{{session()->has('status')}}"
    sessionstatus="{{ session()->get('status') }}"
    :usecsrftoken="!!({{$useCsrfToken ?? true}})"
    order-now-url="{{ url('/#orderNow') }}"
    >
        <template v-slot:csrf>{{ csrf_field() }}</template>
    </login>
@endsection
