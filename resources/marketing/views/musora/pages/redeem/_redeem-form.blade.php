<form
    id="commentform" name="drumeo" method="post"
    x-data="redeemForm"
    @submit.prevent="submitRedeem($event)"
    @if(empty($existing)) action="{{ get_musora_brand_base_url() }}/ecommerce/access-codes/redeem" @else action="{{ URL::route('access-codes.form-claim') }}" @endif
>
    @php
        if (empty($accessCodeArray)) {
            $accessCodeArray = null;
        }
    @endphp
    @if(empty($existing))
        <input type="hidden" name="credentials_type" value="new">
    @else
        <input type="hidden" name="credentials_type" value="existing">
        <input type="hidden" name="redirect" value="/members">
    @endif
    <div class="flex flex-wrap">
        <p class="w-full input-describer">Code</p>
        <input class="default-form-field text-center uppercase" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black mb-1.5': errors.access_code }" type="text" name="access_code" maxlength="29" placeholder="XXXX - XXXX - XXXX - XXXX - XXXX - XXXX" x-mask="**** **** **** **** **** ****" @if($accessCodeArray) value="{{$accessCodeArray[0]}} {{$accessCodeArray[1]}} {{$accessCodeArray[2]}} {{$accessCodeArray[3]}} {{$accessCodeArray[4]}} {{$accessCodeArray[5]}}" @else value="" @endif x-bind:disabled="loading" />
        <span class="text-xs text-[#EF4444]" x-show="errors.access_code" x-text="errors.access_code"></span>
    </div>
    @if(empty($existing))
        <p class="input-describer">Email Address</p>
        <input class="default-form-field" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black': errors.email }" type="text" id="email" name="email" placeholder="Email Address" value="{{-- Input::old('email') --}}" x-bind:disabled="loading">
        <span class="text-xs text-[#EF4444]" x-show="errors.email" x-text="errors.email"></span>
        <p class="input-describer">Password (min. 8 characters)</p>
        <input class="default-form-field" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black': errors.password }" type="password" id="password" name="password" placeholder="Password (min. 8 characters)" value="" x-bind:disabled="loading">
        <span class="text-xs text-[#EF4444]" x-show="errors.password" x-text="errors.password"></span>
        <p class="input-describer">Confirm Password</p>
        <input class="default-form-field" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black': errors.passwordCheck }" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" value="" x-bind:disabled="loading">
        <span class="text-xs text-[#EF4444]" x-show="errors.passwordCheck" x-text="errors.passwordCheck"></span>
        @include('_partials.components.forms.redeem-form-buttons', [
            'buttonText' => $buttonText,
            'buttonColor' => $buttonColor,
        ])
    @else
        <p class="input-describer">Email</p>
        <input class="default-form-field" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black': errors.email }" type="text" id="email" name="email" placeholder="Email/Username" value="{{-- Input::old('user_email') --}}" x-bind:disabled="loading">
        <span class="text-xs text-[#EF4444]" x-show="errors.email" x-text="errors.email"></span>
        <p class="input-describer">Password</p>
        <input class="default-form-field" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black': errors.password }" type="password" id="password" name="password" placeholder="Password" value="" x-bind:disabled="loading">
        <span class="text-xs text-[#EF4444]" x-show="errors.password" x-text="errors.password"></span>
        @include('_partials.components.forms.redeem-form-buttons', [
            'buttonText' => $buttonText,
            'buttonColor' => $buttonColor,
        ])
    @endif
</form>
