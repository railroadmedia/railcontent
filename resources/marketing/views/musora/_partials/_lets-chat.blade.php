<section class="py-12 sm:py-16 lg:py-20 px-5 relative overflow-hidden text-white text-center" style="background:linear-gradient(40deg,#03c8ac, #0976db, #9a01ee, #f61a30);">
    <div class="container mx-auto max-w-xl relative z-0">
        <h3><strong>Let’s chat.</strong></h3>
        <p class="max-w-2xl my-4 leading-normal">We want to fill the world with music! So if you’re looking to partner, inquire about media opportunities, join our team, or just want to ask a few questions -- click @if(empty($onContact) && empty($onJobs))one of the buttons @else the button @endif below to start the conversation.</p>
        @if(empty($onContact)) <a class="btn-primary btn-small text-drumeo bg-white pb-6 rounded-full text-sm tracking-widest inline-block" target="_blank" href="/contact">CONTACT US</a> @endif
        @if(empty($onJobs)) <a class="btn-primary btn-small text-drumeo bg-white pb-6 rounded-full text-sm tracking-widest inline-block" href="/careers">SEE CAREER OPENINGS</a> @endif
    </div>
</section>