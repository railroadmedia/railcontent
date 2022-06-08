<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    <meta property="og:description" content="{{ $product->meta_desc  }}}">

    <link rel="stylesheet" href="{{ mix('platform/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
</head>

<body>
    <div class="clearfix tw-mx-auto tw-mx-auto tw-max-w-4xl">
        <div class="lg:tw-flex">
            @include('test.partials.slider',[
                "headerText" => $product->header_text,
                "videoSrc" => $product->video_src,
                "images" => $product->images,
            ])

            @include('test.partials.sidebar',[
                "sku" => $product->sku,
                "logo" => $product->logo,
                "fullPrice" => $product->price,
                "price"=> $product->price,
                "guaranteeBadge" => $product->guaranteed,
                "sizes" => $product->sizes,
                "soldOut" => $product->sold_out,
            ])
        </div>

        <div class="product-wrap lg:tw-w-2/3 tw-px-3 md:tw-px-4">
            <div class="pack-details tw-mx-auto tw-mb-7 tw-pb-5 sm:tw-pb-9 lg:tw-pb-11">
                @if($product->productType->name === 'Lesson')
                    @include('test.partials.features',[
                        'features' => [
                            [
                                "icon" => "fa-trophy",
                                "heading" => "Study With ". $product->instructor_name,
                                "text" => $product->study_text,
                            ],
                            [
                                "icon" => "fa-users",
                                "heading" => "Drumeo Interactive Edition",
                                "text" => "The famous Hudson Music DVD has been reformatted for a world-class digital, interactive experience.",
                            ],
                            [
                                "icon" => "fa-smile",
                                "heading" => "100% Happiness Guaranteed",
                                "text" => "We think you’ll love these lessons, and that’s why you can try them risk-free with our 90-day guarantee!"
                            ],
                        ]
                    ])

                    @include('test.partials.overview',[
                        "overview" => $product->overview,
                        "interactive" => true,
                    ])

                    @include('test.partials.specs',[
                        'specList'=> $product->specs,
                    ])

                    @include('test.partials.instructor',[
                        "instructorPhoto" => $product->instructor_img,
                        "instructorBio" => $product->instructor_desc
                    ])

                    @include('test.partials.topics',[
                        "topicList" => $product->features
                    ])

                @else
                    @include('test.partials.specs',[
                        'specList'=> $product->specs,
                        'featureList' => $product->features
                    ])
                @endif

                @if(!is_null($product->size_chart_id))
                    <img src="https://laravel-nova.s3.us-east-2.amazonaws.com/{{ $product->sizeChart->chart }}" />
                @endif

            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/cf2f4c6c71.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $(document).ready(function(){$(".anchor-slide").on("click",function(e){e.preventDefault();e=$(this).attr("href").replace("/","");$("html, body").stop().animate({scrollTop:$(e).offset().top},1e3)}),$(".slider-for").slick({slidesToShow:1,slidesToScroll:1,asNavFor:".slider-nav",arrows:!1,fade:!0}),$(".slider-nav").slick({slidesToShow:6,slidesToScroll:1,asNavFor:".slider-for",arrows:!1,focusOnSelect:!0,responsive:[{breakpoint:640,settings:{slidesToShow:4}}]}),$("#videoPlayer").length&&$(".slider-for").on("afterChange",function(){var e=$("#videoPlayer"),t=$("#videoSrc").get(0).innerText;e.attr("src")&&e.attr("src",""),0===currentSlide&&e.attr("src",t)});function t(e){return $(window).scrollTop()>e}function e(e){return!!$(e).is(":visible")&&$(e).parent().offset().top}$("select").prop("selectedIndex",0),$(".pack-pick").change(function(){var e=$(this).parent().find(".selected-pack"),t=$(this).find("option:selected"),r=$(t).data("price");$(this).parent().find(".chosen-variant-price-float").html(r),$(this).removeClass("error"),e.addClass("active"),e.attr("href","/laravel/public/shopping-cart/api/query?go-back-to-shop=true"),e.attr("href",e.attr("href")+"&products["+t.val()+"]=1"),e.attr("data-product-json",t.attr("data-product-json"))}),$(".selected-pack").on("click",function(e){$(this).hasClass("active")||(e.preventDefault(),e.stopPropagation(),$(this).parent().find(".pack-pick").addClass("error"))});var r=window.innerWidth,i=$(".sliding-function .side-slide"),s=$(".top-bar").height();$(window).resize(function(){r=window.innerWidth,$(i).removeClass("fixedSlider")});var o=e(i);$(window).scroll(function(){var e;1023<r&&(e=$(".sales-footer").offset().top,!1!==o&&(t(o-s-15)?($(i).hasClass("fixedSlider")||$(i).addClass("fixedSlider"),t(e-i.height()-s-30)?i.css("top",e-i.height()-$(window).scrollTop()-15):i.css("top","")):$(i).hasClass("fixedSlider")&&$(i).removeClass("fixedSlider")))}),$(i).css("width",$(i).parent().width()),$(window).resize(function(){void 0!==i&&(o=e(i),$(i).css("width",$(i).parent().width()),$(window).trigger("scroll"))})});
    </script>
</body>
</html>
