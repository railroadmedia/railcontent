@extends('partials.layout')

@section('meta')
    <title>Student Experience Studies | Musora</title>
@endsection

@section('content')
    <header class="tw-relative tw-bg-black tw-p-8">
        <!-- BG Image -->
        <img src="" 
            class="tw-transition-opacity tw-absolute tw-top-0 tw-left-0 tw-object-cover tw-object-top tw-h-full tw-w-full" 
            loading="lazy"
            onload="this.classList.remove('tw-opacity-0')"
        >
        <section class="tw-max-w-screen-lg tw-w-full tw-mx-auto tw-flex tw-flex-col sm:tw-flex-row tw-items-center">
            <img src="" title="Image of musical instruments" class="tw-w-[300px] sm:tw-mr-4">
            <!-- content -->
            <div class="tw-z-10">
                <h1 class="tw-text-3xl tw-mb-2 tw-text-[#9EC0DC] tw-font-semibold">Sign Up for Musora Student Experience Studies and get rewarded with free platform time</h1>
                <p class="tw-text-lg tw-text-white">Help us to test new student experiences and make our platforms even better.
                    Students selected to participate in studies will be rewarded with monthly passes.
                    Have questions? <a href="mailto:learning@musora.com" class="tw-font-bold tw-text-white">Get in touch.</a>
                </p>
            </div>
        </section>
    </header>
    <main class="tw-w-full tw-max-w-screen-md tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-10 dark:tw-text-white tw-flex tw-justify-center">
        {{-- Form Wrapper --}}
        <section id="stc-form-wrapper" class="tw-mb-12">
            <div class="tw-text-center tw-mb-4">
                <h2 class="tw-mb-1 tw-text-3xl tw-font-bold">Enrollment Questionnaire</h2>
                <p>Please fill our the enrollment questionaire to be considered for studies</p>
            </div>

            <form action="" method="post" class="tw-flex tw-flex-col" id="stc-form">
                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Name</span>
                    <input id="name" type="text" name="name" autocomplete="name" class="tw-bg-transparent tw-rounded-full"/>
                </label>

                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Email</span>
                    <input id="email" type="email" name="email" autocomplete="email"  class="tw-bg-transparent tw-rounded-full"/>
                </label>

                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Age</span>
                    <select name="age" id="age" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($ages as $age)
                            <option class="bg-white text-black" value="{{ $age['value'] }}">{{ $age['value'] }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Gender</span>
                    <select name="gender" id="gender" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($genders as $gender)
                            <option class="bg-white text-black" value="{{ $gender['value'] }}">{{ $gender['value'] }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Country</span>
                    <select name="country" id="country" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($countries as $country)
                            <option class="bg-white text-black" value="{{ $country['value'] }}">{{ $country['value'] }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Spoken Languages<span>*</span></span>
                    <select name="language" id="language" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($languages as $language)
                            <option class="bg-white text-black" value="{{ $language['value'] }}">{{ $language['value'] }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Current Student Level</span>
                    <select name="level" id="level" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($levels as $level)
                            <option class="bg-white text-black" value="{{ $level['value'] }}">{{ $level['value'] }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Primary Instrument</span>
                    <select name="instrument" id="instrument" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($instruments as $instrument)
                            <option class="bg-white text-black" value="{{ $instrument['value'] }}">{{ $instrument['value'] }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Primary Learning Goal</span>
                    <select name="goal" id="goal" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($goals as $goal)
                            <option class="bg-white text-black" value="{{ $goal['value'] }}">{{ $goal['value'] }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="tw-flex tw-flex-col tw-mb-2">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">For how long have you been a Musora student?</span>
                    <select name="student-length" id="student-length" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($experience as $year)
                            <option class="bg-white text-black" value="{{ $year['value'] }}">{{ $year['value'] }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="tw-flex tw-flex-col tw-mb-6">
                    <span class="tw-m-2 tw-font-bold tw-leading-0">Membership Type</span>
                    <select name="type" id="type" class="tw-bg-transparent tw-rounded-full">
                        <option value="" class="bg-white text-black">Select</option>
                        @foreach($types as $type)
                            <option class="bg-white text-black" value="{{ $type['value'] }}">{{ $type['value'] }}</option>
                        @endforeach
                    </select>
                </label>

                <p class="tw-text-sm tw-mb-2">Please select all languages in which you have a native or near-native proficiency <div><i></i></div> </p>

                <label class="tw-mb-6">
                    <input class="tw-mr-2 tw-rounded dark:tw-border-[#445F74] tw-border-[#D1D5DB] checked:tw-bg-black dark:checked:tw-bg-[#002039] dark:tw-bg-[#002039] tw-bg-[#E7EFF6]" 
                            type="checkbox" 
                            id="consent" 
                            name="consent"
                    >
                    <span class="tw-text-sm">I consent to be occasionally contacted to participate in User Research Studies or interviews dedicated to
                        collecting feedback or improving Musora products and services. 
                    </span>
                </label>

                <input disabled 
                        type="submit"
                        value="Submit"
                        class="disabled:tw-opacity-70 tw-btn tw-btn-primary dark:tw-bg-white dark:tw-text-black tw-bg-black tw-text-white"   
                />
            </form>
        </section>
        
        {{-- Thank you Wrapper --}}
        <section id="stc-confirmation" class="tw-hidden">
            <h2>Thank You For Your Interest!</h2>
            <p>We have received your information and will be in touch <br>
                when the next User Study is scheduled.
            <p>
        </section>
    </main>
@endsection

    {{-- Vanilla JS --}}
@section('layout-scripts')
    <script>

    </script>
@endsection