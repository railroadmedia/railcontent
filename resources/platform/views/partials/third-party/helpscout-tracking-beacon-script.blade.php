{{-- Helpscout Script --}}
<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
<script type="text/javascript">
    window.Beacon('init', '{{ config('railhelpscout.helpscout_tracking_beacon_id') }}');

    //Handle Beacon Color
    let brand = "{{ $brand }}";
    const brandColor = ()=> {
        if( brand === 'drumeo' ) return '#0B76DB';
        if( brand === 'pianote' ) return '#F61A30';
        if( brand === 'guitareo' ) return '#00C9AC';
        if( brand === 'singeo' ) return '#8300E9';
    }

    Beacon('config', {
        color: brandColor(),
    })

    @if(!empty($email))
        window.Beacon('identify', {email: '{{ $email }}',});
    @endif

    //Style Beacon Button
    Beacon('on', 'ready', () => {
        document.querySelector('.BeaconFabButtonFrame').style.bottom = "50px";
    });
</script>