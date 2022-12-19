<form id="commentform" name="drumeo" method="post" action="{{ URL::route('access-codes.form-claim') }}">
    <input type="hidden" name="credentials_type" value="new">
    <input type="hidden" name="redirect" value="/members">
    <input type="hidden" name="_token" class="sort-input" value="{{ csrf_token() }}" />
    <div class="row">
        <div class="columns">
            <p class="input-describer">Code</p>
            <div class="columns small-2" style="padding:0;">
                <input class="code-input" type="text" name="code1" size="5" maxlength="4" placeholder="XXXX" value="">
            </div>
            <div class="columns small-2" style="padding:0;">
                <input class="code-input" type="text" name="code2" size="5" maxlength="4" placeholder="XXXX" value="">
            </div>
            <div class="columns small-2" style="padding:0;">
                <input class="code-input" type="text" name="code3" size="5" maxlength="4" placeholder="XXXX" value="">
            </div>
            <div class="columns small-2" style="padding:0;">
                <input class="code-input" type="text" name="code4" size="5" maxlength="4" placeholder="XXXX" value="">
            </div>
            <div class="columns small-2" style="padding:0;">
                <input class="code-input" type="text" name="code5" size="5" maxlength="4" placeholder="XXXX" value="">
            </div>
            <div class="columns small-2" style="padding:0;">
                <input class="code-input" type="text" name="code6" size="5" maxlength="4" placeholder="XXXX" value="">
            </div>
        </div>
        <div class="columns">
            <p class="input-describer">Email</p>
            <input class="default-form-field" type="text" id="email" name="email" placeholder="Email" value="">
        </div>
        <div class="columns">
            <p class="input-describer">Password</p>
            <input class="default-form-field" type="password" id="password" name="password" placeholder="Password" value="">
        </div>
        <div class="columns">
            <p class="input-describer">Confirm</p>
            <input class="default-form-field" type="password" id="password_confirmation" name="password_confirmation" placeholder="Password Confirm" value="">
        </div>
        <div class="columns">
            <input name="button" type="submit" id="button" class="apply" value="Click To Redeem &raquo;"/>
        </div>
    </div>
</form>
