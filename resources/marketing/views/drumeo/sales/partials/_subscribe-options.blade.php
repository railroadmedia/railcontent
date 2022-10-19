<div id="customize-anchor" class="anchor anchor-slide"></div>

@if(!empty($membersArea))
    @section('styles')
        @parent

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
        <style type="text/css">
            .join{display:inline-block;font:700 20px/1em "Roboto Condensed",sans-serif;text-transform:uppercase;background:#10D05F;border-radius:50px;color:#FFF;padding:17px 7%;outline:none;cursor:pointer;text-align:center;user-select:none;text-decoration:none;transition:all .3s;box-shadow:0 0 0 rgba(0,0,0,0.35)}@media (min-width: 40em){.join{font-size:28px}}.join:hover,.join:focus{color:#FFF;background:#13E868;box-shadow:0 0 7px rgba(0,0,0,0.35)}.join.blue{background:#0b76db}.join.blue:hover,.join.blue:focus{background:#258ff4}.join.sold-out{background:#777}.join.sold-out:hover,.join.sold-out:focus{background:#919191}
            .content-section.customize > div > img { height:40px; }
        </style>
        <link href="{{ asset('/assets/members-area/css/gulp/sales-2020.css') }}" rel="stylesheet">
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    @endsection

    @include("drumeo.sales.partials._subscribe-bonus-list-alt", [
        "membersArea" => true
        ])
@else
    @include('drumeo.sales.partials._subscribe-bonus-list-alt')
@endif
