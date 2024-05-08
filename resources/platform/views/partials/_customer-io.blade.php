{{-- Customer.io --}}
<script type="text/javascript">
    var _cio = _cio || [];
    (function() {
        var a,b,c;a=function(f){return function(){_cio.push([f].
        concat(Array.prototype.slice.call(arguments,0)))}};b=["load","identify",
        "sidentify","track","page","on","off"];for(c=0;c<b.length;c++){_cio[b[c]]=a(b[c])};
        var t = document.createElement('script'),
            s = document.getElementsByTagName('script')[0];
        t.async = true;
        t.id    = 'cio-tracker';
        t.setAttribute('data-site-id', "{{ config('customer-io.accounts.musora.site_id') }}" );
        t.setAttribute('data-use-array-params', 'true');
        t.setAttribute('data-use-in-app', 'true');
        t.src = 'https://assets.customer.io/assets/track.js';
        s.parentNode.insertBefore(t, s);
    })();
    _cio.identify({
        id: "{{ user()->email }}",
        created_at: "{{ user()->created_at->timestamp }}",
        email: "{{ user()->email }}",
        first_name: "{{ user()->first_name }}",
        last_name: "{{ user()->last_name }}",
        plan_name: "{{ user()->access_level }}"
    });
</script>
