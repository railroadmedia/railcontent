@extends('musora._partials.layout')

@section('head-includes')
    <meta name="robots" content="noindex">

    <title>Employee Handbook | Musora</title>
    <meta property="og:title" content="Employee Handbook | Musora">

    <meta name="description" content="This Employee Handbook outlines some basic guidelines for all staff working at Musora Media Inc.">
    <meta property="og:description" content="This Employee Handbook outlines some basic guidelines for all staff working at Musora Media Inc.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://musora-center.s3.amazonaws.com/homepage/2021/share-image.jpg">

    <style>
        html {
            scroll-behavior: smooth;
        }

        .handbook p {
            color: #44444F;
            /*margin-bottom: 60px;*/
            line-height: 30px;
        }

        .anchor {
            padding-bottom: 56px;
        }


        .no-mb {
            margin-bottom: 0 !important;
        }

        .handbook ul,
        .handbook  ol {
            line-height: 30px;
            color: #44444F;
        }

        .header {
            font-weight: 900;
            font-size: 20px;
            padding-bottom: 10px;
        }

        @media (min-width: 767px) {
            .nav-space {
                width: 160px;
                min-width: 160px;
            }
        }

        @media (min-width: 1024px) {
            .nav-space {
                width: 215px;
                min-width: 215px;
            }
        }

        @media (min-width: 1280px) {
            .nav-space {
                width: 256px;
                min-width: 256px;
            }
        }
    </style>
@endsection

@section('body-data')
    x-data ='{
        navOpen: false,
    }'
@endsection

<!-- Main -->
@section('layout-body')
    <div class="md:flex">
        <div class="nav-space hidden md:block bg-[#020815]"></div>
        <div class="bg-[#020815] text-white flex flex-col px-5 lg:pl-14 lg:pr-10 py-5 fixed w-full md:w-auto transition-all duration-200 ease-in-out z-10">
            <div class="flex justify-between items-center" @click="navOpen = !navOpen">
                <b class="text-[#888888] uppercase text-sm">Index</b>
                <i class="fa-sharp fa-solid fa-chevron-down md:hidden text-[#888888] transition-all duration-200" :class="navOpen && 'rotate-180'"></i>
            </div>
            <hr class="border-[#888888] mt-2 mb-6 w-28 xl:w-40 hidden md:block" />
            <div x-cloak
                 class="hidden md:flex flex-col text-left h-auto translate-y-0 overflow-hidden"
            >
                <a class="py-0 md:mb-4 hover:opacity-80" href="#holiday">Holiday</a>
                <a class="py-0 md:mb-4 hover:opacity-80" href="#schedule">Schedule</a>
                <a class="py-0 md:mb-4 hover:opacity-80" href="#focus">Focus</a>
                <a class="py-0 md:mb-4 hover:opacity-80" href="#payroll">Payroll</a>
                <a class="py-0 md:mb-4 hover:opacity-80" href="#etiquette">Etiquette</a>
                <a class="py-0 md:mb-4 hover:opacity-80" href="#travel">Travel</a>
                <a class="py-0 md:mb-4 hover:opacity-80" href="#expenses">Expenses</a>
                <a class="py-0 md:mb-4 hover:opacity-80" href="#drinking">Drinking</a>
                <a class="py-0 md:mb-4 hover:opacity-80" href="#deadlines">Deadlines</a>
                <a class="py-0 md:mb-4 hover:opacity-80" href="#overtime">Overtime</a>
                <a class="py-0 md:mb-4 hover:opacity-80" href="#communication">Communication</a>
                <a class="py-0 md:mb-4 hover:opacity-80" href="#statutory">Statutory</a>
                <a class="py-0 md:mb-4 hover:opacity-80" href="#leadership">Management</a>
                <a class="py-0 md:mb-4 hover:opacity-80" href="#meetings">Meetings</a>
                <a class="py-0 md:mb-4 hover:opacity-80" href="#thankyou">Thank You</a>
            </div>
            <div x-cloak
                 class="flex md:hidden flex-col text-center overflow-hidden transition-all duration-200 ease-in-out"
                 :class="navOpen ? 'visible -translate-y-0 max-h-full opacity-1' : 'invisible -translate-y-8 max-h-0 opacity-0'"
            >
                <a class="py-2" href="#holiday">Holiday</a>
                <a class="py-2" href="#schedule">Schedule</a>
                <a class="py-2" href="#focus">Focus</a>
                <a class="py-2" href="#payroll">Payroll</a>
                <a class="py-2" href="#etiquette">Etiquette</a>
                <a class="py-2" href="#travel">Travel</a>
                <a class="py-2" href="#expenses">Expenses</a>
                <a class="py-2" href="#drinking">Drinking</a>
                <a class="py-2" href="#deadlines">Deadlines</a>
                <a class="py-2" href="#overtime">Overtime</a>
                <a class="py-2" href="#communication">Communication</a>
                <a class="py-2" href="#statutory">Statutory</a>
                <a class="py-2" href="#leadership">Management</a>
                <a class="py-2" href="#meetings">Meetings</a>
                <a class="py-2" href="#thankyou">Thank You</a>
            </div>
        </div>
        <div class="max-w-3xl mx-auto pt-20 pb-10 md:py-10 handbook md:px-6">
            <div class="px-4 md:px-0">
                <h1 class="font-extrabold">Employee Handbook</h1>
                <div class="inline-block w-20 border-[3px] border-black my-6"></div>
                <p class="text-[d44444F] no-mb">
                    This Employee Handbook outlines some basic guidelines for all staff working at Musora Media Inc. Keep in mind, these are simply guidelines and not meant to be a strict set of rules. Occasionally, you may operate outside of these guidelines, but it’s important to use these as a baseline set of standards.
                </p>
            </div>
            <img class="hidden sm:inline-block mt-6 mb-16" src="https://d3fzm1tzeyr5n3.cloudfront.net/handbook/collage-header.png" alt="header img" />
            <img class="sm:hidden mt-6 mb-16" src="https://d3fzm1tzeyr5n3.cloudfront.net/handbook/collage-header-m.png" alt="header img" />
            <div class="px-4 md:px-0">
                <div class="header">Our mission (Why does this company exist?)</div>
                <p class="mb-14">
                    Empowering music students around the world to achieve musical freedom through our inspiring social learning communities. We do this by partnering with the best teachers, filming entertaining and educational content, hiring an amazing staff, and utilizing cutting edge web and mobile technology.
                </p>
                <div class="header">Our vision (What are we going to do?)</div>
                <p class="mb-14">
                    To Be The #1 Music Education Company In The World!<br><br>
                    We will do this by publishing online courses, books, apps, and membership websites. Our full-time staff will grow to more than 100 people and we will establish a presence in the piano, guitar, voice, bass, drum, and recording markets.
                </p>
                <div class="header">Our values (How are we going to achieve our vision?)</div>
                <p class="no-mb">
                    Below are the values that guide management and employees to make decisions autonomously. This is how we prioritize new projects, make the best staff hiring decisions, and gives us a guideline on how we treat our students and staff.
                </p>
                <ol class="pl-6 mt-4 list-decimal no-mb">
                    <li>We believe that all of our students should be treated like family members.</li>
                    <li>We believe that staff should love what they do, even if it means not working here.</li>
                    <li>We believe that staff should always keep pushing, in our successes and failures.</li>
                    <li>We believe in sticking to deadlines and will work extra hours to get the job done right.</li>
                    <li>We believe in connecting with our students, regardless of whether they’ve paid us or not.</li>
                    <li>We believe that strong relationships are more important than powerful technology.</li>
                    <li>We believe that every day is an opportunity to do a better job than the previous day.</li>
                    <li>We believe that music education can have a positive effect on people’s lives.</li>
                    <li>We believe in an open door policy; staff and instructors should be approachable.</li>
                    <li>We believe in a clean workspace, even if we have to clean up someone else’s mess.</li>
                </ol>
            </div>
            <img class="mt-6" src="https://d3fzm1tzeyr5n3.cloudfront.net/handbook/collage-1.png" alt="collage 1" />
            <div class="px-4 md:px-0">
                <div id="holiday" class="anchor"></div>
                <div class="header">Holiday</div>
                <p>
                    At Musora Media Inc we believe in taking a break from work from time to time. It’s important to get time away from the office to just recharge and connect closer with family and friends.
                </p>
                <div id="schedule" class="anchor"></div>
                <div class="header">Schedule</div>
                <p>
                    We value an autonomous work mindset and have a “Work from Wherever Just Get Your Sh*t Done” policy. Your leadership team loves working with you in the office in person. However, you are welcome to work in-office or from home. A typical work-day will be 8am - 4pm however if you need to make alternate arrangements, that can be discussed with your manager. You are welcome to work from wherever you want. We will only question the process if we’re not getting the result.
                </p>
                <div id="focus" class="anchor"></div>
                <div class="header">Focus</div>
                <p>
                    Working on a computer all day can be tiring on the eyes and easy to get distracted. We suggest taking a quick 5-minute break or standing up to grab a glass of water if you need to. However, it’s important to stay focused and do your best to not distract other team members by talking loudly or sending random messages through chat.<br><br>
                    There are exceptions to this if what you have to say is very funny. However, if it’s only a 6/10 on the funny scale you should probably wait until lunch break or after hours to discuss.<br><br>
                    Personal mobile devices are fine to use during work hours, however, situations will be treated on a case-by-case basis. If a team member is on their phone too frequently, disciplinary action will be taken in the form of a public shaming.<br><br>
                    Logging into social media sites like Reddit, Facebook, Instagram, and Snapchat can be a huge distraction from your main focus and Musora Media Inc’s Mission. We ask that you keep all of this activity to a minimum unless it’s in your job description or you need to check something very important.
                </p>
                <div id="payroll" class="anchor"></div>
                <div class="header">Payroll</div>
                <p>
                    All team members are paid every two weeks on Friday. This is generally done by direct deposit (Note: you must give Elizabeth a direct deposit form or VOID cheque to initiate this). For all questions relating to payroll and deductions you can email Elizabeth at: elizabeth@musora.com
                </p>
                <div id="etiquette" class="anchor"></div>
                <div class="header">Etiquette</div>
                <p class="no-mb">
                    As the team continues to grow and improve, so should our office etiquette. Here are some tips to get you started: If you spill coffee, wipe it up. If you pee on the toilet seat, clean it up. If you see a bag of garbage in the hallway, take it to the bin. If you see someone unloading something, ask them if they’d like help. I think you get the point. If someone in your department is staying late to complete a project, you should stay late as well.
                    We are a team and we succeed or fail together. Please do your best to make this a positive, clean, and friendly work environment to be a part of.
                </p>
            </div>
            <img class="mt-6" src="https://d3fzm1tzeyr5n3.cloudfront.net/handbook/collage-2.png" alt="collage 2" />
            <div class="px-4 md:px-0">
                <div id="travel" class="anchor"></div>
                <div class="header">Travel</div>
                <p>
                    If you are using your personal vehicle for work-related tasks, you are entitled to be paid per kilometer for when it’s being used. You will find an Employee Reimbursement form in the Asana Finance project called “FN Guides and Documents”. Fill in the number of kilometres you drove and multiply it by $.61. Finance will then reimburse you. For mileage over 5000 km the rate claimed will be $.55/km.<br><br>
                    For staff members traveling out of the office for events or seminars, all travel, food, and lodging will be covered by Musora Media Inc. In the event you have to pay something from your own finances, feel free to submit an Employee Reimbursement form.
                </p>
                <div id="expenses" class="anchor"></div>
                <div class="header">Expenses</div>
                <p>
                    If you would like to make an office-related purchase you will need to make sure you have the proper approval prior to doing so. There are department credit cards so talk with your team lead to discuss the purchase.<br><br>
                    If you paid for a company expense from your personal finances, please keep the receipt and submit this to Finance using the Asana Expense Reimbursement form. Any questions ask pam@drumeo.com
                    All expenses must be approved.
                </p>
                <div id="drinking" class="anchor"></div>
                <div class="header">Drinking</div>
                <p>
                    We like to have fun and occasionally have a drink during office hours. Please do not drink an excessive amount that will cause you to negatively impact your work performance.<br><br>
                    If you would like to partake after work hours, it’s extremely important that each staff member secure a ride home with a sober driver, or find alternate transportation. If driving after drinking happens we will be forced to remove the alcohol from the premises (please don’t be the one that ruins it for everyone!)
                </p>
                <div id="deadlines" class="anchor"></div>
                <div class="header">Deadlines</div>
                <p>
                    Setting deadlines is extremely important in how a business operates. It allows each department to stay on track and continue to grow and reach our mission of reaching every musician in the world.<br><br>
                    If a deadline for a project is set at a specific date, you are required to meet or exceed that deadline. If this is not possible, you must talk in person with management and find an alternate solution.<br><br>
                    Also, we encourage you to do your best to be part of the conversation when setting deadlines. We like to set realistic but challenging deadlines as this ensures that every department is constantly challenged to improve and be the best they can be.
                </p>
                <div id="overtime" class="anchor"></div>
                <div class="header">Overtime</div>
                <p class="no-mb">
                    Occasionally, overtime is necessary in order to meet deadlines. If your project requires you to put in extra time, please follow procedure PCPR01A.  Among other things this procedure explains:
                </p>
                <ul class="pl-6 mt-4 list-disc">
                    <li>Overtime is time worked in excess of 8 hours a day or PCPR01A40 hours a week</li>
                    <li>Overtime can be banked or paid at 1.5 x your regular pay</li>
                    <li>Overtime must be tracked using the process described in the said procedure.</li>
                </ul>
            </div>
            <img class="mt-6" src="https://d3fzm1tzeyr5n3.cloudfront.net/handbook/collage-3.png" alt="collage 3" />
            <div class="px-4 md:px-0">
                <div id="communication" class="anchor"></div>
                <div class="header">Communication</div>
                <p>
                    Inter-office communications are managed through Asana and Slack. Upon starting at Musora Media Inc, you will get a branded email address, as well as invites to Asana and Slack. Please browse around the different projects within the project management system (Asana) to familiarize yourself with the standard operating procedures.<br><br>
                    If you have a quick question to ask someone, feel free to use Slack. However, it is important to not overuse this as it can be a distraction for yourself as well as other team members.
                </p>
                <div id="statutory" class="anchor"></div>
                <div class="header">Statutory Holidays</div>
                <p class="no-mb">
                    Below is a list of Musora Media’s statutory holidays.
                </p>
                <ul class="mb-4 pl-6 mt-4 list-disc">
                    <li>New Year's Day (January)</li>
                    <li>Family Day (February)</li>
                    <li>Good Friday (April)</li>
                    <li>Victoria Day (May)</li>
                    <li>Canada Day (July)</li>
                    <li>British Columbia Day (August) </li>
                    <li>Labour Day (September)</li>
                    <li>National Truth and Reconciliation Day (September 30)</li>
                    <li>Thanksgiving Day (October)</li>
                    <li>Remembrance Day (November)</li>
                    <li>Christmas Day (December)</li>
                    <li>Boxing Day (December) (although Boxing day is not technically a statutory holiday, we treat it like it is)</li>
                </ul>
                <p class="no-mb">
                    Please read guidelines outlined in procedure PCPR01A.  Among other things, this procedure explains:
                </p>
                <ul class="pl-6 mt-4 list-disc">
                    <li>All employees who have been employed for the 30 calendar days prior to the stat and have worked 15 of the 30 days are entitled to a day off with pay for statutory holidays in BC plus National Truth and Reconciliation Day and Boxing Day. </li>
                </ul>
                <div id="leadership" class="anchor"></div>
                <div class="header">Leadership</div>
                <p class="no-mb">
                    Our leadership team can always help you when needed. I would encourage you to not bother them repeatedly throughout the day, but prepare a shortlist of questions and request a meeting time to go over any items on the list.
                </p>
                <ul class="mb-16 pl-2 sm:pl-6 mt-4 list-disc">
                    <li><div class="flex justify-between"><span>Jared Falk</span><div class="flex justify-between sm:w-2/3 flex-col sm:flex-row leading-snug mb-4 sm:mb-0 text-right sm:text-left"><span>President/CEO</span><span>jared@musora.com</span></div></div></li>
                    <li><div class="flex justify-between"><span>James Falk</span><div class="flex justify-between sm:w-2/3 flex-col sm:flex-row leading-snug mb-4 sm:mb-0 text-right sm:text-left"><span>Chief Operating Officer</span><span>jame@musora.com</span></div></div></li>
                    <li><div class="flex justify-between"><span>Dave Atkinson</span><div class="flex justify-between sm:w-2/3 flex-col sm:flex-row leading-snug mb-4 sm:mb-0 text-right sm:text-left"><span>Chief Community Officer</span><span>dave@musora.com</span></div></div></li>
                    <li><div class="flex justify-between"><span>Chad Kettner</span><div class="flex justify-between sm:w-2/3 flex-col sm:flex-row leading-snug mb-4 sm:mb-0 text-right sm:text-left"><span>Chief Marketing Officer</span><span>chad@musora.com</span></div></div></li>
                    <li><div class="flex justify-between"><span>Caleb Favor</span><div class="flex justify-between sm:w-2/3 flex-col sm:flex-row leading-snug mb-4 sm:mb-0 text-right sm:text-left"><span>Chief Technology Officer</span><span>caleb@musora.com</span></div></div></li>
                    <li><div class="flex justify-between"><span>Victor Guidera</span><div class="flex justify-between sm:w-2/3 flex-col sm:flex-row leading-snug mb-4 sm:mb-0 text-right sm:text-left"><span>Production & Technology Director</span><span>victor@musora.com</span></div></div></li>
                    <li><div class="flex justify-between"><span>Jordan Paul</span><div class="flex justify-between sm:w-2/3 flex-col sm:flex-row leading-snug mb-4 sm:mb-0 text-right sm:text-left"><span>Creative Director</span><span>jord@musora.com</span></div></div></li>
                    <li><div class="flex justify-between"><span>Amy Malcolmson</span><div class="flex justify-between sm:w-2/3 flex-col sm:flex-row leading-snug mb-4 sm:mb-0 text-right sm:text-left"><span>Student Experience Director</span><span>amy@musora.com</span></div></div></li>
                    <li><div class="flex justify-between"><span>Pam Black</span><div class="flex justify-between sm:w-2/3 flex-col sm:flex-row leading-snug mb-4 sm:mb-0 text-right sm:text-left"><span>Controller</span><span>pam@musora.com</span></div></div></li>
                    <li><div class="flex justify-between"><span>Mary-Liz Borseth</span><div class="flex justify-between sm:w-2/3 flex-col sm:flex-row leading-snug mb-4 sm:mb-0 text-right sm:text-left"><span>People & Culture Manager</span><span>mary-liz@musora.com</span></div></div></li>
                </ul>
                <div id="meetings" class="anchor"></div>
                <div class="header">Meetings</div>
                <p>
                    Meetings can be a productive time for staff members to get together, collaborate, and be creative. They are crucial to the success of our Mission. However, they can also be a quick way to waste lots of combined staff hours.<br><br>
                    In order to book a meeting, please follow this process. In summary, you must plan your meeting date, time, attendees, and agenda. The staff member who books the meeting is the host.<br><br>
                    When booking a meeting, if you require the boardroom please follow this process.
                </p>
                <div id="thankyou" class="anchor"></div>
                <div class="header">Thank you</div>
                <p class="mb-14">
                    Lastly, I want to say thank you for reading this. I’m happy and surprised you made it all the way through. As your feared, fearful, and fearless leader, I hope I do a good job of making you love getting up in the morning and coming to work at Musora Media Inc. It’s my personal goal that you love coming to work, after all, most of us spend almost ⅓ of our lives working, we might as well enjoy it.<br><br>
                    It’s also my goal to help you succeed at doing something you love. Whether that is at Musora Media Inc or somewhere else, it doesn’t matter to me. What matters is that you are happy. I know what it’s like to hate a job and I know what it’s like to love one. I love this job and I want you to love coming to hang out here as well. If you ever feel like you don’t love your job anymore, please come talk to me, I will help find a solution.<br><br>
                    Lastly, we have the opportunity to do amazing things and actually effect change in people’s lives - that’s pretty incredible. So I don’t take that responsibility lightly and I want to make sure that I am building a team of “A” players to get the work done. Always try to be an “A” player, play your hardest, play to dominate, and most importantly, always have fun!
                </p>
                <div class="text-right">
                    <img class="filter invert h-20 sm:h-28 -mt-10" src="https://dpwjbsxqtam5n.cloudfront.net/books/drummers-toolbox/sales/signature.png" alt="jareds signature">
                </div>
            </div>
        </div>
    </div>
@stop
