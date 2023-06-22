@extends('musora._partials.layout')

@section('head-includes')
    <title>Terms Of Use | Musora</title>
    <meta property="og:title" content="Terms Of Use">
    <meta name="description" content="Please read this agreement carefully before accessing or using this web site.">
@stop

<!-- Main -->
@section('layout-body')
<section class="py-24 md:py-40 text-white text-center bg-center bg-cover" style="background-color:#1a1e58;background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/header-about.jpg);">
    <div class="container mx-auto relative z-0">
        <h1 class="text-2xl sm:text-4xl lg:text-5xl"><strong>Terms of Use</strong></h1>
    </div>
</section>
    <div class="py-12 px-3 md:px-4">
        <div class="container mx-auto">
            <p class="py-2">Welcome to the Musora community!  We are excited to help you on your musical journey.</p>

            <p class="py-2">Please read these Terms of Use ("Terms", "Terms of Use") carefully before using the www.drumeo.com website and/or the Drumeo mobile application (the "Service") operated by Musora Media Inc., (“Musora”, “us”, "we", or "our").</p>

            <p class="py-2">Your access to and use of the Service is conditioned upon your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who wish to access or use the Service either through the website or mobile application.  We want you to have an enjoyable, educational experience using the Service, so we offer a 90-day Money-Back Guarantee on all purchases made through the Service.</p>

            <p class="py-2">By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms then you do not have permission to access the Service.</p>

            {{-- Eligibility --}}
            <h3 class="font-bold md:text-2xl mt-10 mb-4">Eligibility</h3>

            <p class="py-2">To be eligible to subscribe to the Service, you must be at least eighteen (18) years old, or above the age of majority in your jurisdiction, and fill out the information necessary to create a profile.  You agree to provide true, accurate, current, and complete information about yourself as prompted by the Service registration process.  You are responsible for your own personal account activity, and you agree to notify Musora if you suspect any unauthorized activity.</p>

            <p class="py-2">By signing up for a subscription to the Service, you agree to pay the listed price at the chosen interval indefinitely until you contact us, OR use the provided tools to cancel your chosen subscription.  To request a refund please <a class="text-blue-600" href="{{ get_musora_brand_base_url() }}/contact">contact us</a>. If your subscription goes beyond our 90-Day Money-Back Guarantee period, then your subscription will terminate at the end of your paid billing cycle.  Once you choose to cancel your subscription, you will continue to have access to your subscription portion of the Service until the end of your paid billing cycle.</p>

            <p class="py-2">By signing up for a Lifetime Membership to the Service you agree to pay the listed price in full. As a Lifetime Member you have the right to use the Service under these Terms, as long as the Service is available. If at any time the Service will permanently cease to be available we will, to the best of our ability and in a reasonable time frame, provide you the means necessary to download the material available on the Service, in whole, or in part, before the Service is terminated. To request a refund please <a class="text-blue-600" href="{{ get_musora_brand_base_url() }}/contact">contact us</a> within 90 days of your purchase. Once the initial 90 day period has expired, your Lifetime Membership is valid for the life of the Service and will remain in effect for as long as the Service is available.</p>

            {{-- License to Use Services --}}
            <h3 class="font-bold md:text-2xl mt-10 mb-4">License to Use Services</h3>

            <p class="py-2">Upon successful registration, you are granted a personal use license subject to the following conditions.</p>
            <p class="py-2">You may not:</p>
            <ol class="list-decimal ml-10 py-2">
                <li><p>Sell, rent, or sub-license any material from the Services;</p></li>
                <li><p>Re-publish material from the Services (including republication on another website);</p></li>
                <li><p>Redistribute material from the Services (except for content specifically and expressly made available for redistribution);</p></li>
                <li><p>Reproduce, duplicate, copy, or otherwise exploit material from the Services for any commercial purpose;</p></li>
                <li><p>Edit or otherwise modify any material on the website; or</p></li>
                <li><p>Show any material from the Services in public.</p></li>
            </ol>

            <p class="py-2">As part of the Service, you are encouraged to record yourself playing to tracks accessed through the subscription portion of the Service.  If you upload any such video to a video hosting website (i.e. YouTube) we ask that you give accurate credit and not monetize the video.  We reserve all rights to any and all original compositions found in the Service.</p>

            {{-- User Contributions --}}
            <h3 class="font-bold md:text-2xl mt-10 mb-4">User Contributions</h3>

            <p class="py-2">Users who post materials to the Service (e.g. bulletin boards, comment feeds, etc.) agree to abide by the following rules: 1) users may not post or transmit material that is libelous, defamatory, obscene, fraudulent, harmful, threatening, abusive or hateful, that violates the property rights of others (including without limitation, the infringement of copyright, trademark, or other intellectual property rights), that violates the privacy or publicity right of others, or that is in violation of applicable laws; 2) users may not interfere with other user’s use and enjoyment of the Service; 3) users may not use this site to conduct any activity that is illegal or that violates the rights of others; 4) users may not use this site to advertise or sell products or services to others; and 5) users must immediately inform Musora if they have reason to believe that a user is infringing any copyrighted materials.  A user posting material represents that such material is unique to the user or used with permission of the copyright holder, and assigns to Musora ownership of such material.  Musora has no responsibility for the content of any material posted by users, but Musora reserves the right in its sole discretion to (i) edit or delete any posts, videos, comments, information, or other such material submitted to or appearing on this site, and (ii) refuse access to the site to any user that violates this agreement.  Bulletin boards, forum boards, message boards, and chat rooms contain the opinions and views of other users, and Musora is not responsible for the accuracy of the views and opinions expressed thereon.  </p>

            {{-- Intellectual Property --}}
            <h3 class="font-bold md:text-2xl mt-10 mb-4">Intellectual Property</h3>

            <p class="py-2">The Service and its original content, features and functionality are and will remain the exclusive property of Musora and its licensors. The Service is protected by copyright, trademark, and other laws of Canada, the United States and foreign countries. Our trademarks and trade dress may not be used in connection with any product or service without the prior written consent of Musora.</p>

            <p class="py-2">The use of this website’s content by you is strictly prohibited unless specifically permitted by these Terms of Use. Any unauthorized use may violate the copyright, trademark, and other proprietary rights of Musora and/or third parties, as well as the laws of privacy and publicity, and other regulations and statutes. Nothing contained in this Agreement or in the Site shall be construed as granting, by implication or otherwise, any license or right to use any Trademark or other proprietary information without the express written consent of Musora or third-party owner.</p>

            <p class="py-2">We respect the copyright, trademark and all other intellectual property rights of others. We have the right, but not the obligation, to remove content and accounts containing materials that we deem, in our sole discretion, to be unlawful, offensive, threatening, libelous, defamatory, pornographic, obscene or otherwise objectionable or violates any party’s intellectual property or these Terms of Use.</p>

            <p class="py-2">If you believe that your intellectual property rights are being violated and/or that any work belonging to you has been reproduced on the Site or in any content in any way, you may <a class="text-blue-600" href="{{ get_musora_brand_base_url() }}/contact">contact us</a>.  Please provide your name and contact information, the nature of your work and how it is being violated, all relevant copyright and/or trademark registration information, the location/URL of the violation, and any other information you believe is relevant.</p>

            {{-- Links to Other Web Sites --}}
            <h3 class="font-bold md:text-2xl mt-10 mb-4">Links to Other Web Sites</h3>

            <p class="py-2">Our Service may contain links to third party web sites or services that are not owned or controlled by us for convenience to you.</p>

            <p class="py-2">We have no control over, and assume no responsibility for the content, privacy policies, or practices of any third-party web sites or services. We do not warrant the offerings of any of these entities/individuals or their websites and you access and use such sites, including information, material, products and services therein, solely at your own risk.</p>

            <p class="py-2">You acknowledge and agree that Musora shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such third-party web sites or services.</p>

            <p class="py-2">We strongly advise you to read the terms and conditions and privacy policies of any third-party web sites or services that you visit.</p>

            <p class="py-2 text-blue-600"><a href="https://www.youtube.com/t/terms">YouTube Terms of Service</a></p>

            {{-- Termination --}}
            <h3 class="font-bold md:text-2xl mt-10 mb-4">Termination</h3>

            <p class="py-2">We may terminate or suspend your access to the Service immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever and without limitation, including but not limited to a breach of the Terms.</p>

            <p class="py-2">All provisions of the Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>

            {{-- Indemnification   --}}
            <h3 class="font-bold md:text-2xl mt-10 mb-4">Indemnification</h3>

            <p class="py-2">You agree to defend, indemnify and hold harmless Musora and its licensee and licensors, and their employees, contractors, agents, officers and directors, from and against any and all claims, damages, obligations, losses, liabilities, costs or debt, and expenses (including but not limited to attorney's fees), resulting from or arising out of a) your use and access of the Service, or b) a breach of these Terms.</p>

            <p class="py-2">Any registered user posting material on the site (i.e., bulletin boards, forums, chat rooms, etc) represents that such material is unique to the user or used with permission of the copyright holder, and assigns to Musora., ownership of such material.  Bulletin boards, forums, and chat rooms contain the opinions and views of the participants in those mediums, and do not necessarily reflect the opinions and views of Musora.</p>

            {{-- Limitation Of Liability   --}}
            <h3 class="font-bold md:text-2xl mt-10 mb-4">Limitation Of Liability</h3>

            <p class="py-2">In no event shall Musora, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses, resulting from (i) your access to or use of or inability to access or use the Service; (ii) any conduct or content of any third party on the Service; (iii) any content obtained from the Service; and (iv) unauthorized access, use or alteration of your transmissions or content, whether based on warranty, contract, tort (including negligence) or any other legal theory, whether or not we have been informed of the possibility of such damage, and even if a remedy set forth herein is found to have failed of its essential purpose.</p>

            {{-- Disclaimer --}}
            <h3 class="font-bold md:text-2xl mt-10 mb-4">Disclaimer</h3>

            <p class="py-2">Your use of the Service is at your sole risk. The Service is provided on an "AS IS" and "AS AVAILABLE" basis. The Service is provided without warranties of any kind, whether express or implied, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, non- infringement or course of performance.</p>

            <p class="py-2">Musora its subsidiaries, affiliates, and its licensors do not warrant that a) the Service will function uninterrupted, secure or available at any particular time or location; b) any errors or defects will be corrected; c) the Service is free of viruses or other harmful components; or d) the results of using the Service will meet your requirements.</p>

            <p class="py-2">All information (including without limitation, advice, recommendations, and tips) on the Services are intended solely as a general educational aid.  Musora and its agents assume no responsibility or liability for any consequence relating directly or indirectly to any action or inaction you take based on the information, services, tips, recommendations, or materials on the Services.</p>

            {{-- Exclusions --}}
            <h3 class="font-bold md:text-2xl mt-10 mb-4">Exclusions</h3>

            <p class="py-2">Some jurisdictions do not allow the exclusion of certain warranties or the exclusion or limitation of liability for consequential or incidental damages, so the limitations above may not apply to you.</p>

            {{-- Governing Law --}}
            <h3 class="font-bold md:text-2xl mt-10 mb-4">Governing Law</h3>

            <p class="py-2">These Terms shall be governed and construed in accordance with the laws of British Columbia and the laws of Canada applicable therein.</p>

            <p class="py-2">Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have had between us regarding the Service.</p>

            {{-- Changes --}}
            <h3 class="font-bold md:text-2xl mt-10 mb-4">Changes</h3>

            <p class="py-2">We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will provide at least 30 days’ notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.  We will do our best to keep you updated if there are any material changes made from third-party services being utilized by the Service.</p>

            <p class="py-2">By continuing to access or use our Service after any revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, you are no longer authorized to use the Service.</p>


            {{-- Contact Us --}}
            <h3 class="font-bold md:text-2xl mt-10 mb-4">Contact Us</h3>

            <p class="py-2">If you have any questions about these Terms, please <a class="text-blue-600" href="{{ get_musora_brand_base_url() }}/contact">contact us</a>.</p>
        </div>
    </div>
@stop
