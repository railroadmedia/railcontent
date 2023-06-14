<section class="py-12 sm:py-16 lg:py-20 px-5 relative overflow-hidden text-white text-center border-t-2" style="border-color:#FFAE00;background-color:#0c1524;">
    <div class="container mx-auto max-w-xl relative z-0">
        <h3 style="color:#FFAE00;"><strong>Let’s chat.</strong></h3>
        <p class="max-w-2xl my-4 leading-normal">We want to fill the world with music! So if you’re looking to partner, inquire about media opportunities, join our team, or just want to ask a few questions -- click @if(empty($onContact) && empty($onJobs))one of the buttons @else the button @endif below to start the conversation.</p>
        @if(empty($onContact)) <a class="btn-primary btn-small text-drumeo bg-white pb-6 rounded-full text-sm inline-block" target="_blank" href="{{ get_musora_brand_base_url() }}/contact">CONTACT US</a> @endif
        @if(empty($onJobs)) <a class="btn-primary btn-small text-drumeo bg-white pb-6 rounded-full text-sm inline-block" href="/careers">SEE CAREER OPENINGS</a> @endif
    </div>
</section>
