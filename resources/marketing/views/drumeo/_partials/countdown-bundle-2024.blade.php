 <div x-data="timer()" x-init="countdown()" class="bg-musora mx-auto text-center py-1 md:py-2">
                    <div class="inline-flex flex-wrap mx-auto justify-center items-center">
                        <p class="leading-none m-0 font-black "><strong>DEALS END IN:</strong></p>
                        <div class="h-12 mx-2 sm:mx-4 bg-black" style="width:2px;"></div>
                        <div class="flex">
                            <div class="mr-4 sm:mr-6" x-show="timeLeft > 0 && day > 0">
                                <div class="text-2xl sm:text-3xl font-extrabold" x-text="day">00</div>
                                <div class="text-xs font-semibold" x-text="dayText">DAYS</div>
                            </div>
                            <div class="mr-4 sm:mr-6" x-show="timeLeft > 0">
                                <div class="text-2xl sm:text-3xl font-extrabold" x-text="hour">00</div>
                                <div class="text-xs font-semibold" x-text="hourText">HRS</div>
                            </div>
                            <div class="mr-4 sm:mr-6" x-show="timeLeft > 0">
                                <div class="text-2xl sm:text-3xl font-extrabold" x-text="minute">00</div>
                                <div class="text-xs font-semibold" x-text="minuteText">MIN</div>
                            </div>
                            <div x-show="timeLeft > 0">
                                <div class="text-2xl sm:text-3xl font-extrabold" x-text="second">00</div>
                                <div class="text-xs font-semibold" x-text="secondText">SEC</div>
                            </div>
                            <span x-cloak x-show="timeLeft < 0">A Limited Time Left!</span>
                        </div>
                    </div>
                </div>
