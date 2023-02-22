@extends('drumeo._partials.global-layout')

@section('global-head')
    @yield('meta')
    <meta name="description" content="Choosing gifts for the drummer in your life can be a tricky task.">
    <meta property="og:title" content="Gift Guide by Drumeo">
    <meta property="og:description" content="Choosing gifts for the drummer in your life can be a tricky task.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/og-image.jpg" style="display: none;">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation-float.min.css"/>

    <link href="{{ asset('/marketing/parcel/drumeo/gift-guide.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
@stop

@section('global-body')

    @include("drumeo.sales.partials._nav")

    <header class="header">
        <div class="row">
            <div class="columns">
                <h1>Drummer Gift Guide:</h1>
                <h2>@yield('title')</h2>
                <p>Choosing gifts for the drummer in your life can be a tricky task. The drummers over here at Drumeo want to make picking a present for your drummer a delight.
                    <br><br>
                    Each of these great gift ideas were hand picked by our percussionists. If after browsing through the list you are still in doubt about what to get your drummer - our top (although slightly biased) recommendation is a Drumeo membership.
                    <a href="/">Find Out Why &raquo;</a></p>
            </div>
        </div>
    </header>

    <section class="catalogue-filters">
        <div class="row">
            <div class="filters">
                <div class="columns medium-9 price-filter-wrap">
                    <div class="price-filter active" data-min-price="0" data-max-price="500">All</div>
                    <div class="price-filter" data-min-price="0" data-max-price="24">Under $25</div>
                    <div class="price-filter" data-min-price="25" data-max-price="49">$25 to $50</div>
                    <div class="price-filter" data-min-price="50" data-max-price="99">$50 to $100</div>
                    <div class="price-filter" data-min-price="100" data-max-price="500">$100+</div>
                </div>
                <div class="columns medium-3">
                    <select id="sortOrder" data-filter-type="sort-order" class="catalogue-filter">
                        <option class="selectable-option" selected>Popularity</option>
                        <option class="selectable-option">Price: Low to High</option>
                        <option class="selectable-option">Price: High to Low</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <section class="grid-view">
        <ul class="row fixed-cards">
            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => floatval($productPrices['practicepad']->discounted_price),
                        "popularity" => "100",
                        "itemURL" => "/drumshop/practice-pad-full/",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/drumeo-p4-practice-pad.jpg",
                        "title" => "Drumeo P4 Practice Pad",
                        "bottomText" => "The P4 practice pad is the only practice pad in the market with four different playing surfaces that provide unique feels and responses, on three elevated levels to simulate actual drum-set movement.",
                        "onDrumeo" => "TRUE"
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => Prices::$plusSubscriptionAnnual,
                        "popularity" => "100",
                        "stockingStuffer" => "TRUE",
                        "rockDrummer" => "TRUE",
                        "jazzDrummer" => "TRUE",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "/",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/drumeo-edge-drum-lessons.jpg",
                        "title" => "Drumeo Drum Lessons",
                        "bottomText" => "Join the “Best Educational Website” as voted by the readers of DRUM! magazine. Our online membership includes live and recorded lessons from more than 60 of the best instructors in the world. You’ll get a live lesson every day – plus access to more than 1000 hours of on-demand recorded lessons and 100+ play-along songs.",
                        "onDrumeo" => "TRUE"
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "22",
                        "popularity" => "98",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2xYCRDQ",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/zildjian-drummer-survival-kit.jpg",
                        "title" => "Zildjian Drummer Survival Kit",
                        "bottomText" => "The essential emergency kit to get through any gig. Included are snare strings, cymbal felts, a drumhead repair patch, and cymbal stand sleeves and washers."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "15",
                        "popularity" => "95",
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "https://amzn.to/2xYf86O",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/meinl-cymbals-ching-ring.jpg",
                        "title" => "Meinl Cymbals Ching Ring",
                        "bottomText" => "These steel jingles will add a different touch to your playing by delivering a shimmering sound that blends perfectly with any drum beat. Easy to place on any hi-hat, crash, ride, or cymbal stack without any wingnuts!"
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "299",
                        "popularity" => "93",
                        "jazzDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zdhWyt",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/zildjian-l80-low-volume-cymbals.jpg",
                        "title" => "Zildjian L80 Low Volume Cymbals",
                        "bottomText" => "These unique cymbals deliver a sound 80% quieter than a traditional cymbal without losing that authentic feel. Perfect for home practice, lesson rooms, and even quiet gigs. Available as a set of 14” hi hats, 16” crash, and a 20” ride - or buy them individually!"
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "13",
                        "popularity" => "90",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2y05ReB",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/vater-drink-holder.jpg",
                        "title" => "Vater Drink Holder",
                        "bottomText" => "This cup holder features the same metal design and fastening system as their popular stick holders for supreme durability. The Drink Holder has an inside diameter of 3 1/2&quot;, large enough for most drinks, cups, and sports bottles and securely fastens to cymbal stands with an easy-to-turn knob."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "popularity" => "86",
                        "price" => 29,
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "/drumshop/gift-card/",
                        "thumbnail" => "https://cdn.musora.com/image/fetch/w_600,q_auto:best/https:/d1923uyy6spedc.cloudfront.net/Drumeo-cart-2-1643147388.png",
                        "title" => "Drumeo Gift Card",
                        "bottomText" => "A physical access pass that you can use for yourself, or to send as a gift to another drummer that can be redeemed at anytime. This gift card grants full access to Drumeo, The Ultimate Online Drum Lessons Experience.",
                        "onDrumeo" => "TRUE"
            ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "8",
                        "popularity" => "85",
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zhP2z9",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/vic-firth-universal-practice-tips.jpg",
                        "title" => "Vic Firth Universal Practice Tips",
                        "bottomText" => "The perfect way to practice on any surface. Simply add rubber tips to the end of your sticks and play!"
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "14",
                        "popularity" => "83",
                        "stockingStuffer" => "TRUE",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2xWXnEQ",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/pearl-ptt13-drum-key.jpg",
                        "title" => "Pearl PTT13 Drum Key",
                        "bottomText" => "Thirteen gig ready tools specifically selected to fit all drums, pedals, and hardware. It features six hex keys, five screwdrivers, a standard drum key, and a bottle opener for when all the hard work is done."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "popularity" => "82",
                        "price" => floatval($productPrices['Drumeo-Water-Bottle']->discounted_price),
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "/drumshop/water-bottle/",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/drumeo-water-bottle.jpg",
                        "title" => "Drumeo Water Bottle",
                        "bottomText" => "This stainless steel water bottle will keep your H20 cool while you play the drums with room for 24 oz of water (so you don't need to go refills over and over again).",
                        "onDrumeo" => "TRUE"
            ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "15",
                        "popularity" => "80",
                        "itemURL" => "https://amzn.to/2hDs8bV",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/remo-silent-stroke-drumheads.jpg",
                        "title" => "Remo Silent Stroke Drumheads",
                        "bottomText" => "These ambassador drumheads are designed for quiet practice applications where standard drum set volumes are an issue. Constructed with 1-ply mesh material, they provide a soft spring-like feel at very low decibel levels."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "69",
                        "popularity" => "80",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zbL09o",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/tune-bot-drum-tuner.jpg",
                        "title" => "Tune-Bot Drum Tuner",
                        "bottomText" => "This digital tuner is the fastest, easiest and best way to get your drums sounding great. It features a large LCD screen optimized for use in the studio or on a dark stage and clips to any standard drum hoop."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "20",
                        "popularity" => "80",
                        "rockDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2iZj5pe",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/big-fat-snare-drum.jpg",
                        "title" => "Big Fat Snare Drum",
                        "bottomText" => "This unique drum accessory was engineered to give any snare drum a vintage, beefy, thumpy sound. Unlike gels or tape, the Big Fat Snare Drum lowers the fundamental pitch of your snare drum without any of the hassle. Simple place directly on top of your snare head!"
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "20",
                        "popularity" => "80",
                        "stockingStuffer" => "TRUE",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2xXJAy2",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/tama-quick-set-cymbal-mate.jpg",
                        "title" => "Tama Quick-Set Cymbal Mate",
                        "bottomText" => "By simply gripping and pressing the two buttons on both sides, drummers can remove the cymbal mate with just one touch to make adding, removing, or swapping your cymbals a breeze. Comes in a pack of four."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => floatval($productPrices['Drumeo-VaterSticks']->discounted_price),
                        "popularity" => "80",
                        "stockingStuffer" => "TRUE",
                        "rockDrummer" => "TRUE",
                        "itemURL" => "/drumshop/drumsticks/",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/cart-image.jpg",
                        "title" => "Vater Drumeo 5A Drumsticks",
                        "bottomText" => "Made with hickory wood and up to 2X the moisture content of most drumstick manufacturers.",
                        "onDrumeo" => "TRUE"
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "19",
                        "popularity" => "80",
                        "stockingStuffer" => "TRUE",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2isWJsk",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/evans-torque-key.jpg",
                        "title" => "Evans Torque Key",
                        "bottomText" => "The Evans Torque drum key has an ergonomic grip for maximum comfort, a knurled knob for quick spinning, and a slip-resistant magnetic head. The torque handle can be set to a desired tension to help drummers attain more accurate tuning."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "9",
                        "popularity" => "80",
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "https://amzn.to/2xXdW3D",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/gibraltar-ratchet-drum-key.jpg",
                        "title" => "Gibraltar Ratchet Drum Key",
                        "bottomText" => "This tool is a medium-weight ratchet-style drum key wrench with tighten and loosen tension adjustment positions."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "20",
                        "popularity" => "75",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zeagMs",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/meinl-percussion-stick-bag.jpg",
                        "title" => "Meinl Percussion Stick Bag",
                        "bottomText" => "This stick bag offers plenty of room to carry multiple pairs of stick, brushes, mallets, and whatever else you need for a successful gig or rehearsal. The external pockets allow you to store any extra accessories."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "21",
                        "popularity" => "72",
                        "jazzDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2xYT7Fa",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/promark-hot-rods.jpg",
                        "title" => "Promark Hot Rods",
                        "bottomText" => "Made of premium birch dowels, these rods have a lighter sound than sticks but more attack than brushes. They provide an excellent consistency and feel with a smooth grip for easy playability."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "popularity" => "71",
                        "price" => floatval($productPrices['Drumeo-Towel']->discounted_price),
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "/drumshop/drummer-towels/",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/drumeo-towel.jpg",
                        "title" => "Drumeo Towel",
                        "bottomText" => "Subtle and absorbent, this towel is perfect for those long practice sessions or live shows where you're drumming up a sweat!",
                        "onDrumeo" => "TRUE"
            ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "18",
                        "popularity" => "70",
                        "rockDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zjsYEa",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/evans-eq-pad-bass-drum-damper.jpg",
                        "title" => "Evans EQ Pad Bass Drum Damper",
                        "bottomText" => "The Evans EQ Pad is a highly efficient bass drum muffler that attaches to the bottom of the bass drum shell with Velcro. The hinged pad bounces off the head, allowing sustain, before returning to damp the vibrating head."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "popularity" => "68",
                        "price" => floatval($productPrices['3001-unisex-jersey-sketchy-shirt']->discounted_price),
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "/drumshop/tshirt-navy/",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/drumeo-navy-shirt.jpg",
                        "title" => "Drumeo Navy Shirt",
                        "bottomText" => "Add some color to your drumming wardrobe with Drumeo's navy t-shirt featuring a sketched drum-kit and hand-drawn style logo.",
                        "onDrumeo" => "TRUE"
            ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "60",
                        "popularity" => "70",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zw44T2",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/drumdial-drum-tuner.jpg",
                        "title" => "DrumDial Drum Tuner",
                        "bottomText" => "Easily tune your drums by measuring pressure on the drum head. Fast, precise, and no whacking necessary!"
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "180",
                        "popularity" => "70",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2hCDzkb",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/dw-go-anywhere-practice-pad-kit.jpg",
                        "title" => "DW Go Anywhere Practice Pad Kit",
                        "bottomText" => "This portable 5-piece practice pad set is the ultimate way to practice drums whether at home or on the go. The surfaces have a natural feel and rebound and allow for a ultra-quiet practice session. The set is heavy-duty and easy to assemble."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "29",
                        "popularity" => "67",
                        "itemURL" => "https://amzn.to/2y08Cwf",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/evans-soundoff-mute-pack.jpg",
                        "title" => "Evans SoundOff Mute Pack",
                        "bottomText" => "These mute pads allow players to practice on their normal drum sets and in the comfort of their own homes without making noise. This pack includes sizes to fit a drum configuration of 12, 13, and 16 inch toms with a 14 inch snare drum."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "20",
                        "popularity" => "65",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2ysMZcg",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/vic-firth-stick-caddy.jpg",
                        "title" => "Vic Firth Stick Caddy",
                        "bottomText" => "This stick holder is smartly designed for an infinite amount of settings, angles, and locations around the kit. It features a solid steel construction for maximum durability, as well as a rubber insert to keep your stick tips protected."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "9",
                        "popularity" => "65",
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "https://amzn.to/2hBr3Bo",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/groove-juice-cymbal-cleaner.jpg",
                        "title" => "Groove Juice Cymbal Cleaner",
                        "bottomText" => "Keep your cymbals looking fresh and new with this no-rubbing, no-buffing, no-polishing cymbal cleaner. Suitable for all cymbal brands, this cleaner features an advanced formula that removes grease, fingerprints, and dirt."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "14",
                        "popularity" => "65",
                        "stockingStuffer" => "TRUE",
                        "jazzDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2iXvaLx",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/promark-s22-cymbal-sizzler.jpg",
                        "title" => "Promark S22 Cymbal Sizzler",
                        "bottomText" => "The perfect alternative to putting permanent rivets in your favorite cymbal. Achieve the same classic sound without the hassle. The cymbal sizzler comes with a cymbal felt and fits conveniently on the cymbal post."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "90",
                        "popularity" => "65",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zdRO6G",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/tama-rhythm-watch.jpg",
                        "title" => "Tama Rhythm Watch",
                        "bottomText" => "This metronome has everything a drummer needs to make sure they stay on tempo-live and in the studio. It features plenty of volume to use while playing real drums, a dial for quick tempo adjustments, separate volumes for all note values, and much more."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "147",
                        "popularity" => "64",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zcK6cR",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/boss-db-90-metronome.jpg",
                        "title" => "Boss DB-90 Metronome",
                        "bottomText" => "Practice in style with the flagship of the Dr. Beat Metronome line. The DB-90 is loaded with quality sounds and drum patterns to make your practice sessions less mundane and more musical. There’s a rhythm coach function with an on-board mic, a reference-tone function for tuning, an Instrument input, MIDI input, and other handy tools to make learning fun and effective."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "20",
                        "popularity" => "60",
                        "stockingStuffer" => "TRUE",
                        "rockDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2iv5a6j",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/dw-two-way-bass-drum-beater.jpg",
                        "title" => "DW Two-Way Bass Drum Beater",
                        "bottomText" => "This beater features both hard and padded surface beater surfaces with an adjustable shaft weight. The felt side offers a more traditional sound and feel, while the plastic side offers increased attack."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "15",
                        "popularity" => "50",
                        "stockingStuffer" => "TRUE",
                        "rockDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2xXekPx",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/gibraltar-felt-bass-drum-beater.jpg",
                        "title" => "Gibraltar Felt Bass Drum Beater",
                        "bottomText" => "Inspired by a classic design, this bass drum beater is excellent for a variety of music style. It features a strong steel shaft and a circular felt beater."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "20",
                        "popularity" => "50",
                        "stockingStuffer" => "TRUE",
                        "jazzDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2y06eWx",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/vater-vintage-bomber-beater.jpg",
                        "title" => "Vater Vintage Bomber Beater",
                        "bottomText" => "This beater was conceived and designed to replicate the soft but boomy bass drum tones of the great jazz era. The cork center is wrapped with a puffy synthetic covering and is reminiscent in look, feel, and sound to the lamb’s wool beater from decades ago."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "34",
                        "popularity" => "50",
                        "jazzDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2yszDgr",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/vic-firth-split-brush.jpg",
                        "title" => "Vic Firth Split Brush",
                        "bottomText" => "This recently released brush by Vic Firth is designed with 2 separate rows of wire, producing a unique sound with different qualities of articulation. The pull rod is also triple crimped, allowing for additional setting options."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "5",
                        "popularity" => "50",
                        "stockingStuffer" => "TRUE",
                        "rockDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2hD5MHu",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/evans-eq-double-pedal-patch.jpg",
                        "title" => "Evans EQ Double Pedal Patch",
                        "bottomText" => "This non-slip black nylon bass drum patch increases attack and strengthens the head without affecting sustain or low-end. Available in single and double pedal versions."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "70",
                        "popularity" => "47",
                        "rockDrummer" => "TRUE",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2hCDgG8",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/vic-firth-sound-isolation-headphones.jpg",
                        "title" => "Vic Firth Sound Isolation Headphones",
                        "bottomText" => "Designed to protect musicians from the high sound level associated with their instruments, these headphones drastically reduce the level of external sound reaching the ear. These are the go-to choice for many drummers. Perfect for practice or gigs."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "popularity" => "45",
                        "price" => "25",
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zqReVi",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/rockstix-light-up-drumsticks.jpg",
                        "title" => "Rockstix Light-Up Drumsticks",
                        "bottomText" => "Made from strong poly-carbonate and featuring thirteen different color effects, these drumsticks create amazing visual effects as they're moved through the air."
            ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "99",
                        "popularity" => "47",
                        "rockDrummer" => "TRUE",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zcdCzz",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/shure-se215-sound-isolating-earphones.jpg",
                        "title" => "Shure SE215 Sound Isolating Earphones",
                        "bottomText" => "Featuring enhanced bass and detailed sound, the Shure SE215s include a single dynamic microdriver. With a detachable cable, formable wire, and many different sized buds, the SE215’s ensure comfort whether on stage or on the go."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "62",
                        "popularity" => "37",
                        "itemURL" => "https://amzn.to/2zvNiTJ",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/evans-real-feel-bass-pedal-practice-pad.jpg",
                        "title" => "Evans Real Feel Bass Pedal Practice Pad",
                        "bottomText" => "This pad provides the best practice substitute to an acoustic drum. It features a gum rubber surface for a realistic rebound, a wide pad to accommodate a double pedal, and a collapsible construction."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "35",
                        "popularity" => "37",
                        "itemURL" => "https://amzn.to/2itvRbQ",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/evans-real-feel-practice-pad.jpg",
                        "title" => "Evans Real Feel Practice Pad",
                        "bottomText" => "This practice pad has a large playing surface that fits inside a standard snare basket. It has a natural gum feel on one side for realistic stick rebound and a harder recycled rubber surface on the other for a real workout."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "34",
                        "popularity" => "35",
                        "itemURL" => "https://amzn.to/2hCCI32",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/vic-firth-double-sided-practice-pad.jpg",
                        "title" => "Vic Firth Double Sided Practice Pad",
                        "bottomText" => "Available with soft rubber for quiet practice on one side and with hard rubber for intensifying the workout and hearing each stroke on the opposite side. This pad features a dense wooden base for an authentic feel. Two distinct densities, two distinct feels."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "18",
                        "popularity" => "35",
                        "itemURL" => "https://amzn.to/2iuid7Z",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/remo-tunable-practice-pad.jpg",
                        "title" => "Remo Tunable Practice Pad",
                        "bottomText" => "This tunable practice pad features a replaceable Ambassador Coated drumhead providing the bounce and feel of a real drum. A great practice pad for a beginner drummer just getting started or an advanced drummer looking to maintain their chops."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "13",
                        "popularity" => "33",
                        "itemURL" => "https://amzn.to/2iYf2JP",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/promark-firegrain-drumsticks.jpg",
                        "title" => "Promark FireGrain Drumsticks",
                        "bottomText" => "These sticks feature a revolutionary heat-tempering process that transforms ordinary drumsticks into precision tools with unprecedented durability. Hickory is the most popular wood choice due to its resilience, responsiveness, and classic feel."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "popularity" => "32",
                        "price" => "15",
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "https://amzn.to/2yErqWf",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/paradiddle-t-shirt.jpg",
                        "title" => "Paradiddle T-Shirt",
                        "bottomText" => "The paradiddle is one of the most iconic drum rudiments that any drummer can identify with. Availble in five different colors."
            ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "6",
                        "popularity" => "30",
                        "stockingStuffer" => "TRUE",
                        "rockDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2iZ3vKc",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/vater-stick-grip-tape.jpg",
                        "title" => "Vater Stick Grip Tape",
                        "bottomText" => "The world's first drumming tape to be designed for use on both sticks and fingers. The tape helps prevent blisters and hand fatigue, while still allowing a sense of 'feel' to maximize dexterity and grip."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "popularity" => "29",
                        "price" => "11",
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zoAY7c",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/zildjian-cymbal-mouse-pad.jpg",
                        "title" => "Zildjian Cymbal Mouse Pad",
                        "bottomText" => "The perfect gift for any Zildjian fan featuring a splash graphic on top and a padded underside."
            ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "25",
                        "popularity" => "28",
                        "stockingStuffer" => "TRUE",
                        "rockDrummer" => "TRUE",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zi0YBc",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/gibraltar-quick-release-hi-hat-clutch.jpg",
                        "title" => "Gibraltar Quick Release Hi Hat Clutch",
                        "bottomText" => "This hi hat clutch outperforms the standard clutch in versatility, ease of use, and setup time. It does away with threads, meaning more loosening on the bottom nut - making this the most convenient clutch available today."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "26",
                        "popularity" => "27",
                        "itemURL" => "https://amzn.to/2zjtNND",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/latin-percussion-jam-block.jpg",
                        "title" => "Latin Percussion Jam Block",
                        "bottomText" => "Crafted from LP’s exclusive plastic formulation, these jam blocks have the rich sound of wood blocks and the strength and durability to withstand even the hardest-hitting players. Each block includes a heavy duty mounting bracket for easy installation on any drum set."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "50",
                        "popularity" => "22",
                        "itemURL" => "https://amzn.to/2y0cDAP",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/switch-kick-bass-drum-beaters.jpg",
                        "title" => "Switch Kick Bass Drum Beaters",
                        "bottomText" => "What started as a successful Kickstarter campaign in early 2015, the Switch Kick helps drummers to ‘switch’ beaters fast without any tools – with more than 10 different beater heads available."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "34",
                        "popularity" => "20",
                        "rockDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2iZknAA",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/latin-percussion-black-beauty-cowbell.jpg",
                        "title" => "Latin Percussion Black Beauty Cowbell",
                        "bottomText" => "Every song needs more cowbell. This model offers a signature sound that has made it one of the greatest selling cowbells in history. Available in a regular and large version."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "36",
                        "popularity" => "17",
                        "itemURL" => "https://amzn.to/2xYeMwZ",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/rhythm-tech-drum-set-tambourine.jpg",
                        "title" => "Rhythm Tech Drum Set Tambourine",
                        "bottomText" => "This tambourine is rugged, durable, and easily mountable on any drum set. A great way to add an extra layer of sound to your playing."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "popularity" => "16",
                        "price" => "10",
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zE2EFT",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/novelty-drummer-socks.jpg",
                        "title" => "Novelty Drummer Socks",
                        "bottomText" => "These novelty socks are the perfect gift for any drummer. Clear graphic, holds up in the wash, and fits feet of all sizes!"
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "popularity" => "16",
                        "price" => "20",
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zpbUuE",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/zildjian-cymbal-cutting-board.jpg",
                        "title" => "Zildjian Cymbal Cutting Board",
                        "bottomText" => "This cutting board made of 100% bamboo will make the kitchen feel like home to any drummer."
            ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "9",
                        "popularity" => "15",
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "https://amzn.to/2zbIccm",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/meinl-percussion-egg-shakers.jpg",
                        "title" => "Meinl Percussion Egg Shakers",
                        "bottomText" => "This specifically designed set of egg shakers from Meinl offer 4 different, distinct sounds ranging from soft to loud, giving you the full range of sound possibilities for studio and live performances."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "popularity" => "14",
                        "price" => "18",
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "https://amzn.to/2hPgXgs",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/artistic-drums-t-shirt.jpg",
                        "title" => "Artistic Drums T-Shirt",
                        "bottomText" => "This shirt is made with 100% combed ring-spun cotton with is softer than your average cotton. Available in a wide range of sizes."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "popularity" => "13",
                        "price" => "11",
                        "stockingStuffer" => "TRUE",
                        "itemURL" => "https://amzn.to/2ydDlWM",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/drumstick-mixing-spoons.jpg",
                        "title" => "Drumstick Mixing Spoons",
                        "bottomText" => "Drum on your pots and pans when you're not stirring! Made of solid beechwood, each set includes one slotted spoon and one solid spoon."
            ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "28",
                        "popularity" => "12",
                        "stockingStuffer" => "TRUE",
                        "rockDrummer" => "TRUE",
                        "giggingDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2iueXtv",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/zildjian-drummers-gloves.jpg",
                        "title" => "Zildjian Drummer’s Gloves",
                        "bottomText" => "Strap on these gloves for a better stick grip. These gloves feature a vented back, a soft lambskin palm, and a velcro closure. Available in small, medium, and large sizes."
                        ])

            @include("drumeo.lead-gen.gift-guide._item-card", [
                        "price" => "25",
                        "popularity" => "10",
                        "stockingStuffer" => "TRUE",
                        "jazzDrummer" => "TRUE",
                        "itemURL" => "https://amzn.to/2it2bv8",
                        "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/promos/gift-guide/gifts/promark-multi-purpose-felt-mallets.jpg",
                        "title" => "Promark Multi-Purpose Felt Mallets",
                        "bottomText" => "These mallets are the ideal pick for cymbal swells and getting a full, deep sound from your toms. They feature a semi-hard felt head and oak handle to provide a nice feel in the hands."
                        ])
        </ul>
    </section>

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script>
        var Filters = {
            filterByPrice: function(minPrice, maxPrice){
                var scalableCard = $('.scalable-card');

                scalableCard.addClass('hide');

                scalableCard.each(function () {
                    var thisPrice = $(this).data('price');

                    if (thisPrice > minPrice && thisPrice < maxPrice) {
                        $(this).removeClass('hide');
                    }
                });
            }
        };
        var Sorting = {
            sortItems: function(sortValue, sortDirection){
                var sortItems = [];

                $('.scalable-card').each(function(){
                    var thisItem = $(this),
                        thisData = $(this).data(sortValue);

                    sortItems.push({
                        item: thisItem,
                        data: thisData
                    });
                });

                if(sortDirection === 'desc'){
                    sortItems.sort(
                        Sorting.dynamicSort('data')
                    );
                }
                else {
                    sortItems.sort(
                        Sorting.dynamicSort('-data')
                    );
                }

                $.each(sortItems, function(){
                    var thisItem = $(this.item),
                        lastItem = $(sortItems[sortItems.length - 1].item);

                    thisItem.insertBefore(lastItem);
                });
            },
            dynamicSort: function(property){
                var sortOrder = 1;

                if(property[0] === "-") {
                    sortOrder = -1;
                    property = property.substr(1);
                }
                return function (a,b) {
                    var result = (a[property] < b[property]) ? -1 : (a[property] > b[property]) ? 1 : 0;
                    return result * sortOrder;
                };
            }
        };

        $(function () {
            $('.price-filter').on('click', function(){
                $('.price-filter').removeClass('active');
                $(this).addClass('active');

                var minPrice = $(this).data('min-price'),
                    maxPrice = $(this).data('max-price');

                Filters.filterByPrice(minPrice, maxPrice);
            });

            $('#sortOrder').change(function () {
                switch($(this).val()){
                    case 'Price: Low to High':
                        Sorting.sortItems('price', 'desc');
                        break;
                    case 'Price: High to Low':
                        Sorting.sortItems('price', 'asc');
                        break;
                }
            });

            $('.scalable-card a').click(function(e){
                var titleText = $(this).find('h4').text(),
                    linkUrl = $(this).attr('href');

                dataLayer.push({
                    'event': 'gtm.linkClick',
                    'gtm.elementText': titleText,
                    'gtm.elementUrl': linkUrl
                });
            });
        });
    </script>
@stop
