<form
    id="commentform" name="drumeo" method="post"
    x-data="redeemForm"
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
        <input class="default-form-field" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black mb-1.5': errors.code }" type="text" name="access_code" maxlength="24" placeholder="XXXXXXXXXXXXXXXXXXXXXXXX" value="" />
        <span class="text-xs text-[#EF4444]" x-show="errors.code" x-text="errors.code"></span>
    </div>
    @if(empty($existing))
        <p class="input-describer">Email Address</p>
        <input class="default-form-field" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black': errors.email }" type="text" id="email" name="email" placeholder="Email Address" value="{{-- Input::old('email') --}}">
        <span class="text-xs text-[#EF4444]" x-show="errors.email" x-text="errors.email"></span>
        <p class="input-describer">Password (min. 8 characters)</p>
        <input class="default-form-field" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black': errors.password }" type="password" id="password" name="password" placeholder="Password (min. 8 characters)" value="">
        <span class="text-xs text-[#EF4444]" x-show="errors.password" x-text="errors.password"></span>
        <p class="input-describer">Confirm Password</p>
        <input class="default-form-field" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black': errors.passwordCheck }" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" value="">
        <span class="text-xs text-[#EF4444]" x-show="errors.passwordCheck" x-text="errors.passwordCheck"></span>
        <input name="button" type="submit" id="button" class="apply hover:opacity-80" @click.prevent="submitRedeem" value="Get Started"/>
    @else
        <p class="input-describer">Email</p>
        <input class="default-form-field" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black': errors.email }" type="text" id="email" name="user_email" placeholder="Email/Username" value="{{-- Input::old('user_email') --}}">
        <span class="text-xs text-[#EF4444]" x-show="errors.email" x-text="errors.email"></span>
        <p class="input-describer">Password</p>
        <input class="default-form-field" x-bind:class="{ 'border border-[#EF4444] bg-[#FECACA] text-black': errors.password }" type="password" id="password" name="user_password" placeholder="Password" value="">
        <span class="text-xs text-[#EF4444]" x-show="errors.password" x-text="errors.password"></span>
        <input name="button" type="submit" id="button" class="apply hover:opacity-80" @click.prevent="submitRedeem" value="Click To Redeem &raquo;"/>
    @endif
</form>
