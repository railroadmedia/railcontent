<form id="commentform" name="drumeo" method="post"
    @if(empty($existing)) action="{{ get_musora_brand_base_url() }}/ecommerce/access-codes/redeem" @else action="{{ URL::route('access-codes.form-claim') }}" @endif
>
    @if(empty($existing))
        <input type="hidden" name="credentials_type" value="new">
    @else
        <input type="hidden" name="credentials_type" value="existing">
        <input type="hidden" name="redirect" value="/members">
    @endif
    <div class="flex flex-wrap">
        <p class="w-full input-describer">Code</p>
        <div class="w-1/6 px-1">
            <input class="code-input" type="text" name="code1" size="5" maxlength="4" placeholder="XXXX" value="{{-- Input::old('code1') --}}">
        </div>
        <div class="w-1/6 px-1">
            <input class="code-input" type="text" name="code2" size="5" maxlength="4" placeholder="XXXX" value="{{-- Input::old('code2') --}}">
        </div>
        <div class="w-1/6 px-1">
            <input class="code-input" type="text" name="code3" size="5" maxlength="4" placeholder="XXXX" value="{{-- Input::old('code3') --}}">
        </div>
        <div class="w-1/6 px-1">
            <input class="code-input" type="text" name="code4" size="5" maxlength="4" placeholder="XXXX" value="{{-- Input::old('code4') --}}">
        </div>
        <div class="w-1/6 px-1">
            <input class="code-input" type="text" name="code5" size="5" maxlength="4" placeholder="XXXX" value="{{-- Input::old('code5') --}}">
        </div>
        <div class="w-1/6 px-1">
            <input class="code-input" type="text" name="code6" size="5" maxlength="4" placeholder="XXXX" value="{{-- Input::old('code6') --}}">
        </div>
    </div>
    @if(empty($existing))
        <p class="input-describer">Email Address</p>
        <input class="default-form-field" type="text" id="email" name="email" placeholder="Email Address" value="{{-- Input::old('email') --}}">
        <p class="input-describer">Password (min. 8 characters)</p>
        <input class="default-form-field" type="password" id="password" name="password" placeholder="Password (min. 8 characters)" value="">
        <p class="input-describer">Confirm Password</p>
        <input class="default-form-field" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" value="">
        <input name="button" type="submit" id="button" class="apply hover:opacity-80" value="Get Started"/>
    @else
        <p class="input-describer">Email</p>
        <input class="default-form-field" type="text" id="email" name="user_email" placeholder="Email/Username" value="{{-- Input::old('user_email') --}}">
        <p class="input-describer">Password</p>
        <input class="default-form-field" type="password" id="password" name="user_password" placeholder="Password" value="">
        <input name="button" type="submit" id="button" class="apply hover:opacity-80" value="Click To Redeem &raquo;"/>
    @endif
</form>
