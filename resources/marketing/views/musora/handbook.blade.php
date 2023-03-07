@extends('musora._partials.layout')

@section('head-includes')
    <meta name="robots" content="noindex">
    <style>
        p {
            color: #44444F;
            margin-bottom: 60px;
            line-height: 30px;
        }

        .no-mb {
            margin-bottom: 0 !important;
        }

        ul, ol {
            line-height: 30px;
            color: #44444F;
        }

        ul li:before {
            content:"·";
            font-size:20px;
            vertical-align:middle;
            line-height:30px;
            margin-right: 10px;
        }

        .header {
            font-weight: 900;
            font-size: 20px;
            padding-bottom: 10px;
        }
    </style>
@endsection

<!-- Main -->
@section('layout-body')
    <div class="max-w-3xl mx-auto py-10">
        <h1 class="font-extrabold">Employee Handbook</h1>
        <div class="inline-block w-20 border-[3px] border-black my-6"></div>
        <p class="text-[d44444F]">
            This Employee Handbook outlines some basic guidelines for all staff working at Musora Media Inc. Keep in mind, these are simply guidelines and not meant to be a strict set of rules. Occasionally, you may operate outside of these guidelines, but it’s important to use these as a baseline set of standards.
        </p>
        <div class="header">Our mission (Why does this company exist?)</div>
        <p>
            Empowering music students around the world to achieve musical freedom through our inspiring social learning communities. We do this by partnering with the best teachers, filming entertaining and educational content, hiring an amazing staff, and utilizing cutting edge web and mobile technology.
        </p>
        <div class="header">Our vision (What are we going to do?)</div>
        <p>
            To Be The #1 Music Education Company In The World!<br><br>
            We will do this by publishing online courses, books, apps, and membership websites. Our full-time staff will grow to more than 100 people and we will establish a presence in the piano, guitar, voice, bass, drum, and recording markets.
        </p>
        <div class="header">Our values (How are we going to achieve our vision?)</div>
        <p class="no-mb">
            Below are the values that guide management and employees to make decisions autonomously. This is how we prioritize new projects, make the best staff hiring decisions, and gives us a guideline on how we treat our students and staff.
        </p>
        <ol class="pl-6 mt-4 list-decimal mb-16">
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
        <div class="header">Holiday</div>
        <p>
            At Musora Media Inc we believe in taking a break from work from time to time. It’s important to get time away from the office to just recharge and connect closer with family and friends.
        </p>
        <div class="header">Schedule</div>
        <p>
            We value an autonomous work mindset and have a “Work from Wherever Just Get Your Sh*t Done” policy. Your leadership team loves working with you in the office in person. However, you are welcome to work in-office or from home. A typical work-day will be 8am - 4pm however if you need to make alternate arrangements, that can be discussed with your manager. You are welcome to work from wherever you want. We will only question the process if we’re not getting the result.
        </p>
        <div class="header">Focus</div>
        <p>
            Working on a computer all day can be tiring on the eyes and easy to get distracted. We suggest taking a quick 5-minute break or standing up to grab a glass of water if you need to. However, it’s important to stay focused and do your best to not distract other team members by talking loudly or sending random messages through chat.<br><br>
            There are exceptions to this if what you have to say is very funny. However, if it’s only a 6/10 on the funny scale you should probably wait until lunch break or after hours to discuss.<br><br>
            Personal mobile devices are fine to use during work hours, however, situations will be treated on a case-by-case basis. If a team member is on their phone too frequently, disciplinary action will be taken in the form of a public shaming.<br><br>
            Logging into social media sites like Reddit, Facebook, Instagram, and Snapchat can be a huge distraction from your main focus and Musora Media Inc’s Mission. We ask that you keep all of this activity to a minimum unless it’s in your job description or you need to check something very important.
        </p>
        <div class="header">Payroll</div>
        <p>
            All team members are paid every two weeks on Friday. This is generally done by direct deposit (Note: you must give Elizabeth a direct deposit form or VOID cheque to initiate this). For all questions relating to payroll and deductions you can email Elizabeth at: elizabeth@musora.com
        </p>
        <div class="header">Etiquette</div>
        <p>
            As the team continues to grow and improve, so should our office etiquette. Here are some tips to get you started: If you spill coffee, wipe it up. If you pee on the toilet seat, clean it up. If you see a bag of garbage in the hallway, take it to the bin. If you see someone unloading something, ask them if they’d like help. I think you get the point. If someone in your department is staying late to complete a project, you should stay late as well.
            We are a team and we succeed or fail together. Please do your best to make this a positive, clean, and friendly work environment to be a part of.
        </p>
        <div class="header">Travel</div>
        <p>
            If you are using your personal vehicle for work-related tasks, you are entitled to be paid per kilometer for when it’s being used. You will find an Employee Reimbursement form in the Asana Finance project called “FN Guides and Documents”. Fill in the number of kilometres you drove and multiply it by $.61. Finance will then reimburse you. For mileage over 5000 km the rate claimed will be $.55/km.<br><br>
            For staff members traveling out of the office for events or seminars, all travel, food, and lodging will be covered by Musora Media Inc. In the event you have to pay something from your own finances, feel free to submit an Employee Reimbursement form.
        </p>
        <div class="header">Expenses</div>
        <p>
            If you would like to make an office-related purchase you will need to make sure you have the proper approval prior to doing so. There are department credit cards so talk with your team lead to discuss the purchase.<br><br>
            If you paid for a company expense from your personal finances, please keep the receipt and submit this to Finance using the Asana Expense Reimbursement form. Any questions ask pam@drumeo.com
            All expenses must be approved.
        </p>
        <div class="header">Drinking</div>
        <p>
            We like to have fun and occasionally have a drink during office hours. Please do not drink an excessive amount that will cause you to negatively impact your work performance.<br><br>
            If you would like to partake after work hours, it’s extremely important that each staff member secure a ride home with a sober driver, or find alternate transportation. If driving after drinking happens we will be forced to remove the alcohol from the premises (please don’t be the one that ruins it for everyone!)
        </p>
        <div class="header">Deadlines</div>
        <p>
            Setting deadlines is extremely important in how a business operates. It allows each department to stay on track and continue to grow and reach our mission of reaching every musician in the world.<br><br>
            If a deadline for a project is set at a specific date, you are required to meet or exceed that deadline. If this is not possible, you must talk in person with management and find an alternate solution.<br><br>
            Also, we encourage you to do your best to be part of the conversation when setting deadlines. We like to set realistic but challenging deadlines as this ensures that every department is constantly challenged to improve and be the best they can be.
        </p>
        <div class="header">Overtime</div>
        <p class="no-mb">
            Occasionally, overtime is necessary in order to meet deadlines. If your project requires you to put in extra time, please follow procedure PCPR01A.  Among other things this procedure explains:
        </p>
        <ul class="pl-6 mt-4 mb-16">
            <li>Overtime is time worked in excess of 8 hours a day or PCPR01A40 hours a week</li>
            <li>Overtime can be banked or paid at 1.5 x your regular pay</li>
            <li>Overtime must be tracked using the process described in the said procedure.</li>
        </ul>
        <div class="header">Communication</div>
        <p>
            Inter-office communications are managed through Asana and Slack. Upon starting at Musora Media Inc, you will get a branded email address, as well as invites to Asana and Slack. Please browse around the different projects within the project management system (Asana) to familiarize yourself with the standard operating procedures.<br><br>
            If you have a quick question to ask someone, feel free to use Slack. However, it is important to not overuse this as it can be a distraction for yourself as well as other team members.
        </p>
        <div class="header">Statutory Holidays</div>
        <p class="no-mb">
            Below is a list of Musora Media’s statutory holidays.
        </p>
        <ul class="mb-16 pl-6 mt-4">
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
        <div class="header"></div>
        <p>

        </p>
        <div class="header"></div>
        <p>

        </p>
        <div class="header"></div>
        <p>

        </p>
        <div class="header"></div>
        <p>

        </p>
    </div>
@stop
