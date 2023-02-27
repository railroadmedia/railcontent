<script>
    /**
         usage example!
             <section x-data="timer()" x-init="countdown()">
                 <div>
                     <span x-cloak x-show="timeLeft > 0">Only</span>
                     <span x-show="timeLeft > 0 && day !== '00'"><span x-text="day"></span> <span x-text="dayText"></span></span>
                     <span x-show="timeLeft > 0"><span x-text="hour"></span> <span x-text="hourText"></span></span>
                     <span x-show="timeLeft > 0"><span x-text="minute"></span> <span x-text="minuteText"></span></span>
                     <span x-show="timeLeft > 0"><span x-text="second"></span> <span x-text="secondText"></span></span>
                     <span x-cloak x-show="timeLeft > 0">Left!</span>
                     <span x-show="timeLeft < 0">Limited Time Left</span>
                 </div>
             </section>
     */

    function timer(){
        return {
            day: '00',
            dayText: @if(!empty($promoVersion) && $promoVersion) 'DAYS' @else 'days' @endif,
            hour: '00',
            hourText: @if(!empty($promoVersion) && $promoVersion) 'HRS' @else 'hours' @endif,
            minute: '00',
            minuteText: @if(!empty($promoVersion) && $promoVersion) 'MIN' @else 'minutes' @endif,
            second: '00',
            secondText: @if(!empty($promoVersion) && $promoVersion) 'SEC' @else 'seconds' @endif,
            endTime: new Date('{{ $countdownDate }}').getTime(),
            startTime: new Date().getTime(),
            timeLeft: 0,
            smallScreen: false,
            countdown: function (){
                let _this = this;
                this.startTime = new Date().getTime();
                this.timeLeft = (this.endTime - this.startTime) / 1000;

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
                            this.dayText = formatText(this.day, 'days');
                            this.hourText = formatText(this.hour, 'hours');
                            this.minuteText = formatText(this.minute, 'minutes');
                            this.secondText = formatText(this.second, 'seconds');
                        }
                        @endif
                    }, 1000);
                }

                @if(empty($promoVersion))
                    const bodyWidth = window.innerWidth;

                    if ( bodyWidth < 768 ){
                        this.dayText = 'DD';
                        this.hourText = 'HH';
                        this.minuteText = 'MM';
                        this.secondText = 'SS';
                        this.smallScreen = true;
                    }

                    window.addEventListener('resize', function(event){
                        const bodyWidth = window.innerWidth;

                        if ( bodyWidth < 768 ){
                            _this.smallScreen = true;
                            _this.dayText = 'DD';
                            _this.hourText = 'HH';
                            _this.minuteText = 'MM';
                            _this.secondText = 'SS';
                        }
                        else {
                            _this.smallScreen = false;
                            _this.dayText = 'days';
                            _this.hourText = 'hours';
                            _this.minuteText = 'minutes';
                            _this.secondText = 'seconds';
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
        if(time < 2 ) return text.substring(0, text.length - 1);

        return text;
    }
</script>


