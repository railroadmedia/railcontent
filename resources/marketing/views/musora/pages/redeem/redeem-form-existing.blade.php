<form id="commentform" name="drumeo" method="post" action="{{ URL::route('access-codes.form-claim') }}">
    <input type="hidden" name="credentials_type" value="existing">
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
            <p class="input-describer">Email</p>
            <input class="default-form-field" type="text" id="email" name="user_email" placeholder="Email/Username" value="{{-- Input::old('user_email') --}}">
        </div>
        <div class="columns">
            <p class="input-describer">Password</p>
            <input class="default-form-field" type="password" id="password" name="user_password" placeholder="Password" value="">
        </div>
        <div class="columns">
            <input name="button" type="submit" id="button" class="apply hover:opacity-80" value="Click To Redeem &raquo;"/>
        </div>
    </div>
    {{--<table width="600" border="0" cellspacing="0" cellpadding="0">--}}
    {{--<tr>--}}
    {{--<td width="110" align="left" valign="top">--}}
    {{--<p class="input-describer">CODE</p>--}}
    {{--</td>--}}
    {{--<td width="490" valign="top">--}}
    {{--<input class="code-input" type="text" name="code1" size="5" maxlength="4" placeholder="XXXX"--}}
    {{--value="{{ Input::old('code1') }}">--}}
    {{--<input class="code-input" type="text" name="code2" size="5" maxlength="4" placeholder="XXXX"--}}
    {{--value="{{ Input::old('code2') }}">--}}
    {{--<input class="code-input" type="text" name="code3" size="5" maxlength="4" placeholder="XXXX"--}}
    {{--value="{{ Input::old('code3') }}">--}}
    {{--<input class="code-input" type="text" name="code4" size="5" maxlength="4" placeholder="XXXX"--}}
    {{--value="{{ Input::old('code4') }}">--}}
    {{--<input class="code-input" type="text" name="code5" size="5" maxlength="4" placeholder="XXXX"--}}
    {{--value="{{ Input::old('code5') }}">--}}
    {{--<input class="code-input" type="text" name="code6" size="5" maxlength="4" placeholder="XXXX"--}}
    {{--value="{{ Input::old('code6') }}">--}}
    {{--</td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
    {{--<td width="110" align="left" valign="top">--}}
    {{--<p class="input-describer">EMAIL</p>--}}
    {{--</td>--}}
    {{--<td valign="top">--}}
    {{--<input class="default-form-field" type="text" id="email" name="username" placeholder="Email/Username"--}}
    {{--value="{{ Input::old('username') }}">--}}
    {{--</td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
    {{--<td width="110" align="left" valign="top">--}}
    {{--<p class="input-describer">PASSWORD</p>--}}
    {{--</td>--}}
    {{--<td valign="top">--}}
    {{--<input class="default-form-field" type="password" id="password"--}}
    {{--name="password" placeholder="Password"--}}
    {{--value="">--}}
    {{--</td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
    {{--<td colspan="2">--}}
    {{--<input name="button" type="submit" id="button" class="apply" value="Click To Redeem &raquo;"/>--}}
    {{--</td>--}}
    {{--</tr>--}}
    {{--</table>--}}
</form>
