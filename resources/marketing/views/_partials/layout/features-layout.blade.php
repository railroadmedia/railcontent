@extends($theme.'._partials.global-layout')

@section('global-head')
    @yield('page-meta')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

    <style>
        .slick-slider.slick-light-buttons .slick-arrow {
            background: #fff;
        }
        .splide__pagination__page.is-active {
            background: #01050F;
            transform: none !important;
        }

        .splide__pagination__page {
            margin: 3px 6px !important;
            opacity: 1 !important;
        }

        .bubble:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 0;
            border: 5px solid transparent;
            border-top-color: black;
            border-bottom: 0;
            margin-left: -5px;
            margin-bottom: -5px;
        }
    </style>

    @yield('styles')
@stop

@section('global-body')
    @yield('page-nav')

    <header class="pb-12 md:pb-0 md:pt-20 bg-[#111729] text-center text-white">
        <img
            class="md:hidden mb-16 @if($page === 'songs') cursor-pointer @endif"
            src="https://www.musora.com/musora-cdn/image/width=900,quality=95/@yield('header-img')"
            alt="{{$page}} thumb"
            @if($page === 'songs') x-on:click="soundslice = true" @endif
            fetchpriority="high"
        />
        <div class="px-4 md:px-0">
            <div class="mb-6">
                <img
                    class="h-6 md:h-10 @if($theme !== 'drumeo') mr-2 @endif"
                    src="https://www.musora.com/musora-cdn/image/width=150,quality=95/@if($theme === 'drumeo')https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png @elseif($theme === 'pianote')https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-red.png @elseif($theme === 'guitareo')https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png @elseif($theme === 'singeo')https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png @endif"
                    alt="{{$theme}} logo"
                    fetchpriority="high"
                />

                <div class="inline-block align-middle h-6 md:h-10" alt="{{$page}} logo" fetchpriority="high">
                    @if($theme === 'drumeo')
                        <style>.fill-logo {fill:#0b76db}</style>
                    @elseif($theme === 'pianote')
                        <style>.fill-logo {fill:#f61a30}</style>
                    @elseif($theme === 'guitareo')
                        <style>.fill-logo {fill:#00c9ac}</style>
                    @elseif($theme === 'singeo')
                        <style>.fill-logo {fill:#8300e9}</style>
                    @endif
                    @if($page === 'method')
                        <svg class="fill-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:serif="http://www.serif.com/" width="100%" height="100%" viewBox="0 0 318 63" version="1.1" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                            <g transform="matrix(1,0,0,1,-431.057,-857.275)">
                                <g transform="matrix(1,0,0,0.998667,2.13971,0)">
                                    <g transform="matrix(0.6548,0,0,0.655674,-247.695,226.047)">
                                        <path d="M1435.38,1012.47C1435.38,980.465 1411.64,964.462 1387.9,964.462C1364.15,964.462 1340.41,980.465 1340.41,1012.47C1340.41,1076.62 1435.38,1076.62 1435.38,1012.47ZM1078.28,1005.99L1042.04,965.784L1033.31,965.784L1033.31,1058.63L1057.51,1058.63L1057.51,1017.37L1077.09,1038L1079.73,1038L1099.44,1017.37L1099.44,1058.63L1123.64,1058.63L1123.64,965.784L1115.18,965.784L1078.28,1005.99ZM1185.14,966.049L1127.35,966.049L1127.35,1058.63L1186.33,1058.63L1186.33,1037.6L1150.89,1037.6L1150.89,1021.33L1182.37,1021.33L1182.37,1000.3L1150.89,1000.3L1150.89,987.21L1185.14,987.21L1185.14,966.049ZM1211.07,987.21L1211.07,1058.63L1234.48,1058.63L1234.48,987.21L1257.09,987.21L1257.09,966.049L1188.32,966.049L1188.32,987.21L1211.07,987.21ZM1336.98,966.049L1312.77,966.049L1312.77,999.642L1284.2,999.642L1284.2,966.049L1260,966.049L1260,1058.63L1284.2,1058.63L1284.2,1021.47L1312.77,1021.47L1312.77,1058.63L1336.98,1058.63L1336.98,966.049ZM1473.6,966.049L1438.68,966.049L1438.68,1058.63L1473.6,1058.63C1533.91,1058.37 1533.91,966.313 1473.6,966.049ZM1364.75,1012.47C1364.75,995.807 1376.36,987.475 1387.96,987.475C1399.57,987.475 1411.17,995.807 1411.17,1012.47C1411.17,1046.07 1364.75,1046.07 1364.75,1012.47ZM1462.36,987.607L1473.6,987.607C1503.09,987.607 1503.09,1037.07 1473.6,1037.07L1462.36,1037.07L1462.36,987.607Z" style="fill-rule:nonzero;"/>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    @elseif($page === 'coaches')
                        <svg class="fill-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:serif="http://www.serif.com/" width="100%" height="100%" viewBox="0 0 377 64" version="1.1" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                            <g transform="matrix(1,0,0,1,-431.057,-684.656)">
                                <g transform="matrix(1,0,0,0.998667,2.13971,0)">
                                    <g transform="matrix(0.6548,0,0,0.655674,-247.695,226.047)">
                                        <path d="M1556.26,766.706L1533.38,766.706C1532.85,807.442 1608.24,806.78 1608.24,767.896C1608.24,744.751 1590.25,741.974 1571.87,739.99C1563.54,739.064 1556.66,737.609 1557.19,730.599C1557.98,719.622 1582.85,718.564 1582.85,730.864L1605.33,730.864C1605.86,690.922 1533.91,690.922 1534.7,730.864C1534.97,750.967 1548.19,757.845 1568.3,759.3C1577.56,759.829 1585.23,761.283 1585.23,767.764C1585.23,778.609 1556.26,778.477 1556.26,766.706ZM1221.52,748.851C1221.52,716.845 1197.77,700.841 1174.03,700.841C1150.29,700.841 1126.55,716.845 1126.55,748.851C1126.55,812.997 1221.52,812.997 1221.52,748.851ZM1033.31,748.719C1033.44,780.196 1057.25,796.067 1080.79,795.935C1100.5,795.935 1121.26,785.619 1124.7,759.432L1101.42,759.432C1098.91,769.351 1090.84,774.377 1080.79,774.377C1066.77,774.245 1057.78,762.342 1057.78,748.719C1057.78,733.377 1066.9,722.928 1080.79,722.928C1090.71,722.928 1097.72,727.161 1101.03,736.551L1124.31,736.551C1120.73,711.819 1099.97,701.37 1080.79,701.37C1057.25,701.37 1033.44,717.241 1033.31,748.719ZM1295.18,748.719C1295.32,780.196 1319.12,796.067 1342.66,795.935C1362.37,795.935 1383.13,785.619 1386.57,759.432L1363.3,759.432C1360.78,769.351 1352.71,774.377 1342.66,774.377C1328.64,774.245 1319.65,762.342 1319.65,748.719C1319.65,733.377 1328.78,722.928 1342.66,722.928C1352.58,722.928 1359.59,727.161 1362.9,736.551L1386.18,736.551C1382.61,711.819 1361.84,701.37 1342.66,701.37C1319.12,701.37 1295.32,717.241 1295.18,748.719ZM1530.21,702.428L1472.41,702.428L1472.41,795.009L1531.4,795.009L1531.4,773.98L1495.95,773.98L1495.95,757.712L1527.43,757.712L1527.43,736.683L1495.95,736.683L1495.95,723.59L1530.21,723.59L1530.21,702.428ZM1467.25,702.428L1443.05,702.428L1443.05,736.022L1414.48,736.022L1414.48,702.428L1390.28,702.428L1390.28,795.009L1414.48,795.009L1414.48,757.845L1443.05,757.845L1443.05,795.009L1467.25,795.009L1467.25,702.428ZM1282.09,795.009L1305.23,795.009L1305.23,791.571L1263.44,701.238L1253.26,701.238L1211.6,791.571L1211.6,795.009L1234.74,795.009L1240.16,783.371L1276.67,783.371L1282.09,795.009ZM1150.89,748.851C1150.89,732.187 1162.49,723.854 1174.1,723.854C1185.71,723.854 1197.31,732.187 1197.31,748.851C1197.31,782.445 1150.89,782.445 1150.89,748.851ZM1269,763.135L1247.83,763.135L1258.28,738.799L1269,763.135Z" style="fill-rule:nonzero;"/>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    @elseif($page === 'songs')
                        <svg class="fill-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:serif="http://www.serif.com/" width="100%" height="100%" viewBox="0 0 278 64" version="1.1" xml:space="preserve" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                            <g transform="matrix(1,0,0,1,-431.057,-536.414)">
                                <g transform="matrix(1,0,0,0.998667,2.13971,0)">
                                    <g transform="matrix(0.6548,0,0,0.655674,-247.695,226.047)">
                                        <path d="M1056.19,540.313L1033.31,540.313C1032.78,581.049 1108.17,580.387 1108.17,541.503C1108.17,518.358 1090.18,515.581 1071.8,513.597C1063.47,512.671 1056.59,511.216 1057.12,504.207C1057.91,493.229 1082.78,492.171 1082.78,504.471L1105.26,504.471C1105.79,464.529 1033.84,464.529 1034.64,504.471C1034.9,524.574 1048.13,531.452 1068.23,532.907C1077.49,533.436 1085.16,534.891 1085.16,541.371C1085.16,552.216 1056.19,552.084 1056.19,540.313ZM1405.09,540.313L1382.21,540.313C1381.68,581.049 1457.07,580.387 1457.07,541.503C1457.07,518.358 1439.08,515.581 1420.7,513.597C1412.37,512.671 1405.49,511.216 1406.02,504.207C1406.81,493.229 1431.68,492.171 1431.68,504.471L1454.16,504.471C1454.69,464.529 1382.74,464.529 1383.53,504.471C1383.8,524.574 1397.02,531.452 1417.13,532.907C1426.39,533.436 1434.06,534.891 1434.06,541.371C1434.06,552.216 1405.09,552.084 1405.09,540.313ZM1204.19,522.458C1204.19,490.452 1180.45,474.448 1156.71,474.448C1132.97,474.448 1109.23,490.452 1109.23,522.458C1109.23,586.604 1204.19,586.604 1204.19,522.458ZM1290.42,522.326C1290.56,553.936 1314.36,569.674 1337.9,569.674C1354.97,569.674 1372.56,562.268 1379.17,542.958C1382.34,533.965 1382.34,525.103 1381.82,515.845L1338.04,515.845L1338.04,536.345L1357.74,536.345C1353.51,545.207 1347.43,547.72 1337.9,547.72C1323.88,547.72 1314.89,537.668 1314.89,522.326C1314.89,508.174 1322.96,496.536 1337.9,496.536C1347.3,496.536 1353.38,499.71 1357.21,507.645L1380.49,507.645C1376,484.632 1356.55,474.977 1337.9,474.845C1314.36,474.845 1290.56,490.716 1290.42,522.326ZM1278.65,568.749L1287.12,568.749L1287.12,476.035L1262.91,476.035L1262.91,521.4L1216.1,475.639L1207.5,475.639L1207.5,568.616L1231.97,568.616L1231.97,523.12L1278.65,568.749ZM1133.57,522.458C1133.57,505.794 1145.17,497.461 1156.78,497.461C1168.38,497.461 1179.99,505.794 1179.99,522.458C1179.99,556.052 1133.57,556.052 1133.57,522.458Z" style="fill-rule:nonzero;"/>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    @endif
                </div>
            </div>
            <h2 class="font-extrabold mb-4">@yield('header')</h2>
            <p class="md:mb-10">@yield('desc')</p>
        </div>
        <picture>
            <source media="(min-width: 500px)" srcset="https://www.musora.com/musora-cdn/image/width=900,quality=95/@yield('header-img')">
            <img
                class="rounded-t-xl md:h-72 lg:h-80 hidden md:inline-block @if($page === 'songs') cursor-pointer @endif"
                src="https://www.musora.com/musora-cdn/image/width=550,quality=95/@yield('header-img')"
                alt="{{$page}} thumb"
                @if($page === 'songs') x-on:click="soundslice = true" @endif
                fetchpriority="high"
            />
        </picture>

    </header>

    @yield('page-body')

    @yield('page-footer')

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    @yield('page-scripts')
@stop
