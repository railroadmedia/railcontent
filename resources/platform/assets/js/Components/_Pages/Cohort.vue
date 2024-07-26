<template>
    <header class="tw-bg-[#F1F7FE] tw-py-4 md:tw-py-7 tw-px-4">
        <div class="tw-max-w-5xl tw-mx-auto tw-relative">
            <div class="2xl:tw-absolute 2xl:tw-top-0 2xl:-tw-left-28 tw-mb-3 md:tw-mb-6 2xl:tw-mb-0">
                <button class="tw-bg-[rgba(0,12,23,0.40)] hover:tw-bg-[rgba(0,12,23,0.80)] tw-py-1 tw-px-2.5 tw-text-white tw-rounded-full" onclick="history.back()">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </div>
            <div class="md:tw-flex tw-items-center tw-gap-6 tw-mb-12 tw-text-center md:tw-text-left">
                <div class="md:tw-flex-1">
                    <!--  Header logo  -->
                    <img class="tw-h-20 sm:tw-h-20 lg:tw-h-28 tw-mb-2 tw-inline-block " alt="header logo" :src="`https://www.musora.com/musora-cdn/image/width=440,quality=95/${ cohort['light_mode_logo'] }`" />
                    <!--  Headline  -->
                    <h1 class="tw-font-extrabold tw-text-3xl lg:tw-text-4xl">{{ cohort['headline'] }}</h1>
                    <!--  Subheadline  -->
                    <h2 class="tw-font-normal tw-text-2xl lg:tw-text-3xl">{{ cohort['subheadline'] }}</h2>
                    <!--  Header description  -->
                    <p class="tw-font-bold tw-mt-4 lg:tw-mt-6 tw-mb-2">{{ cohort['header_description'] }}</p>
                    <!-- Benefits -->
                    <div class="tw-mb-7 lg:tw-mb-9 tw-flex tw-justify-between sm:tw-justify-center md:tw-justify-start tw-max-w-md sm:tw-max-w-none tw-mx-auto">
                        <div class="md:tw-flex sm:tw-mr-4 md:tw-mr-2">
                            <i :class="`fas fa-check tw-text-${brand} tw-mt-1 tw-mr-1`" aria-hidden="true"></i><br class="md:tw-hidden"> <span class="tw-text-sm">{{ cohort['benefit_1'] }}</span>
                        </div>
                        <div class="md:tw-flex sm:tw-mr-4 md:tw-mr-2 tw-px-2 sm:tw-px-0">
                            <i :class="`fas fa-check tw-text-${brand} tw-mt-1 tw-mr-1`" aria-hidden="true"></i><br class="md:tw-hidden"> <span class="tw-text-sm">{{ cohort['benefit_2'] }}</span>
                        </div>
                        <div class="md:tw-flex"><i :class="`fas fa-check tw-text-${brand} tw-mt-1 tw-mr-1`" aria-hidden="true"></i><br class="md:tw-hidden"> <span class="tw-text-sm">{{ cohort['benefit_3'] }}</span></div>
                    </div>
                    <!--  Mobile Header Image -->
                    <div class="tw-relative md:tw-hidden">
                        <img
                            class="tw-rounded-xl tw-mb-6"
                            :src="`https://www.musora.com/musora-cdn/image/width=850,quality=95/${cohort['header_image_url']}`"
                            alt="header thumb"
                        />
                        <div class="tw-absolute tw-bottom-4 tw-left-4 tw-bg-white tw-rounded-full tw-uppercase tw-font-bebas-neue tw-px-5 tw-py-1 tw-flex tw-items-center tw-cursor-pointer" @click="openTrailer = true">
                            <i class="fas fa-play tw-mr-2" aria-hidden="true"></i> <div class="tw-mt-1">Watch Trailer</div>
                        </div>
                    </div>
                    <div :class="`md:tw-flex ${isEnrolled ? 'md:tw-items-start' : 'md:tw-items-center'}`">
                        <!--  Enrolled Buttons  -->
                        <div v-if="isEnrolled" class="tw-w-full md:tw-w-1/2 md:tw-mr-2 tw-text-center">
                            <span class="tw-btn-primary tw-bg-[#65656B] tw-w-full tw-text-white tw-cursor-default">YOU'RE ENROLLED!</span>
                            <a :href="cohort['course_url']" class="tw-text-[#65656B] tw-underline tw-italic tw-text-sm tw-inline-block tw-mb-2 md:tw-mb-0">View the course now!</a>
                        </div>
                        <template v-else>
                            <!--  Enroll now Button  -->
                            <button v-if="!hasEnded" @click="enroll()" :class="`tw-btn-primary tw-bg-${brand} tw-w-full md:tw-w-1/2 md:tw-mr-2 tw-max-w-[415px] tw-mb-5 md:tw-mb-0 hover:tw-bg-${brand}-600`">Enroll Now</button>
                            <!--  Closed Button  -->
                            <span v-else class="tw-btn-primary tw-bg-[#65656B] tw-w-full md:tw-w-1/2 md:tw-mr-2 tw-text-white">Enrollment Closed</span>
                        </template>

                        <div class="md:tw-w-1/2 tw-flex tw-items-center tw-justify-center md:tw-justify-start" :class="{ 'md:tw-mt-2': isEnrolled}">
                            <img
                                class="tw-h-8 md:tw-h-6 tw-mr-1"
                                src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/joined_profiles.png"
                                alt="joined student profiles"
                            />
                            <p class="tw-text-xs tw-align-middle tw-max-w-[180px] md:tw-max-w-full tw-text-left">
                                Join {{ nPackOwners }} {{ joinText }}
                                who have already registered.
                            </p>
                        </div>
                    </div>
                </div>
                <!--  Tablet/Desktop Header Image  -->
                <div class="md:tw-flex-1 tw-hidden md:tw-block tw-relative">
                    <img
                        class="tw-rounded-xl"
                        :src="`https://www.musora.com/musora-cdn/image/width=850,quality=95/${cohort['header_image_url']}`"
                        alt="header thumb"
                    />
                    <div class="tw-absolute tw-bottom-4 tw-left-4 tw-bg-white tw-rounded-full tw-uppercase tw-font-bebas-neue tw-px-5 tw-py-1 tw-flex tw-items-center tw-cursor-pointer" @click="openTrailer = true"><i class="fas fa-play tw-mr-2" aria-hidden="true"></i> <div class="tw-mt-1">Watch Trailer</div></div>
                </div>
            </div>
            <div class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-text-center tw-border tw-rounded-lg tw-border-gray-300 tw-mb-2 lg:tw-mb-4">
                <div class="tw-w-full sm:tw-w-auto tw-border-b sm:tw-border-b-0 sm:tw-border-r tw-border-gray-300 tw-py-4 sm:tw-py-3 lg:tw-py-4">
                    <p class="tw-tracking-wide tw-opacity-70 tw-text-sm">STARTS ON</p>
                    <h4 class="tw-px-3 lg:tw-px-5"><strong>{{ startDateText }}</strong></h4>
                    <hr class="tw-border-gray-300 tw-my-4 sm:tw-my-2 lg:tw-my-4">
                    <p class="tw-text-sm tw-px-3 lg:tw-px-5">
                        <!-- Countdown -->
                        <template v-if="countdownText">
                            Enrollment closes in <span class="tw-text-pianote">{{ countdownText }}</span>
                        </template>
                        <template v-else>
                            <span class="tw-text-pianote">Enrollment closed</span>
                        </template>
                    </p>
                </div>
                <!--  Icons/Title/Copies  -->
                <div class="tw-flex tw-items-center sm:tw-justify-center sm:tw-flex-grow">
                    <div class="tw-flex tw-flex-wrap tw-justify-evenly tw-w-full sm:tw-w-auto tw-py-4 sm:tw-py-3 lg:tw-py-4 tw-text-left sm:tw-text-center">
                        <div class="tw-flex sm:tw-flex-col sm:tw-flex-1 tw-w-full sm:tw-w-1/3 tw-px-4 sm:tw-px-3 tw-mb-4 sm:tw-mb-0">
                            <div class="tw-text-center">
                                <i :class="`far fa-fw fa-calendar-day tw-mr-3 sm:tw-mr-0 tw-text-${brand} tw-text-3xl sm:tw-mb-1`" aria-hidden="true"></i>
                            </div>
                            <!--                            <img-->
                            <!--                                class="tw-mr-3 tw-h-[30px] sm:tw-mb-1 sm:tw-mx-auto"-->
                            <!--                                alt="icon 1"-->
                            <!--                                src="https://www.musora.com/musora-cdn/image/width=60,quality=95/{{ $cohort['icon1_url'] }}"-->
                            <!--                                loading="lazy"-->
                            <!--                                onload="this.classList.remove('tw-opacity-0')"-->
                            <!--                            />-->
                            <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">{{ cohort['icon1_title'] }}</strong><br>
                                <span class="tw-text-sm">{{ cohort['icon1_copy'] }}</span></p>
                        </div>
                        <div class="tw-flex sm:tw-flex-col sm:tw-flex-1 tw-w-full sm:tw-w-1/3 tw-px-4 sm:tw-px-3 tw-mb-4 sm:tw-mb-0">
                            <div class="tw-text-center">
                                <i :class="`far fa-fw fa-clock tw-mr-3 sm:tw-mr-0 tw-text-${brand} tw-text-3xl sm:tw-mb-1`" aria-hidden="true"></i>
                            </div>
                            <!--                            <img-->
                            <!--                                class="tw-mr-3 tw-h-[30px] sm:tw-mb-1 sm:tw-mx-auto"-->
                            <!--                                alt="icon 2"-->
                            <!--                                src="https://www.musora.com/musora-cdn/image/width=60,quality=95/{{ $cohort['icon2_url'] }}"-->
                            <!--                                loading="lazy"-->
                            <!--                                onload="this.classList.remove('tw-opacity-0')"-->
                            <!--                            />-->
                            <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">{{ cohort['icon2_title'] }}</strong><br>
                                <span class="tw-text-sm">{{ cohort['icon2_copy'] }}</span></p>
                        </div>
                        <div class="tw-flex sm:tw-flex-col sm:tw-flex-1 tw-w-full sm:tw-w-1/3 tw-px-4 sm:tw-px-3">
                            <div class="tw-text-center">
                                <i :class="`far fa-fw fa-trophy tw-mr-3 sm:tw-mr-0 tw-text-${brand} tw-text-3xl sm:tw-mb-1`" aria-hidden="true"></i>
                            </div>
                            <!--                            <img-->
                            <!--                                class="tw-mr-3 tw-h-[30px] sm:tw-mb-1 sm:tw-mx-auto"-->
                            <!--                                alt="icon 3"-->
                            <!--                                src="https://www.musora.com/musora-cdn/image/width=60,quality=95/{{ $cohort['icon3_url'] }}"-->
                            <!--                                loading="lazy"-->
                            <!--                                onload="this.classList.remove('tw-opacity-0')"-->
                            <!--                            />-->
                            <p class="tw-leading-tight tw-mx-0"><strong class="tw-font-black">{{ cohort['icon3_title'] }}</strong><br>
                                <span class="tw-text-sm">{{ cohort['icon3_copy'] }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="tw-bg-white tw-py-7">
        <div class="tw-max-w-5xl tw-mx-auto tw-px-4 md:tw-px-10">
            <!--  Body title  -->
            <h3 class="tw-font-extrabold tw-text-center tw-mb-7">{{ cohort['body_title'] }}</h3>
            <!--  Body top description  -->
            <p class="md:tw-px-10" v-html="cohort['body_top_description']"></p>
        </div>
    </section>

    <section class="tw-bg-[#F1F7FE] tw-py-7 ">
        <div class="tw-max-w-5xl tw-mx-auto tw-px-4 md:tw-px-10">
            <div class="tw-relative tw-cursor-pointer tw-mb-10" @click="openTrailer = true">
                <!--  Body Image  -->
                <img
                    class="tw-rounded-xl tw-transition-opacity tw-opacity-0"
                    :src="`https://www.musora.com/musora-cdn/image/width=1200,quality=95/${cohort['body_image_url']}`"
                    alt="video thumb"
                    loading="lazy"
                    onload="this.classList.remove('tw-opacity-0')"
                />
            </div>
            <!--  Body logo  -->
            <img
                class="tw-h-10 sm:tw-h-16 tw-mb-8 tw-mx-auto tw-transition-opacity tw-opacity-0"
                alt="just play logo"
                :src="`https://www.musora.com/musora-cdn/image/width=1220,quality=95/${cohort['body_logo']}`"
                loading="lazy"
                onload="this.classList.remove('tw-opacity-0')"
            />
            <!--  Body bottom description  -->
            <p class="tw-text-center tw-px-6" v-html="cohort['body_bottom_description']"></p>
        </div>
    </section>


    <section id="final" v-if="cohort['is_product']" :class="`tw-bg-${brand} tw-py-20 lg:tw-py-32`">
        <div class="tw-max-w-6xl tw-mx-auto lg:tw-px-10 tw-flex tw-flex-col lg:tw-flex-row tw-items-center tw-px-4 lg:tw-px-0">
            <div class="tw-w-full lg:tw-w-1/2 lg:tw-order-1 tw-mb-4 lg:tw-mb-0">
                <div class="tw-w-full tw-aspect-video tw-bg-black tw-rounded-xl tw-overflow-hidden tw-relative">
                    <img :src="`https://www.musora.com/musora-cdn/image/width=600,quality=95/${cohort['product_image']}`" class="tw-transition-opacity tw-opacity-0 tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-object-cover" onload="this.classList.remove('tw-opacity-0')" />
                </div>
            </div>
            <div class="lg:tw-w-1/2 lg:tw-pr-4 tw-text-white tw-text-center md:tw-text-left">
                <h1 class="tw-text-2xl tw-font-extrabold tw-leading-tight tw-mb-5">{{ cohort['product_description_header'] }}</h1>
                <p class="tw-text-base tw-mb-6" v-html="cohort['product_description_body']"></p>
                <div class="tw-mb-5 tw-text-4xl">
                    <s class="tw-text-[rgba(255,255,255,0.7)]">${{ cohort['product_original_price'] }}</s> <span class="tw-font-extrabold">${{ cohort['product_sale_price'] }}</span> Save {{ Math.round(100 - (100 * (cohort['product_sale_price'] / cohort['product_original_price']))) }}%
                </div>
                <span v-if="isEnrolled" class="tw-btn-primary tw-bg-[#65656B] tw-text-white tw-cursor-default">You're enrolled</span>
                <template v-else>
                    <button
                        v-if="!hasEnded"
                        :class="`tw-btn-primary tw-bg-white tw-text-${brand} hover:tw-opacity-80`"
                        @click="enroll(true)"
                    >
                        Enroll + Get the deal
                    </button>
                    <span v-else class="tw-btn-primary tw-bg-[#65656B] tw-text-white tw-cursor-default">Enrollment Closed</span>
                </template>
            </div>
        </div>
    </section>

    <!--  Dropdown  -->
    <section class="tw-bg-white tw-py-10">
        <div class="tw-max-w-4xl tw-mx-auto tw-pl-6 tw-pr-4">
            <!--  Bottom title  -->
            <h3 class="tw-font-extrabold tw-text-center">{{ cohort['bottom_title'] }}</h3>
            <!--  Bottom description  -->
            <p class="tw-font-bold tw-text-center tw-mt-4 tw-mb-6">{{ cohort['bottom_description'] }}</p>

            <template v-if="cohort['is_product']">
                <div v-if="!isEnrolled && !hasEnded" >
                    <div class="md:tw-flex md:tw-justify-center md:tw-gap-6 tw-px-4 md:tw-px-0 tw-mb-4">
                        <div class="tw-w-full tw-max-w-[340px] tw-rounded-xl tw-px-4 md:tw-px-12 tw-py-8 tw-bg-white tw-border-2 tw-border-{{ $brand }} tw-text-center tw-mb-4 md:tw-mb-0 tw-mx-auto md:tw-mx-0">
                            <h1 class="lg:tw-text-[34px] tw-font-extrabold">Course Only</h1>
                            <h2 class="lg:tw-text-[26px] tw-font-extrabold">Free</h2>
                            <i>Included in your membership.</i>
                            <button :class="`tw-btn-primary tw-bg-${brand} tw-my-5 hover:tw-bg-${brand}-600`" @click="enroll()">Enroll Now</button>
                            <p class="tw-text-xs tw-leading-relaxed">{{ cohort['course_description'] }}</p>
                        </div>
                        <div class="tw-w-full tw-max-w-[340px] tw-rounded-xl tw-px-4 md:tw-px-12 tw-py-8 tw-bg-white tw-border-2 tw-border-[#FFAE00] tw-text-center tw-relative tw-mx-auto md:tw-mx-0">
                            <div class="tw-flex tw-justify-center tw-absolute tw-left-0 -tw-top-2 tw-w-full">
                                <div class="tw-uppercase tw-bg-[#FFAE00] tw-px-5 tw-py-0.5 tw-rounded-full tw-text-[10px] tw-font-semibold">{{ cohort['get_product_badge'] }}</div>
                            </div>
                            <h1 class="lg:tw-text-[34px] tw-font-extrabold tw-leading-tight">Course + <br /> {{ cohort['product_name'] }}</h1>
                            <h2 class="lg:tw-text-[26px]"><s class="tw-text-[rgba(0,0,0,0.6)]">${{ cohort['product_original_price'] }}</s> <span class="tw-font-extrabold">${{ cohort['product_sale_price'] }}</span></h2>
                            <i>Complete purchase on next step.</i>
                            <button
                                :class="`tw-btn-primary tw-bg-${brand} tw-my-5 tw-px-8 md:tw-px-16 hover:tw-bg-${brand}-600`"
                                @click="enroll(true)"
                            >
                                Enroll + Get the deal
                            </button>
                            <p class="tw-text-xs tw-leading-relaxed">{{ cohort['course_product_description'] }}</p>
                        </div>
                    </div>
                </div>
            </template>

            <div class="tw-max-w-[415px] md:tw-max-w-xl tw-mx-auto tw-flex tw-flex-col md:tw-flex-row md:tw-gap-2 tw-mb-4 tw-justify-center">
                <!--  Buttons  -->
                <span v-if="isEnrolled"  class="tw-btn-primary tw-bg-[#65656B] tw-w-full md:tw-w-1/2 tw-mb-2 md:tw-mb-0 tw-cursor-default">YOU'RE ENROLLED!</span>
                <template v-else>
                    <span v-if="hasEnded" class="tw-btn-primary tw-bg-[#65656B] tw-w-full tw-text-white tw-cursor-default">Enrollment Closed</span>
                    <button v-else-if="!cohort['is_product'] && hasEnded" @click="enroll()" :class="`tw-btn-primary tw-bg-${brand} tw-w-full md:tw-w-1/2 tw-text-white tw-mb-2 md:tw-mb-0 hover:tw-bg-${brand}-600`">Enroll Now</button>
                </template>
                <a v-if="cohort['conversation_url'] && isEnrolled" x-cloak x-show="isEnrolled" :href="cohort['conversation_url']" class="tw-btn-secondary tw-border-black tw-w-full md:tw-w-1/2 tw-text-black hover:tw-bg-black hover:tw-text-white">Join the conversation</a>
            </div>

            <!-- Cart link -->
            <div v-if="cohort['is_product'] && isEnrolled && !hasEnded" class="tw-text-center tw-mb-3"><a :href="cohort['product_cart_link']" target="_blank"  class="tw-text-sm tw-text-[#2563EB] tw-underline">{{ cohort['product_cart_link_description'] }}</a></div>

            <div class="tw-max-w-[250px] tw-mx-auto tw-flex tw-justify-center tw-items-center">
                <img
                    class="tw-h-7 sm:tw-mb-1 lg:tw-mb-0 tw-mr-1 tw-transition-opacity tw-opacity-0"
                    src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/new-piano-players/joined_profiles.png"
                    alt="joined student profiles"
                    loading="lazy"
                    onload="this.classList.remove('tw-opacity-0')"
                />
                <p class="tw-text-xs tw-align-middle">
                    Join {{ nPackOwners }} {{ joinText }}
                    who have already registered.
                </p>
            </div>

            <h3 class="tw-font-extrabold tw-text-center tw-mb-7 tw-mt-10">{{ cohort['dropdown_title'] }}</h3>
            <CohortDropdown
                v-if="dropdowns.length > 0"
                v-for="(dropdown, index) in dropdowns"
                :key="`dropdown ${index}`"
                :title="dropdown['title']"
                :desc="dropdown['description']"
            />
        </div>
    </section>

    <!-- Trailer Modal -->
    <VideoModal v-if="openTrailer" :videoUrl="cohort['cohort_trailer']" @onCloseModal="openTrailer = false" />

    <!-- Sign up Modal -->
    <ModalRenderer v-if="openSignUp">
        <button class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50" @click="openSignUp = false">
            <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
        </button>
        <div class="tw-max-w-xl tw-bg-white dark:tw-bg-[#081825] tw-text-center dark:tw-text-white tw-rounded-xl tw-px-8 tw-py-10 dark:tw-border-[#445F74] dark:tw-border">
            <img class="tw-h-20 tw-mx-auto tw-mb-5 dark:tw-hidden" :src="`https://www.musora.com/musora-cdn/image/width=440,quality=95/${cohort['light_mode_logo']}`" alt="modal logo" />
            <img class="tw-h-20 tw-mx-auto tw-mb-5 tw-hidden dark:tw-inline-block" :src="`https://www.musora.com/musora-cdn/image/width=440,quality=95/${cohort['dark_mode_logo']}`" alt="modal logo" />
            <div class="tw-text-2xl tw-font-bold tw-mb-1">Success, You’re Enrolled!</div>
            <p class="tw-mb-5">
                The course runs from {{ startDateText }} - {{ endDateText }}. We’ll notify you before the course begins.
            </p>
            <div>
                <a :href="`/${brand}`" class="tw-btn-primary tw-border-[#000C17] tw-text-[#000C17] hover:tw-bg-[#00101D] hover:tw-text-white dark:tw-bg-[#000C17] dark:tw-border-white dark:tw-text-white tw-mr-2 dark:hover:tw-bg-white dark:hover:tw-text-[#000C17]">Go home</a>
                <a :href="cohort['course_url']" class="tw-btn-primary tw-bg-[#00101D] tw-text-white hover:tw-bg-[#3F3F46] dark:tw-bg-white dark:tw-text-[#00101D] dark:hover:tw-bg-[#627F97] dark:hover:tw-text-white">Go to course</a>
            </div>
        </div>
    </ModalRenderer>

    <!-- Purchase Modal -->
    <ModalRenderer v-if="openPurchase">
        <button class="tw-text-white tw-absolute tw-right-2 tw-top-2 md:tw-top-[32px] md:tw-right-[48px] tw-z-50" @click="openPurchase = false">
            <XIcon class="tw-w-[26px] tw-h-[26px] md:tw-w-[48px] md:tw-h-[48px]" />
        </button>
        <div class="tw-max-w-xl tw-bg-white dark:tw-bg-[#081825] tw-text-center dark:tw-text-white tw-rounded-xl tw-px-8 tw-py-10 dark:tw-border-[#445F74] dark:tw-border">
            <img class="tw-h-20 tw-mx-auto tw-mb-5 dark:tw-hidden" :src="`https://www.musora.com/musora-cdn/image/width=440,quality=95/${cohort['light_mode_logo']}`" alt="modal logo" />
            <img class="tw-h-20 tw-mx-auto tw-mb-5 tw-hidden dark:tw-inline-block" :src="`https://www.musora.com/musora-cdn/image/width=440,quality=95/${cohort['dark_mode_logo']}`" alt="modal logo" />
            <div class="tw-text-2xl tw-font-bold tw-mb-1">Success, You’re Enrolled!</div>
            <p class="tw-mb-5">
                The course runs from {{ startDateText }} - {{ endDateText }}. We’ll notify you before the course begins.
            </p>
            <div class="tw-mb-4">
                <a :href="cohort['product_cart_link']" target="_blank" class="tw-btn-primary tw-bg-[#00101D] tw-text-white hover:tw-bg-[#3F3F46] dark:tw-bg-white dark:tw-text-[#00101D] dark:hover:tw-bg-[#627F97] dark:hover:tw-text-white tw-w-full">Click here to complete your purchase</a>
            </div>
            <div>
                <a :href="cohort['course_url']" class="tw-text-sm tw-text-[#2563EB] tw-underline ">Change your mind? Click here to to go the course instead.</a>
            </div>
        </div>
    </ModalRenderer>
</template>
<script setup>
import { inject, ref, computed, onBeforeMount } from 'vue';
import { DateTime } from 'luxon';
import { storeToRefs } from "pinia/dist/pinia";
import { useUserStore } from "@stores/user";
import CohortDropdown from '@collections/Dropdown/CohortDropdown';
import VideoModal from '@collections/Modal/VideoModal';
import ModalRenderer from "@collections/Modal/ModalRenderer";
import { XIcon } from "@heroicons/vue/solid";

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const props = defineProps({
    cohort: {
        type: Object,
        default: {},
    },
    dropdowns: {
        type: Array,
        default: [],
    },
    hasProduct: {
        type: Boolean,
        default: false,
    },
    nPackOwners: {
        type: String,
        default: '',
    },
    registerUrl: {
        type: String,
        default: ''
    },
})

const token = inject('csrf_token');

const isEnrolled = ref(props.hasProduct);
const countdownText = ref('');
const openTrailer = ref(false);
const openSignUp = ref(false);
const openPurchase = ref(false);
const hasEnded = ref(false);

const joinText = computed(() => {
    return brand.value === 'drumeo' ? 'drummers' : brand.value === 'pianote' ? 'piano players' : brand.value === 'guitareo' ? 'guitar players' : brand.value === 'singeo' ? 'singers' : 'students'
});

const enroll = (purchase = false) => {
    if(!isEnrolled.value){
        fetch(props.registerUrl, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
            },
            referrerPolicy: 'no-referrer',
        })
        .then((response) => {
            isEnrolled.value = true;

            if(purchase){
                openPurchase.value = true;
                return;
            }

            openSignUp.value = true;
        })
        .catch((e) => {
            window.shownotification({
                isError: true
            });
        });
    }
}

const addOrdinal = (day) =>{
    const suffixes = ['th', 'st', 'nd', 'rd'];
    const v = day % 100;
    return day + (suffixes[(v - 20) % 10] || suffixes[v] || suffixes[0]);
}

const startDateText = computed(() => {
    return DateTime.fromSQL(props.cohort['cohort_start_date']).toFormat('MMMM') + ` ${addOrdinal(DateTime.fromSQL(props.cohort['cohort_start_date']).toFormat('d'))}`;
})

const endDateText = computed(() => {
    return DateTime.fromSQL(props.cohort['cohort_end_date']).toFormat('MMMM') + ` ${addOrdinal(DateTime.fromSQL(props.cohort['cohort_end_date']).toFormat('d'))}`;
})

const countdown = () => {
    const start = new Date(props.cohort['enrollment_end_date']);
    const now = Date.now();
    const isEnded = now >= start;

    if(!isEnded){
        const diff = start - Date.now();
        // Calculate days, hours, minutes, seconds
        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((diff % (1000 * 60)) / 1000);

        if(window.innerWidth < 768){
            countdownText.value = `${days > 0 ? `${days}D` : ''} ${hours > 0 ? `${hours}H` : ''} ${minutes > 0 ? `${minutes}M` : ''} ${seconds > 0 ? `${seconds}S` : ''}`;
        } else {
            countdownText.value = `${days > 0 ? `${days} days` : ''} ${hours > 0 ? `${hours} hours` : ''} ${minutes > 0 ? `${minutes} minutes` : ''} ${seconds > 0 ? `${seconds} seconds` : ''}`;
        }
    } else {
        countdownText.value = '';
        hasEnded.value = true;
    }
}

onBeforeMount(() => {
    if(props.cohort['enrollment_end_date']){
        countdown();
        setInterval(countdown, 1000);
    }
})
</script>
