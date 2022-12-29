<form id="commentform" name="drumeo" method="post" action="{{ get_musora_brand_base_url() }}/ecommerce/access-codes/redeem">
    <input type="hidden" name="credentials_type" value="new">
    <input type="hidden" name="redirect" value="/members">
    <div class="row">
        <div class="columns">
            <p class="input-describer">Code</p>
            <div class="columns small-2" style="padding:0;">
                <input class="code-input" type="text" name="code1" size="5" maxlength="4" placeholder="XXXX" value="{{-- Input::old('code1') --}}">
            </div>
            <div class="columns small-2" style="padding:0;">
                <input class="code-input" type="text" name="code2" size="5" maxlength="4" placeholder="XXXX" value="{{-- Input::old('code2') --}}">
            </div>
            <div class="columns small-2" style="padding:0;">
                <input class="code-input" type="text" name="code3" size="5" maxlength="4" placeholder="XXXX" value="{{-- Input::old('code3') --}}">
            </div>
            <div class="columns small-2" style="padding:0;">
                <input class="code-input" type="text" name="code4" size="5" maxlength="4" placeholder="XXXX" value="{{-- Input::old('code4') --}}">
            </div>
            <div class="columns small-2" style="padding:0;">
                <input class="code-input" type="text" name="code5" size="5" maxlength="4" placeholder="XXXX" value="{{-- Input::old('code5') --}}">
            </div>
            <div class="columns small-2" style="padding:0;">
                <input class="code-input" type="text" name="code6" size="5" maxlength="4" placeholder="XXXX" value="{{-- Input::old('code6') --}}">
            </div>
        </div>
        <div class="columns">
            <p class="input-describer">Email Address</p>
            <input class="default-form-field" type="text" id="email" name="email" placeholder="Email Address" value="{{-- Input::old('email') --}}">
        </div>
        <div class="columns">
            <p class="input-describer">Password (min. 8 characters)</p>
            <input class="default-form-field" type="password" id="password" name="password" placeholder="Password (min. 8 characters)" value="">
        </div>
        <div class="columns">
            <p class="input-describer">Confirm Password</p>
            <input class="default-form-field" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" value="">
        </div>
        <div class="columns">
            <input name="button" type="submit" id="button" class="apply hover:opacity-80" value="Get Started"/>
        </div>
    </div>
</form>
