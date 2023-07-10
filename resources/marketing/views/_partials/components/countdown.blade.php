<script>
    /** usage example:
     <span x-cloak x-data="timer()" x-init="countdown()">
         <span>
             Only
             <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
             <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
             <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
             <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
             <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
             Left!
         </span>
     </span>
     */

    function timer(){
        return {
            day: '00',
            dayText: @if(!empty($promoVersion) && $promoVersion) 'DAYS' @else ' days' @endif,
            hour: '00',
            hourText: @if(!empty($promoVersion) && $promoVersion) 'HRS' @else ' hours' @endif,
            minute: '00',
            minuteText: @if(!empty($promoVersion) && $promoVersion) 'MIN' @else ' minutes' @endif,
            second: '00',
            secondText: @if(!empty($promoVersion) && $promoVersion) 'SEC' @else ' seconds' @endif,
            endTime: new Date('{{ $countdownDate }}').getTime(),
            startTime: new Date().getTime(),
            timeLeft: 0,
            smallScreen: false,
            countdown: function (){
                let _this = this;
                this.startTime = new Date().getTime();
                this.timeLeft = (this.endTime - this.startTime) / 1000;

                this.startTime = new Date().getTime();
                this.timeLeft = (this.endTime - this.startTime) / 1000;
                this.day = this.formatTime(this.timeLeft / (60 * 60 * 24));
                this.hour = this.formatTime(this.timeLeft / (60 * 60)) % 24;
                this.minute = this.formatTime(this.timeLeft / 60) % 60;
                this.second = this.formatTime(this.timeLeft % 60);

                @if(empty($promoVersion))
                    if ( !this.smallScreen ){
                        this.dayText = formatText(this.day, ' days');
                        this.hourText = formatText(this.hour, ' hours');
                        this.minuteText = formatText(this.minute, ' minutes');
                        this.secondText = formatText(this.second, ' seconds');
                    }
                @else
                    this.dayText = formatText(this.day, 'DAYS');
                    this.hourText = formatText(this.hour, 'HRS');
                @endif

                if(this.timeLeft > 0){
                    setInterval(() => {
                        this.startTime = new Date().getTime();
                        this.timeLeft = (this.endTime - this.startTime) / 1000;
                        this.day = this.formatTime(this.timeLeft / (60 * 60 * 24));
                        this.hour = this.formatTime(this.timeLeft / (60 * 60)) % 24;
                        this.minute = this.formatTime(this.timeLeft / 60) % 60;
                        this.second = this.formatTime(this.timeLeft % 60);

                        @if(empty($promoVersion))
                            if ( !this.smallScreen ){
                                this.dayText = formatText(this.day, ' days');
                                this.hourText = formatText(this.hour, ' hours');
                                this.minuteText = formatText(this.minute, ' minutes');
                                this.secondText = formatText(this.second, ' seconds');
                            }
                        @else
                            this.dayText = formatText(this.day, 'DAYS');
                            this.hourText = formatText(this.hour, 'HRS');
                        @endif

                    }, 1000);
                }

                @if(empty($promoVersion))
                    const bodyWidth = window.innerWidth;

                    if ( bodyWidth < 768 ){
                        this.dayText = 'D';
                        this.hourText = 'H';
                        this.minuteText = 'M';
                        this.secondText = 'S';
                        this.smallScreen = true;
                    }

                    window.addEventListener('resize', function(event){
                        const bodyWidth = window.innerWidth;

                        if ( bodyWidth < 768 ){
                            _this.smallScreen = true;
                            _this.dayText = 'D';
                            _this.hourText = 'H';
                            _this.minuteText = 'M';
                            _this.secondText = 'S';
                        }
                        else {
                            _this.smallScreen = false;
                            _this.dayText = ' days';
                            _this.hourText = ' hours';
                            _this.minuteText = ' minutes';
                            _this.secondText = ' seconds';
                        }
                    });
                @endif
            },
            formatTime: function (value){
                return Math.floor(value);
            },
        }
    }

    function formatText(time, text){
        if(time === 1) return text.substring(0, text.length - 1);

        return text;
    }
</script>


